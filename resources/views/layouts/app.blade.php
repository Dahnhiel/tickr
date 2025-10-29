<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tickr' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">
    <!-- Top Navigation -->
    <x-nav />

    <!-- Sidebar -->
    @auth
        <x-sidebar />
    @endauth

    <!-- Main Content Area -->
    <main class="@auth md:ml-72 @else w-full @endauth transition-all duration-300 pt-16">
        <div class="p-6 max-w-7xl mx-auto">
            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#hamburger-menu').click(function() {
                var $sidebar = $('#sidebar');
                var $overlay = $('#sidebar-overlay');
                var $hamburger = $('.hamburger-icon');

                $sidebar.toggleClass('-translate-x-full');

                $overlay.toggleClass('hidden');

                $hamburger.toggleClass('active');
            });

            $('#sidebar-overlay').click(function() {
                $('#sidebar').addClass('-translate-x-full');
                $(this).addClass('hidden');
                $('.hamburger-icon').removeClass('active');
            });

            $('.sidebar-link').click(function() {
                if ($(window).width() < 768) {
                    $('#sidebar').addClass('-translate-x-full');
                    $('#sidebar-overlay').addClass('hidden');
                    $('.hamburger-icon').removeClass('active');
                }
            });

            // Mobile search toggle
            $('#mobile-search-btn').click(function() {
                $('#mobile-search').toggleClass('hidden');
            });

            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() >= 768) {
                    $('#sidebar').removeClass('-translate-x-full');
                    $('#sidebar-overlay').addClass('hidden');
                    $('.hamburger-icon').removeClass('active');
                } else {
                    $('#sidebar').addClass('-translate-x-full');
                    $('#sidebar-overlay').addClass('hidden');
                    $('.hamburger-icon').removeClass('active');
                }
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('#mobile-search, #mobile-search-btn').length) {
                    $('#mobile-search').addClass('hidden');
                }
            });
        });
    </script>
</body>
</html>
