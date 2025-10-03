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
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->paginate(10);
        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:1000'],
            'status' => ['nullable', 'in:pending,in progress,completed'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['in:low,moderate,extreme'],
            'task_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = null;

        if ($request->hasFile('task_image')) {
            $imagePath = $request->file('task_image')->store('tasks', 'public');
        }

        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->status = $validated['status'] ?? 'pending';
        $task->due_date = $validated['due_date'] ?? null;
        $task->priority = $validated['priority'];
        $task->task_image = $imagePath;


        $task->save();

        return redirect()->route('dashboard')->with('success', 'New Task Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        return view('tasks.index', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'priority' => 'required|in:extreme,moderate,low',
            'task_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('task_image')) {
            if ($task->task_image) {
                Storage::disk('public')->delete($task->task_image);
            }

            $validated['task_image'] = $request->file('task_image')->store('tasks', 'public');
        }

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        if ($task->task_image) {
            Storage::disk('public')->delete($task->task_image);
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task Deleted Successfully');
    }
}
