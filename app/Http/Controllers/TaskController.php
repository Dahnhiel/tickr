<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
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
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', 'in:pending,in progress,completed'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->status = $validated['status'];
        $task->due_date = $validated['due_date'];

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        //
    }
}
