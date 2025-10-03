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
                <button class="flex items-center space-x-1 text-red-500 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-sm font-medium">Add task</span>
                </button>
            </div>

            <div class="text-sm text-gray-600 mb-4">
                20 June • Today
            </div>

            @foreach ($tasks as $task)
                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 relative">
                        <div class="absolute top-4 right-4 text-xs text-gray-400">
                            {{ $task->created_at->format('H:i') }}
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-6 h-6 border-2 border-red-400 rounded-full mt-1"></div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $task->title }}</h3>
                                <p class="text-sm text-gray-600 mb-4">
                                    {{ $task->description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 text-xs">
                                        <span class="text-blue-600">Priority:
                                            <span class="font-medium">{{ $task->priority }}</span>
                                        </span>
                                        <span class="text-red-600">Status:
                                            <span class="font-medium">{{ $task->status }}</span>
                                        </span>
                                        <span class="text-gray-500">Created on:
                                            {{ $task->created_at->format('d/m') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                <img src="{{ $task->image ?? 'https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=64&h=64&fit=crop' }}"
                                    alt="Task Image" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                    stroke-dasharray="84, 100"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold">84%</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Completed</span>
                        </div>
                    </div>

                    <!-- In Progress -->
                    <div class="flex flex-col items-center">
                        <div class="relative w-20 h-20 mb-2">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="text-blue-500" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-dasharray="46, 100"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold">46%</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">In Progress</span>
                        </div>
                    </div>

                    <!-- Not Started -->
                    <div class="flex flex-col items-center">
                        <div class="relative w-20 h-20 mb-2">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="text-red-500" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-dasharray="13, 100"
                                    d="m18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold">13%</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Not Started</span>
                        </div>
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
                    <h2 class="text-lg font-semibold text-gray-900">Completed Task</h2>
                </div>

                <div class="space-y-4">
                    <!-- Completed Task 1 -->
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900">Walk the dog</h4>
                            <p class="text-xs text-gray-600">Take the dog to the park and bring treats as well.</p>
                            <div class="flex items-center space-x-2 text-xs text-gray-500 mt-1">
                                <span>Status: <span class="text-green-600 font-medium">Completed</span></span>
                                <span>Completed 2 days ago.</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?w=40&h=40&fit=crop"
                                alt="Dog" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Completed Task 2 -->
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900">Conduct meeting</h4>
                            <p class="text-xs text-gray-600">Meet with the client and finalize requirements.</p>
                            <div class="flex items-center space-x-2 text-xs text-gray-500 mt-1">
                                <span>Status: <span class="text-green-600 font-medium">Completed</span></span>
                                <span>Completed 2 days ago.</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=40&h=40&fit=crop"
                                alt="Meeting" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

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
