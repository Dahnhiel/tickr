<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Tickr</title>
</head>
<body>
    <div>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>

        <div class="p-3 bg-slate-100 text-slate-800 min-h-screen flex items-center justify-center">
            <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
                <img src="{{ asset('images/tickr logo.png') }}" alt="Tickr Logo" class="mx-auto mb-3 w-24">
                <h1 class="text-3xl font-bold text-indigo-600 text-center mb-6">Login to Tickr</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 text-sm rounded p-3">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" id="email" name="email" required
                               class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" id="password" name="password" required
                               class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                            Login
                        </button>
                    </div>
                    <div class="text-center text-sm text-slate-600 mt-4">
                        Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800">Register here</a>    
                    </div>

                </form>
            </div>
    </div>
</body>
</html>