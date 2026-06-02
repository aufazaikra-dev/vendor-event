<x-public-layout>
    <style>
        .gradient-text { background: linear-gradient(135deg, #C5A028, #e8c84a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-banner {
            background: linear-gradient(to bottom, rgba(31,41,55,0.7), rgba(17,24,39,0.95)), url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop') center/cover;
        }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
    </style>

    <!-- Navbar Premium Sticky -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm py-3 md:py-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="/" class="text-base md:text-3xl font-serif font-bold text-gold-600 flex items-center gap-1 md:gap-2">
                <svg class="w-5 h-5 md:w-8 md:h-8 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <div class="flex items-center gap-2 md:gap-4">
                @auth
                    @if(Auth::user()->role === 'vendor')
                        <a href="{{ route('vendor.dashboard') }}" class="px-3 py-2 md:px-6 md:py-3 text-sm md:text-base font-semibold text-gold-600 border border-gold-500 rounded-full hover:bg-gold-50 transition-colors">Dashboard Vendor</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 md:px-6 md:py-3 text-sm md:text-base font-semibold text-red-600 border border-red-500 rounded-full hover:bg-red-50 transition-colors">Dashboard Admin</a>
                    @else
                        <span class="hidden md:block text-base text-gray-600">Halo, <strong class="text-gray-900">{{ Auth::user()->name }}</strong></span>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 md:px-6 md:py-3 text-xs md:text-base font-semibold text-white bg-charcoal rounded-full hover:bg-gray-800 transition-colors shadow-md whitespace-nowrap">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-banner relative w-full pt-32 pb-20 md:pt-40 md:pb-24 overflow-hidden">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif text-white mb-6 drop-shadow-lg leading-tight">{{ $vendor->nama_bisnis }}</h1>
            <p class="text-lg md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto font-light leading-relaxed">{{ $vendor->deskripsi_singkat }}</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 -mt-16 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-10">
            <!-- Left Content (Main) -->
            <div class="lg:col-span-2 space-y-8 md:space-y-10">
                <!-- About Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-10 card-hover">
                    <h3 class="text-2xl md:text-3xl font-serif text-charcoal font-bold mb-6 pb-4 border-b border-gray-100">Tentang Kami</h3>
                    <p class="text-gray-600 text-lg leading-relaxed whitespace-pre-line mb-8">{{ $vendor->tentang_kami }}</p>
                    
                    <h4 class="text-xl font-bold text-charcoal flex items-center mb-3">
                        <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Alamat Lengkap
                    </h4>
                    <p class="text-gray-600 text-lg ml-9">{{ $vendor->address->jalan }}, {{ $vendor->address->desa }}, {{ $vendor->address->kecamatan }}</p>
                </div>

                <!-- Pricelist Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-10 card-hover">
                    <h3 class="text-2xl md:text-3xl font-serif text-charcoal font-bold mb-6 pb-4 border-b border-gray-100">Paket Harga (Pricelist)</h3>
                    
                    <div class="space-y-6">
                        @forelse($vendor->pricelists as $paket)
                        <div class="p-6 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:border-gold-300 transition-colors">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div class="flex-1">
                                    <h4 class="text-xl font-bold text-gold-600 mb-2">{{ $paket->nama_paket }}</h4>
                                    <p class="text-gray-500 text-base leading-relaxed">{{ $paket->fitur_paket }}</p>
                                </div>
                                <div class="text-left md:text-right">
                                    <span class="text-sm text-gray-400 block mb-1 uppercase tracking-wider">Harga Paket</span>
                                    <span class="text-2xl font-bold text-charcoal">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">Belum ada paket harga.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Gallery Section -->
                <div>
                    <h3 class="text-3xl font-serif text-charcoal font-bold mb-8">Galeri Portofolio</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @php
                            $photos = auth()->check() ? $vendor->projects : $vendor->projects->take(4);
                            $totalPhotos = $vendor->projects->count();
                        @endphp

                        @forelse($photos as $foto)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group card-hover">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('storage/' . $foto->cover_image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Portofolio">
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                    <h5 class="text-white font-bold text-xl">{{ $foto->judul_project }}</h5>
                                </div>
                            </div>
                            <div class="p-5">
                                <h6 class="font-bold text-charcoal text-lg mb-2">{{ $foto->judul_project }}</h6>
                                <p class="text-gray-500 text-sm line-clamp-2">{{ $foto->deskripsi }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                            <p class="text-gray-500 text-lg">Belum ada foto portofolio.</p>
                        </div>
                        @endforelse
                    </div>

                    @if(!auth()->check() && $totalPhotos > 4)
                    <div class="mt-10 text-center bg-champagne-light p-8 rounded-2xl border border-gold-200 shadow-inner">
                        <h5 class="text-2xl font-bold text-charcoal mb-3">Ada {{ $totalPhotos - 4 }} foto lainnya tersembunyi.</h5>
                        <p class="text-gray-600 text-lg mb-6">Login sekarang untuk melihat seluruh portofolio dan ulasan klien.</p>
                        <a href="{{ route('login') }}" class="inline-block px-8 py-4 bg-gold-500 text-white font-bold rounded-full hover:bg-gold-600 transition-colors shadow-lg">Daftar / Masuk Sekarang</a>
                    </div>
                    @endif
                </div>

                <!-- Reviews Section -->
                <div class="pt-8">
                    <h3 class="text-3xl font-serif text-charcoal font-bold mb-8">Ulasan Klien</h3>
                    <div class="space-y-6">
                        @forelse($vendor->reviews as $rev)
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 card-hover">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-charcoal text-white rounded-full flex items-center justify-center font-bold text-xl shadow-md">
                                        {{ substr($rev->user->name, 0, 1) }}
                                    </div>
                                    <h6 class="font-bold text-charcoal text-lg">{{ $rev->user->name }}</h6>
                                </div>
                                <div class="flex items-center bg-amber-50 px-3 py-1 rounded-full border border-amber-100">
                                    <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="font-bold text-charcoal">{{ $rev->rating }}/5</span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-lg italic leading-relaxed">"{{ $rev->komentar }}"</p>
                        </div>
                        @empty
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-8 text-center text-gray-500 text-lg">
                            Belum ada ulasan untuk vendor ini.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right Sidebar (Sticky Contact) -->
            <div class="lg:col-span-1 relative">
                <div class="sticky top-28 bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 text-center overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-gold-400 to-gold-600"></div>
                    
                    <h4 class="text-2xl font-serif font-bold text-charcoal mb-3 mt-2">Tertarik?</h4>
                    <p class="text-gray-500 mb-8 text-lg">Diskusikan acara impian Anda langsung dengan vendor.</p>

                    @auth
                        <a href="https://wa.me/{{ $vendor->no_whatsapp }}" target="_blank" class="flex items-center justify-center w-full py-4 bg-[#25D366] hover:bg-[#1ebe57] text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 mb-6 text-lg gap-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Hubungi via WhatsApp
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-4 bg-charcoal hover:bg-gray-900 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 mb-4 text-lg">
                            Masuk untuk Hubungi
                        </a>
                        <p class="text-sm text-red-500">Login untuk melihat nomor kontak.</p>
                    @endauth

                    <div class="border-t border-gray-100 my-6"></div>

                    <div class="flex justify-between items-center text-lg">
                        <span class="text-gray-500">Total Portofolio</span>
                        <span class="font-bold text-charcoal text-xl">{{ $vendor->projects->count() }} Album</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer Premium -->
    <footer class="bg-gradient-to-b from-gray-900 to-black pt-16 border-t-4 border-gold-500 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
            <div class="text-center text-lg text-gray-500 font-medium">
                &copy; {{ date('Y') }} EventVendor. All rights reserved.
            </div>
        </div>
    </footer>
</x-public-layout>
