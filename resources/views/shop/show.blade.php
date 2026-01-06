<x-shop-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('shop.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 font-medium ml-1 md:ml-2">{{ $product->nama }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div class="animate-fade-in">
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->nama }}" 
                             class="w-full aspect-square object-cover">
                    @else
                        <div class="w-full aspect-square flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                            <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <div class="mb-4">
                    @if($product->stok > 0)
                        <span class="inline-flex items-center bg-green-100 text-green-700 text-sm font-medium px-4 py-1 rounded-full">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Tersedia ({{ $product->stok }} item)
                        </span>
                    @else
                        <span class="inline-flex items-center bg-red-100 text-red-700 text-sm font-medium px-4 py-1 rounded-full">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Stok Habis
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $product->nama }}</h1>

                <div class="flex items-baseline mb-6">
                    <span class="text-4xl font-bold text-indigo-600">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </span>
                </div>

                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->deskripsi ?: 'Tidak ada deskripsi untuk produk ini.' }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    @if($product->stok > 0)
                        <button class="w-full btn-primary text-white py-4 rounded-xl font-semibold text-lg flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Tambah ke Keranjang
                        </button>
                        <button class="w-full bg-amber-500 hover:bg-amber-600 text-white py-4 rounded-xl font-semibold text-lg transition transform hover:scale-[1.02]">
                            Beli Sekarang
                        </button>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 py-4 rounded-xl font-semibold text-lg cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                </div>

                <!-- Product Meta -->
                <div class="mt-8 p-6 bg-gray-50 rounded-2xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Pengiriman</p>
                                <p class="font-medium text-gray-800">Gratis Ongkir</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Garansi</p>
                                <p class="font-medium text-gray-800">100% Original</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-12">
            <a href="{{ route('shop.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Produk
            </a>
        </div>
    </div>
</x-shop-layout>
