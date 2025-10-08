@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">To-Do</h2>
                </div>
                <a href="{{ route('tasks.create') }}" class="flex items-center space-x-1 text-red-500 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-sm font-medium">Add task</span>
                </a>
            </div>

            <div class="text-sm text-gray-600 mb-4">
                {{ now()->format('d F') }} • Today
            </div>

            @if ($tasks->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                    <p class="text-gray-500">No active tasks. Create one to get started!</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($tasks as $task)
                        <a href="{{route('tasks.show', $task)}}">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 relative">
                                <div class="absolute top-4 right-4 text-xs text-gray-400">
                                    {{ $task->created_at->format('H:i') }}
                                </div>
                                <div class="flex items-start space-x-4">
                                    <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="w-6 h-6 border-2 border-red-400 rounded-full mt-1 hover:bg-red-50 transition"></button>
                                    </form>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-2">{{ $task->title }}</h3>
                                        <p class="text-sm text-gray-600 mb-4">
                                            {{ $task->description ?? 'No description provided.' }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4 text-xs">
                                                <span class="text-blue-600">Priority:
                                                    <span class="font-medium capitalize">{{ $task->priority }}</span>
                                                </span>
                                                <span class="text-red-600">Status:
                                                    <span class="font-medium capitalize">{{ $task->status }}</span>
                                                </span>
                                                <span class="text-gray-500">Created:
                                                    {{ $task->created_at->format('d/m/Y') }}
                                                </span>
                                                @if ($task->due_date)
                                                    <span class="text-orange-600">Due:
                                                        {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('tasks.edit', $task) }}"
                                                    class="text-blue-500 hover:text-blue-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($task->task_image)
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $task->task_image) }}" alt="Task Image"
                                                class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=64&h=64&fit=crop"
                                                alt="Default Task Image" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Task Status Charts -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Task Status</h2>
                </div>

                <!-- Progress Circles -->
                <div class="grid grid-cols-3 gap-4 text-center">
                    <!-- Completed -->
                    <div class="flex flex-col items-center">
                        <div class="relative w-20 h-20 mb-2">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="text-green-500" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-dasharray="{{ $completedPercentage }}, 100"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <span
                                class="absolute inset-0 flex items-center justify-center text-sm font-semibold">{{ $completedPercentage }}%</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Completed</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ $completedCount }} tasks</span>
                    </div>

                    <!-- In Progress -->
                    <div class="flex flex-col items-center">
                        <div class="relative w-20 h-20 mb-2">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="text-blue-500" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-dasharray="{{ $inProgressPercentage }}, 100"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <span
                                class="absolute inset-0 flex items-center justify-center text-sm font-semibold">{{ $inProgressPercentage }}%</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">In Progress</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ $inProgressCount }} tasks</span>
                    </div>

                    <!-- Pending -->
                    <div class="flex flex-col items-center">
                        <div class="relative w-20 h-20 mb-2">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="text-red-500" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-dasharray="{{ $pendingPercentage }}, 100"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <span
                                class="absolute inset-0 flex items-center justify-center text-sm font-semibold">{{ $pendingPercentage }}%</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Pending</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ $pendingCount }} tasks</span>
                    </div>
                </div>
            </div>

            <!-- Completed Tasks -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Recently Completed</h2>
                </div>

                @if ($completedTasks->isEmpty())
                    <p class="text-sm text-gray-500 text-center py-4">No completed tasks yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($completedTasks as $completedTask)
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <div
                                    class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">{{ $completedTask->title }}
                                    </h4>
                                    <p class="text-xs text-gray-600 truncate">
                                        {{ Str::limit($completedTask->description, 50) ?? 'No description' }}</p>
                                    <div class="flex items-center space-x-2 text-xs text-gray-500 mt-1">
                                        <span>Status: <span class="text-green-600 font-medium">Completed</span></span>
                                        <span>{{ $completedTask->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if ($completedTask->task_image)
                                    <div class="w-10 h-10 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('storage/' . $completedTask->task_image) }}" alt="Task"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Invite Section -->
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop"
                                alt="User 1">
                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                src="https://images.unsplash.com/photo-1494790108755-2616b78d4066?w=32&h=32&fit=crop"
                                alt="User 2">
                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop"
                                alt="User 3">
                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=32&h=32&fit=crop"
                                alt="User 4">
                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=32&h=32&fit=crop"
                                alt="User 5">
                        </div>
                        <button
                            class="flex items-center space-x-1 px-3 py-1 text-sm text-red-500 border border-red-500 rounded-lg hover:bg-red-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span>Invite</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
