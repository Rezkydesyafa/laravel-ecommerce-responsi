<x-shop-layout>
    <!-- Hero Section -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Selamat Datang di <span class="text-yellow-300">{{ config('app.name', 'E-Shop') }}</span>
                </h1>
                <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                    Temukan produk terbaik dengan harga terjangkau. Belanja mudah, aman, dan cepat.
                </p>
                <a href="#products" class="inline-flex items-center bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Produk Unggulan</h2>
                <p class="text-gray-600 max-w-xl mx-auto">Koleksi produk terbaik kami yang siap memenuhi kebutuhan Anda</p>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($products as $index => $product)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-md card-hover animate-fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                            <!-- Product Image -->
                            <div class="relative aspect-square bg-gray-100 overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->nama }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Stock Badge -->
                                @if($product->stok > 0)
                                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                        Stok: {{ $product->stok }}
                                    </span>
                                @else
                                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-5">
                                <h3 class="font-semibold text-lg text-gray-800 mb-2 line-clamp-2">{{ $product->nama }}</h3>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ Str::limit($product->deskripsi, 80) }}</p>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-indigo-600">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <a href="{{ route('shop.show', $product) }}" 
                                       class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-200 transition">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500">Produk sedang dalam persiapan. Silakan kunjungi kembali nanti.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-indigo-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-500">Pesanan Anda akan dikirim dengan cepat dan aman ke alamat tujuan.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-green-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-500">Transaksi aman dengan berbagai metode pembayaran yang tersedia.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Layanan 24/7</h3>
                    <p class="text-gray-500">Tim kami siap membantu Anda kapan saja, 24 jam sehari.</p>
                </div>
            </div>
        </div>
    </section>
</x-shop-layout>
