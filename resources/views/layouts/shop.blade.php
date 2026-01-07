<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jualin Aja') }}</title>

    <!-- Google Fonts: Manrope -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }

        /* Tipografi & Utilities Helper */
        .ls-1 { letter-spacing: 1px; }
        .text-sm { font-size: 0.875rem; }
        
        .hover-text-dark:hover { color: #000 !important; }
        .transition { transition: all 0.2s ease; }
        
        /* Dropdown Styling override */
        .dropdown-item:active { background-color: #f3f4f6; color: #000; }
        .dropdown-item:hover { background-color: #f3f4f6; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main class="flex-grow-1">
        {{ $slot }}
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
