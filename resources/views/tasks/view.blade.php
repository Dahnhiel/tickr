@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Task Detail Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <!-- Header Section -->
            <div class="flex items-start justify-between mb-8">
                <div class="flex items-start space-x-6">
                    <!-- Task Image -->
                    @if($task->task_image)
                        <div class="w-48 h-48 rounded-2xl overflow-hidden flex-shrink-0 shadow-lg">
                            <img src="{{ asset('storage/' . $task->task_image) }}"
                                alt="{{ $task->title }}"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-48 h-48 rounded-2xl overflow-hidden flex-shrink-0 shadow-lg bg-gradient-to-br from-blue-100 to-blue-200">
                            <img src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=192&h=192&fit=crop"
                                alt="Default Task"
                                class="w-full h-full object-cover">
                        </div>
                    @endif

                    <!-- Task Info -->
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $task->title }}</h1>

                        <div class="flex items-center space-x-6 text-sm mb-4">
                            <div class="flex items-center">
                                <span class="text-gray-600">Priority:</span>
                                <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $task->priority === 'extreme' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $task->priority === 'moderate' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $task->priority === 'low' ? 'bg-green-100 text-green-700' : '' }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>

                            <div class="flex items-center">
                                <span class="text-gray-600">Status:</span>
                                <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $task->status === 'in progress' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $task->status === 'pending' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $task->status === 'pending' ? 'Not Started' : ucfirst($task->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="text-sm text-gray-500">
                            Created on: {{ $task->created_at->format('d/m/Y') }}
                        </div>

                        @if($task->due_date)
                            <div class="text-sm text-gray-500 mt-1">
                                Due date: {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Go Back Button -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Go Back</span>
                </a>
            </div>

            <!-- Description Section -->
            <div class="mb-8">
                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $task->description ?? 'No description provided.' }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <!-- Delete Button -->
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-12 h-12 flex items-center justify-center bg-red-500 text-white rounded-xl hover:bg-red-600 transition shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </form>

                <!-- Edit Button -->
                <a href="{{ route('tasks.edit', $task) }}"
                    class="w-12 h-12 flex items-center justify-center bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </a>

                <!-- Complete/Mark Button -->
                @if($task->status !== 'completed')
                    <form action="{{ route('tasks.complete', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="w-12 h-12 flex items-center justify-center bg-green-500 text-white rounded-xl hover:bg-green-600 transition shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>
                @else
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-300 text-white rounded-xl cursor-not-allowed shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Additional Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
             <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center
                        {{ $task->priority === 'extreme' ? 'bg-red-100' : '' }}
                        {{ $task->priority === 'moderate' ? 'bg-yellow-100' : '' }}
                        {{ $task->priority === 'low' ? 'bg-green-100' : '' }}">
                        <svg class="w-5 h-5
                            {{ $task->priority === 'extreme' ? 'text-red-600' : '' }}
                            {{ $task->priority === 'moderate' ? 'text-yellow-600' : '' }}
                            {{ $task->priority === 'low' ? 'text-green-600' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Priority Level</p>
                        <p class="text-lg font-semibold text-gray-900 capitalize">{{ $task->priority }}</p>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center
                        {{ $task->status === 'completed' ? 'bg-green-100' : '' }}
                        {{ $task->status === 'in progress' ? 'bg-blue-100' : '' }}
                        {{ $task->status === 'pending' ? 'bg-red-100' : '' }}">
                        <svg class="w-5 h-5
                            {{ $task->status === 'completed' ? 'text-green-600' : '' }}
                            {{ $task->status === 'in progress' ? 'text-blue-600' : '' }}
                            {{ $task->status === 'pending' ? 'text-red-600' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Current Status</p>
                        <p class="text-lg font-semibold text-gray-900 capitalize">
                            {{ $task->status === 'pending' ? 'Not Started' : $task->status }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Created</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $task->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
