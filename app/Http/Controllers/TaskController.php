<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display dashboard with tasks and statistics
     */
    public function index()
    {
        $user = Auth::user();

        // all tasks
        $tasks = $user->tasks()
            ->where('status', '!=', 'completed')
            ->latest()
            ->paginate(10);

        // completed tasks
        $completedTasks = $user->tasks()
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();

        // Calculate task statistics
        $totalTasks = $user->tasks()->count();
        $completedCount = $user->tasks()->where('status', 'completed')->count();
        $inProgressCount = $user->tasks()->where('status', 'in progress')->count();
        $pendingCount = $user->tasks()->where('status', 'pending')->count();

        // Calculate percentages
        $completedPercentage = $totalTasks > 0 ? round(($completedCount / $totalTasks) * 100) : 0;
        $inProgressPercentage = $totalTasks > 0 ? round(($inProgressCount / $totalTasks) * 100) : 0;
        $pendingPercentage = $totalTasks > 0 ? round(($pendingCount / $totalTasks) * 100) : 0;

        return view('dashboard', compact(
            'tasks',
            'completedTasks',
            'completedPercentage',
            'inProgressPercentage',
            'pendingPercentage',
            'totalTasks',
            'completedCount',
            'inProgressCount',
            'pendingCount'
        ));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', 'in:pending,in progress,completed'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
            'priority' => ['required', 'in:low,moderate,extreme'],
            'task_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Handle image upload
        if ($request->hasFile('task_image')) {
            $validated['task_image'] = $request->file('task_image')->store('tasks', 'public');
        }

        // Create task with mass assignment
        Auth::user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'pending',
            'due_date' => $validated['due_date'] ?? null,
            'priority' => $validated['priority'],
            'task_image' => $validated['task_image'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'New task created successfully!');
    }

    /**
     * Display the specified resource
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.view', compact('task'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:pending,in progress,completed'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['required', 'in:low,moderate,extreme'],
            'task_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Handle image upload and deletion
        if ($request->hasFile('task_image')) {
            // Delete old image if exists
            if ($task->task_image) {
                Storage::disk('public')->delete($task->task_image);
            }
            $validated['task_image'] = $request->file('task_image')->store('tasks', 'public');
        }

        $task->update($validated);

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete associated image
        if ($task->task_image) {
            Storage::disk('public')->delete($task->task_image);
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }

    /**
     * Mark task as completed
     */
    public function markAsCompleted(Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['status' => 'completed']);

        return redirect()->route('dashboard')->with('success', 'Task marked as completed!');
    }
}
