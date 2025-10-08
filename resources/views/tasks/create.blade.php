@extends('layouts.app')

@section('title', 'Add New Task')

@section('content')
    <style>
        .custom-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 3px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }

        .custom-checkbox:checked {
            background-color: currentColor;
            border-color: currentColor;
        }

        .custom-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .priority-extreme:checked {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .priority-moderate:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .priority-low:checked {
            background-color: #10b981;
            border-color: #10b981;
        }
    </style>

    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 animate-fadeIn">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto animate-slideUp">
            <div class="bg-gradient-to-r from-slate-800 to-slate-700 px-8 py-6 flex items-center justify-between rounded-t-2xl">
                <h1 class="text-2xl font-bold text-white">Add New Task</h1>
                <a href="{{ route('dashboard') }}"
                    class="text-slate-300 hover:text-white transition duration-200 text-sm font-medium">
                    Go Back
                </a>
            </div>

            @if ($errors->any())
                <div class="mx-8 mt-6 bg-red-50 border-l-4 border-red-500 rounded-r-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were some errors with your submission:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            required
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200 @error('title') border-red-500 @enderror"
                            placeholder="Enter task title...">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date and Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date -->
                        <div>
                            <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-2">Due Date</label>
                            <input
                                type="date"
                                id="due_date"
                                name="due_date"
                                value="{{ old('due_date') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200 @error('due_date') border-red-500 @enderror">
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                            <select
                                id="status"
                                name="status"
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200 @error('status') border-red-500 @enderror">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in progress" {{ old('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Priority -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-3">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center gap-8">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input
                                    type="radio"
                                    name="priority"
                                    value="extreme"
                                    class="custom-checkbox priority-extreme"
                                    {{ old('priority') == 'extreme' ? 'checked' : '' }}
                                    required>
                                <span class="text-sm font-medium text-slate-700 group-hover:text-red-600 transition">Extreme</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input
                                    type="radio"
                                    name="priority"
                                    value="moderate"
                                    class="custom-checkbox priority-moderate"
                                    {{ old('priority') == 'moderate' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-slate-700 group-hover:text-blue-600 transition">Moderate</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input
                                    type="radio"
                                    name="priority"
                                    value="low"
                                    class="custom-checkbox priority-low"
                                    {{ old('priority') == 'low' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-slate-700 group-hover:text-green-600 transition">Low</span>
                            </label>
                        </div>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Task Description and Upload Image -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Task Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Task Description</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="8"
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200 resize-none @error('description') border-red-500 @enderror"
                                placeholder="Start writing here...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Image -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Image</label>
                            <div id="upload-area" class="border-2 border-dashed border-slate-300 rounded-lg h-full min-h-[224px] flex flex-col items-center justify-center p-6 cursor-pointer hover:border-slate-400 hover:bg-slate-50 transition duration-200 relative">
                                <input
                                    type="file"
                                    id="task_image"
                                    name="task_image"
                                    accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                    onchange="previewImage(event)">

                                <div id="upload-placeholder">
                                    <svg class="w-16 h-16 text-slate-400 mb-3 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>

                                    <p class="text-sm text-slate-500 text-center mb-2">Drag&Drop files here</p>
                                    <p class="text-xs text-slate-400 mb-3">or</p>
                                    <button
                                        type="button"
                                        class="px-6 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition duration-200">
                                        Browse
                                    </button>
                                </div>

                                <div id="image-preview" class="hidden absolute inset-0">
                                    <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover rounded-lg">
                                    <button
                                        type="button"
                                        onclick="removeImage(event)"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition z-20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @error('task_image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex justify-start">
                        <button
                            type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            Done
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        .animate-slideUp {
            animation: slideUp 0.3s ease-out;
        }
    </style>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage(event) {
            event.preventDefault();
            event.stopPropagation();
            document.getElementById('task_image').value = '';
            document.getElementById('preview-img').src = '';
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('image-preview').classList.add('hidden');
        }
    </script>
@endsection
