<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Commerce') }} - Toko Online</title>
        <meta name="description" content="Temukan produk terbaik dengan harga terjangkau di toko online kami">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --secondary: #f59e0b;
                --dark: #1e293b;
                --light: #f8fafc;
            }

            body {
                font-family: 'Inter', sans-serif;
            }

            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: scale(1.02);
                box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
            }

            .nav-link {
                position: relative;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--primary);
                transition: width 0.3s ease;
            }

            .nav-link:hover::after {
                width: 100%;
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeInUp 0.6s ease forwards;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="glass-effect sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <a href="{{ route('shop.index') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">{{ config('app.name', 'E-Shop') }}</span>
                    </a>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('shop.index') }}" class="nav-link text-gray-600 hover:text-gray-900 font-medium">Beranda</a>
                        <a href="{{ route('shop.index') }}" class="nav-link text-gray-600 hover:text-gray-900 font-medium">Produk</a>
                    </div>

                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-indigo-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50">
                                    @if(Auth::user()->isAdmin())
                                        <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                Admin Dashboard
                                            </span>
                                        </a>
                                    @endif
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Profil Saya
                                        </span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                                Keluar
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Masuk</a>
                            <a href="{{ route('register') }}" class="btn-primary text-white px-5 py-2 rounded-full font-medium">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-12 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-white">{{ config('app.name', 'E-Shop') }}</span>
                        </div>
                        <p class="text-gray-500 mb-4">Platform e-commerce terpercaya untuk kebutuhan belanja online Anda. Produk berkualitas dengan harga terbaik.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('shop.index') }}" class="hover:text-white transition">Beranda</a></li>
                            <li><a href="{{ route('shop.index') }}" class="hover:text-white transition">Produk</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Kontak</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                info@eshop.com
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                +62 812 3456 7890
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'E-Shop') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Alpine.js for dropdown -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>
