@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Edit Task</h2>
                <a href="{{ route('tasks.show', $task) }}"
                    class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <span>Go Back</span>
                </a>
            </div>

            @if ($errors->any())
                <div class="mx-6 mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were some errors:</h3>
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
            <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-red-500 @enderror"
                                required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Date
                            </label>
                            <div class="relative">
                                <input type="date" id="due_date" name="due_date"
                                    value="{{ old('due_date', $task->due_date) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-10 @error('due_date') border-red-500 @enderror">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Priority
                            </label>
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="priority" value="extreme"
                                        {{ old('priority', $task->priority) === 'extreme' ? 'checked' : '' }}
                                        class="w-4 h-4 text-red-500 border-gray-300 focus:ring-red-500">
                                    <span class="flex items-center space-x-1">
                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                        <span class="text-sm text-gray-700">Extreme</span>
                                    </span>
                                </label>

                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="priority" value="moderate"
                                        {{ old('priority', $task->priority) === 'moderate' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-500 border-gray-300 focus:ring-blue-500">
                                    <span class="flex items-center space-x-1">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                        <span class="text-sm text-gray-700">Moderate</span>
                                    </span>
                                </label>

                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="priority" value="low"
                                        {{ old('priority', $task->priority) === 'low' ? 'checked' : '' }}
                                        class="w-4 h-4 text-green-500 border-gray-300 focus:ring-green-500">
                                    <span class="flex items-center space-x-1">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        <span class="text-sm text-gray-700">Low</span>
                                    </span>
                                </label>
                            </div>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status
                            </label>
                            <select id="status" name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('status') border-red-500 @enderror"
                                required>
                                <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="in progress"
                                    {{ old('status', $task->status) === 'in progress' ? 'selected' : '' }}>In Progress
                                </option>
                                <option value="completed"
                                    {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Task Description
                            </label>
                            <textarea id="description" name="description" rows="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none @error('description') border-red-500 @enderror"
                                placeholder="Start writing here...">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Upload Image
                        </label>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition">
                            <input type="file" id="task_image" name="task_image" class="hidden"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(event)">

                            <label for="task_image" class="cursor-pointer">
                                <div id="upload-placeholder" class="{{ $task->task_image ? 'hidden' : '' }}">
                                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-sm text-gray-500 mb-1">Drag&Drop files here</p>
                                    <p class="text-xs text-gray-400 mb-3">or</p>
                                    <span
                                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition inline-block">
                                        Browse
                                    </span>
                                </div>

                                <div id="image-preview" class="{{ $task->task_image ? '' : 'hidden' }}">
                                    <img id="preview-img"
                                        src="{{ $task->task_image ? asset('storage/' . $task->task_image) : '' }}"
                                        alt="Preview" class="w-full h-48 object-cover rounded-lg mb-3">
                                    <button type="button" onclick="removeImage()"
                                        class="text-sm text-red-500 hover:text-red-700">
                                        Remove Image
                                    </button>
                                </div>
                            </label>
                        </div>

                        @if ($task->task_image)
                            <div class="mt-3">
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="remove_image" value="1"
                                        class="rounded border-gray-300 text-red-500 focus:ring-red-500">
                                    <span class="text-sm text-gray-600">Remove current image</span>
                                </label>
                            </div>
                        @endif

                        @error('task_image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-start">
                    <button type="submit"
                        class="px-8 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-semibold shadow-lg hover:shadow-xl">
                        Done
                    </button>
                </div>
            </form>
        </div>
    </div>

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

        function removeImage() {
            document.getElementById('task_image').value = '';
            document.getElementById('preview-img').src = '';
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('image-preview').classList.add('hidden');
        }
    </script>
@endsection
