<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

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

        .upload-area {
            border: 2px dashed #cbd5e1;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #94a3b8;
            background-color: #f8fafc;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-6 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-slate-800 to-slate-700 px-8 py-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white">Add New Task</h1>
                <a href="#" class="text-slate-300 hover:text-white transition duration-200 text-sm font-medium">Go Back</a>
            </div>

            <!-- Form -->
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg">
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            required
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200"
                            placeholder="Enter task title...">
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-2">Date</label>
                        <div class="relative">
                            <input
                                type="date"
                                id="due_date"
                                name="due_date"
                                required
                                value="{{ old('date') }}"
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200">
                        </div>
                    </div>

                    <!-- Priority -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Priority</label>
                        <div class="flex items-center gap-8">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input
                                    type="radio"
                                    name="priority"
                                    value="extreme"
                                    class="custom-checkbox priority-extreme"
                                    {{ old('priority') == 'extreme' ? 'checked' : '' }}>
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
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition duration-200 resize-none"
                                placeholder="Start writing here...">{{ old('description') }}</textarea>
                        </div>

                        <!-- Upload Image -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Image</label>
                            <div class="upload-area rounded-lg h-full min-h-[200px] flex flex-col items-center justify-center p-6 cursor-pointer relative">
                                <input
                                    type="file"
                                    id="task_image"
                                    name="task_image"
                                    accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                                <svg class="w-16 h-16 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 shadow-lg hover:shadow-xl">
                            Done
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview uploaded image
        const imageInput = document.getElementById('image');
        const uploadArea = imageInput.parentElement;

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadArea.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Preview">
                        <button type="button" onclick="resetUpload()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    `;
                }
                reader.readAsDataURL(file);
            }
        });

        function resetUpload() {
            location.reload();
        }
    </script>
</body>
</html>
