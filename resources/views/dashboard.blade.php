<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tickr | Dashboard</title>
</head>

<body>
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
            <h1 class="text-3xl font-bold text-indigo-600 text-center mb-6">Welcome to Tickr Dashboard</h1>

            <p class="text-center text-slate-700 mb-4">You are logged in as {{ auth()->user()->name }}</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>

</html>
