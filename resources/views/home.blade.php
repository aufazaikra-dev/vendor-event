<x-public-layout>
    <style>
        /* Stats mini card */
        .stat-card { background: #fff; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-card .stat-number { font-size: 2rem; font-weight: 700; color: #C5A028; }

        /* Floating stats animation */
        @keyframes floatUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .stat-animate { animation: floatUp 0.7s ease both; }
        .stat-animate:nth-child(1) { animation-delay: 0.1s; }
        .stat-animate:nth-child(2) { animation-delay: 0.25s; }
        .stat-animate:nth-child(3) { animation-delay: 0.4s; }

        /* Section divider wave */
        .wave-divider svg { display: block; }

        /* Feature card hover */
        .feature-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }

        /* Testimonial card */
        .testi-card { background: #fff; border-radius: 20px; padding: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.07); border: 1px solid #f0f0f0; transition: transform 0.3s ease; }
        .testi-card:hover { transform: translateY(-4px); }

        /* Gradient text */
        .gradient-text { background: linear-gradient(135deg, #C5A028, #e8c84a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    </style>
    <!-- Navbar Premium Sticky -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm py-3 md:py-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Logo: lebih kecil di mobile -->
            <a href="/" class="text-base md:text-3xl font-serif font-bold text-gold-600 flex items-center gap-2 md:gap-3">
                <x-application-logo class="w-8 h-8 md:w-12 md:h-12 shrink-0" />
                EventVendor
            </a>

            <div class="flex items-center gap-2 md:gap-4">
                @auth
                    @if(Auth::user()->role === 'vendor')
                        <a href="{{ route('vendor.dashboard') }}" class="px-3 py-2 md:px-6 md:py-3 text-sm md:text-base font-semibold text-gold-600 border border-gold-500 rounded-full hover:bg-gold-50 transition-colors">Dashboard Vendor</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 md:px-6 md:py-3 text-sm md:text-base font-semibold text-red-600 border border-red-500 rounded-full hover:bg-red-50 transition-colors">Dashboard Admin</a>
                    @else
                        <span class="hidden md:block text-base text-gray-600">Halo, <strong class="text-gray-900">{{ Auth::user()->name }}</strong></span>
                        <a href="{{ route('user.transactions') }}" class="px-3 py-2 md:px-6 md:py-3 text-sm md:text-base font-semibold text-charcoal border border-gray-300 rounded-full hover:bg-gray-50 transition-colors">Pesanan Saya</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="px-3 py-2 md:px-6 md:py-3 text-sm md:text-base font-semibold text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors shadow-sm">Logout</button>
                    </form>
                @else
                    <!-- "Jadi Vendor" tampil di semua ukuran, lebih kecil di mobile -->
                    <a href="{{ route('vendor.register') }}" class="px-3 py-2 md:px-6 md:py-3 text-xs md:text-base font-semibold text-gold-600 border border-gold-500 rounded-full hover:bg-gold-50 transition-colors whitespace-nowrap">Jadi Vendor</a>
                    <a href="{{ route('login') }}" class="px-3 py-2 md:px-6 md:py-3 text-xs md:text-base font-semibold text-white bg-charcoal rounded-full hover:bg-gray-800 transition-colors shadow-md whitespace-nowrap">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section dengan Crossfade Mulus (Efek scale dihapus) -->
    <section class="relative w-full min-h-screen flex items-center justify-center pt-24 pb-16 overflow-hidden">
        <!-- Layer Background Animasi -->
        <div id="hero-layers" class="absolute inset-0 z-0">
            <!-- Gambar 1: Dekorasi Mewah -->
            <div class="hero-layer absolute inset-0 bg-cover bg-center transition-opacity duration-[3000ms] ease-in-out opacity-100" style="background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=1920&q=80');"></div>
            <!-- Gambar 2: Detail Meja/Katering -->
            <div class="hero-layer absolute inset-0 bg-cover bg-center transition-opacity duration-[3000ms] ease-in-out opacity-0" style="background-image: url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=1920&q=80');"></div>
            <!-- Gambar 3: Venue Elegan -->
            <div class="hero-layer absolute inset-0 bg-cover bg-center transition-opacity duration-[3000ms] ease-in-out opacity-0" style="background-image: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1920&q=80');"></div>
        </div>

        <!-- Overlay Gradien Gelap Premium agar teks menonjol -->
        <div class="absolute inset-0 bg-gradient-to-b from-charcoal/80 via-charcoal/60 to-charcoal/90 z-0"></div>

        <div class="relative z-10 w-full max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col items-center mt-8">
            <!-- Judul diperbesar (text-7xl di layar besar) -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif text-white text-center mb-6 leading-tight drop-shadow-lg">
                Wujudkan Acara Impian Anda
            </h1>
            <!-- Subjudul diperbesar -->
            <p class="text-xl md:text-2xl text-gray-200 mb-12 text-center max-w-5xl drop-shadow-md font-light leading-relaxed">
                Rancang Bangun Platform Direktori Vendor Acara Spesifik di Kota Banda Aceh dengan Fitur Rekomendasi Menggunakan Metode Simple Additive Weighting.
            </p>

            <!-- Form Pencarian SAW - Glassmorphism Card -->
            <div class="w-full bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl p-8 md:p-10 shadow-2xl">
                <form action="/" method="GET">
                    <input type="hidden" name="cari" value="yes">

                    <!-- Baris 1: Filter Data -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Kategori Jasa - Dropdown Multi Select (Alpine.js) -->
                        <div x-data="{ open: false, selectedCount: 0 }" 
                             x-init="selectedCount = $el.querySelectorAll('input:checked').length"
                             class="relative">
                            <label class="block text-white text-base md:text-lg font-medium mb-3 tracking-wide">
                                Kategori Jasa
                            </label>
                            
                            <!-- Trigger Dropdown -->
                            <div @click="open = !open" 
                                 class="w-full rounded-xl border-0 bg-white/90 text-charcoal text-base py-4 px-5 shadow-inner cursor-pointer flex justify-between items-center ring-offset-2 focus-within:ring-2 focus-within:ring-gold-500">
                                <span class="truncate" x-text="selectedCount > 0 ? selectedCount + ' Kategori Dipilih' : 'Semua Kategori'">Semua Kategori</span>
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="open ? 'transform rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>

                            <!-- Isi Dropdown -->
                            <div x-show="open" 
                                 @click.away="open = false" 
                                 x-transition.opacity.duration.200ms
                                 style="display: none;"
                                 class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-xl border border-gray-100 p-2 flex flex-col max-h-60 overflow-y-auto">
                                
                                @foreach($categories as $cat)
                                    @php
                                        $isChecked = isset($old_input['kategori']) && in_array($cat->id, (array) $old_input['kategori']);
                                    @endphp
                                    <label class="flex items-center gap-3 p-3 hover:bg-amber-50 rounded-lg cursor-pointer transition-colors">
                                        <input type="checkbox" 
                                               name="kategori[]" 
                                               value="{{ $cat->id }}" 
                                               class="w-5 h-5 text-gold-500 border-gray-300 rounded focus:ring-gold-500" 
                                               {{ $isChecked ? 'checked' : '' }}
                                               @change="selectedCount = $el.closest('div[x-data]').querySelectorAll('input:checked').length">
                                        <span class="text-charcoal font-medium">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Kecamatan -->
                        <div>
                            <label class="block text-white text-base md:text-lg font-medium mb-3 tracking-wide">Kecamatan (Banda Aceh)</label>
                            <select name="kecamatan" class="w-full rounded-xl border-0 bg-white/90 focus:ring-2 focus:ring-gold-500 text-charcoal text-base py-4 px-5 shadow-inner">
                                <option value="">Semua Kecamatan</option>
                                @foreach($kecamatans as $kec)
                                    <option value="{{ $kec }}" {{ (isset($old_input['kecamatan']) && $old_input['kecamatan'] == $kec) ? 'selected' : '' }}>{{ $kec }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Budget Max -->
                        <div>
                            <label class="block text-white text-base md:text-lg font-medium mb-3 tracking-wide">Budget Max (Rp)</label>
                            <input type="number" name="max_budget" class="w-full rounded-xl border-0 bg-white/90 focus:ring-2 focus:ring-gold-500 text-charcoal text-base py-4 px-5 shadow-inner" placeholder="Contoh: 5000000" value="{{ $old_input['max_budget'] ?? '' }}">
                        </div>

                    </div>

                    <div class="border-t border-white/20 pt-8 mb-6">
                        <h5 class="text-white font-serif font-medium text-center mb-8 text-2xl">Atur Prioritas Rekomendasi (Metode SAW)</h5>

                        <!-- Baris 2: Bobot Prioritas -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Harga -->
                            <div class="text-center bg-white/5 p-5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                                <label class="block text-gold-400 font-semibold text-lg mb-2">Harga</label>
                                <div class="flex justify-center mb-3">
                                    <span id="val_harga"
                                          class="inline-block min-w-[56px] text-center text-2xl font-extrabold px-3 py-1 rounded-full"
                                          style="background: rgba(197,160,40,0.18); color: #e8c84a; border: 1px solid rgba(197,160,40,0.35);">
                                        {{ $old_input['bobot_harga'] ?? 50 }}%
                                    </span>
                                </div>
                                <input type="range" name="bobot_harga" id="slider_harga"
                                       min="1" max="100"
                                       class="w-full accent-gold-500 mb-3 cursor-pointer"
                                       value="{{ $old_input['bobot_harga'] ?? 50 }}"
                                       oninput="document.getElementById('val_harga').textContent = this.value + '%'">
                                <span class="text-sm text-gray-300 block">Harga termurah</span>
                            </div>

                            <!-- Rating -->
                            <div class="text-center bg-white/5 p-5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                                <label class="block text-gold-400 font-semibold text-lg mb-2">Rating</label>
                                <div class="flex justify-center mb-3">
                                    <span id="val_rating"
                                          class="inline-block min-w-[56px] text-center text-2xl font-extrabold px-3 py-1 rounded-full"
                                          style="background: rgba(197,160,40,0.18); color: #e8c84a; border: 1px solid rgba(197,160,40,0.35);">
                                        {{ $old_input['bobot_rating'] ?? 30 }}%
                                    </span>
                                </div>
                                <input type="range" name="bobot_rating" id="slider_rating"
                                       min="1" max="100"
                                       class="w-full accent-gold-500 mb-3 cursor-pointer"
                                       value="{{ $old_input['bobot_rating'] ?? 30 }}"
                                       oninput="document.getElementById('val_rating').textContent = this.value + '%'">
                                <span class="text-sm text-gray-300 block">Rating pelanggan tertinggi</span>
                            </div>

                            <!-- Pengalaman -->
                            <div class="text-center bg-white/5 p-5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                                <label class="block text-gold-400 font-semibold text-lg mb-2">Pengalaman</label>
                                <div class="flex justify-center mb-3">
                                    <span id="val_pengalaman"
                                          class="inline-block min-w-[56px] text-center text-2xl font-extrabold px-3 py-1 rounded-full"
                                          style="background: rgba(197,160,40,0.18); color: #e8c84a; border: 1px solid rgba(197,160,40,0.35);">
                                        {{ $old_input['bobot_pengalaman'] ?? 20 }}%
                                    </span>
                                </div>
                                <input type="range" name="bobot_pengalaman" id="slider_pengalaman"
                                       min="1" max="100"
                                       class="w-full accent-gold-500 mb-3 cursor-pointer"
                                       value="{{ $old_input['bobot_pengalaman'] ?? 20 }}"
                                       oninput="document.getElementById('val_pengalaman').textContent = this.value + '%'">
                                <span class="text-sm text-gray-300 block">Transaksi selesai terbanyak</span>
                            </div>
                        </div>

                    </div>

                    <div class="text-center mt-10">
                        <button type="submit" class="inline-flex justify-center items-center w-full sm:w-auto px-6 sm:px-12 py-4 sm:py-5 bg-gold-500 hover:bg-gold-600 text-white text-base sm:text-xl font-bold rounded-full transition-transform transform hover:scale-105 shadow-[0_0_20px_rgba(197,160,40,0.4)]">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 me-2 sm:me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Cari Rekomendasi Vendor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- STATS MINI CARD -->
    <div class="relative z-20 -mt-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="stat-animate bg-white rounded-2xl p-8 text-center shadow-xl border border-gray-100 feature-card">
                <div class="w-14 h-14 rounded-full bg-amber-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="text-4xl font-extrabold gradient-text mb-1">{{ \App\Models\Vendor::where('is_verified', true)->count() }}+</div>
                <div class="text-gray-500 text-sm font-semibold uppercase tracking-widest">Vendor Aktif</div>
            </div>
            <div class="stat-animate bg-white rounded-2xl p-8 text-center shadow-xl border border-gray-100 feature-card">
                <div class="w-14 h-14 rounded-full bg-amber-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <div class="text-4xl font-extrabold gradient-text mb-1">{{ \App\Models\Category::count() }}+</div>
                <div class="text-gray-500 text-sm font-semibold uppercase tracking-widest">Kategori Vendor</div>
            </div>
            <div class="stat-animate bg-white rounded-2xl p-8 text-center shadow-xl border border-gray-100 feature-card">
                <div class="w-14 h-14 rounded-full bg-amber-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-4xl font-extrabold gradient-text mb-1">{{ \App\Models\User::where('role', 'user')->count() }}+</div>
                <div class="text-gray-500 text-sm font-semibold uppercase tracking-widest">Pelanggan Terdaftar</div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="wave-divider overflow-hidden leading-none mt-0 bg-champagne-light" style="margin-top:-2px">
        <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height:80px;width:100%;">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#f9f5ee"/>
        </svg>
    </div>

    <!-- Section: How It Works -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-serif text-charcoal mb-5">Bagaimana Sistem Bekerja?</h2>
                <div class="w-24 h-1.5 bg-gold-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-14 text-center">
                <div class="flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-2xl bg-champagne flex items-center justify-center mb-8 text-gold-600 group-hover:-translate-y-2 transition-transform duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-charcoal mb-4">1. Input Preferensi</h3>
                    <p class="text-gray-500 text-base leading-relaxed">Masukkan kategori, lokasi, budget, dan atur prioritas kriteria yang paling penting bagi acara Anda.</p>
                </div>

                <div class="flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-2xl bg-champagne flex items-center justify-center mb-8 text-gold-600 group-hover:-translate-y-2 transition-transform duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-charcoal mb-4">2. Analisis SAW</h3>
                    <p class="text-gray-500 text-base leading-relaxed">Algoritma mengevaluasi seluruh vendor aktif berdasarkan matriks bobot yang Anda berikan secara otomatis.</p>
                </div>

                <div class="flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-2xl bg-champagne flex items-center justify-center mb-8 text-gold-600 group-hover:-translate-y-2 transition-transform duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-charcoal mb-4">3. Pilih Vendor</h3>
                    <p class="text-gray-500 text-base leading-relaxed">Dapatkan hasil perankingan akurat dan hubungi vendor terbaik untuk mewujudkan acara impian Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hasil Rekomendasi Section -->
    <section class="py-24 bg-champagne-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(isset($error) && $error != null)
                <div class="bg-red-50 border-l-4 border-red-500 p-8 rounded-r-xl shadow-sm mb-12 flex items-center">
                    <svg class="w-10 h-10 text-red-500 me-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>
                        <h3 class="text-xl font-bold text-red-800 mb-1">Oops!</h3>
                        <p class="text-red-700 text-lg">{{ $error }}</p>
                    </div>
                </div>
            @endif

            @if(isset($vendors) && !isset($error))
                <div class="text-center mb-16">
                    <h3 class="text-4xl font-serif text-charcoal mb-4">Hasil Rekomendasi Terbaik Untuk Anda</h3>
                    <p class="text-gray-500 text-lg">Berdasarkan perhitungan algoritma SAW dari bobot yang Anda masukkan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($vendors as $item)
                        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col">

                            <!-- Cover Image & Badge -->
                            <div class="relative overflow-hidden h-72">
                                <div class="absolute top-4 right-4 z-10 bg-gold-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md">
                                    Skor SAW: {{ number_format($item->skor, 3) }}
                                </div>

                                @php
                                    $project = $item->data->projects->first();
                                    if ($project) {
                                        $cover = str_starts_with($project->cover_image, 'http') 
                                            ? $project->cover_image 
                                            : asset('storage/' . $project->cover_image);
                                    } else {
                                        $cover = 'https://via.placeholder.com/400x250?text=Belum+Ada+Foto';
                                    }
                                @endphp
                                <img src="{{ $cover }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Cover">

                                <!-- Gradient Overlay Bottom -->
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal/90 via-charcoal/20 to-transparent opacity-90"></div>
                                <h5 class="absolute bottom-5 left-5 text-white text-2xl font-bold font-serif">{{ $item->data->nama_bisnis }}</h5>
                            </div>

                            <!-- Card Body -->
                            <div class="p-8 flex-grow flex flex-col">
                                <p class="text-gray-500 text-base mb-5 flex items-center">
                                    <svg class="w-5 h-5 text-red-500 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Kec. {{ $item->data->address->kecamatan ?? 'Banda Aceh' }}
                                </p>

                                <div class="flex justify-between items-center mb-8 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <div class="flex items-center text-base font-medium text-charcoal">
                                        <svg class="w-5 h-5 text-yellow-400 me-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        {{ number_format($item->rating_tampil, 1) }}
                                    </div>
                                    <div class="w-px h-6 bg-gray-300"></div>
                                    <div class="flex items-center text-base font-medium text-charcoal">
                                        <svg class="w-5 h-5 text-blue-500 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        {{ $item->pengalaman_tampil }} Transaksi
                                    </div>
                                </div>

                                <div class="mb-8">
                                    <span class="text-sm text-gray-500 uppercase tracking-wider block mb-2">Mulai Dari</span>
                                    <h6 class="font-bold text-3xl text-gold-600">Rp {{ number_format($item->harga_tampil, 0, ',', '.') }}</h6>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('frontend.vendor.detail', $item->data->slug) }}" class="block w-full text-center py-4 px-5 bg-white border-2 border-charcoal text-charcoal hover:bg-charcoal hover:text-white font-bold text-lg rounded-xl transition-colors duration-300">
                                        Lihat Detail & Portofolio
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Footer Premium -->
    <footer class="bg-gradient-to-b from-gray-900 to-black pt-20 border-t-4 border-gold-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-12">

                <div class="pe-0 md:pe-8">
                    <a href="/" class="inline-flex items-center mb-6 group">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-300 shadow-lg" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(197,160,40,0.2);">
                            <x-application-logo class="w-10 h-10" />
                        </div>
                        <span class="text-4xl font-serif font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-gold-400 to-white tracking-wide">
                            EventVendor
                        </span>
                    </a>
                    <p class="text-gray-300 text-lg leading-relaxed font-normal">
                        Platform penyedia layanan pencarian vendor acara terbaik di Banda Aceh. Kami menggunakan <span class="text-gold-400 font-semibold">Sistem Pendukung Keputusan</span> cerdas untuk mencocokkan budget dan kebutuhan Anda secara presisi.
                    </p>
                </div>

                <div>
                    <h5 class="text-xl font-bold text-white mb-6 uppercase tracking-widest border-b border-gray-700 pb-3">Tentang Kami</h5>
                    <ul class="space-y-4 text-lg font-medium">
                        <li><a href="#" class="text-gray-400 hover:text-gold-400 hover:translate-x-1 inline-block transition-transform">Cara Kerja Metode SAW</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold-400 hover:translate-x-1 inline-block transition-transform">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold-400 hover:translate-x-1 inline-block transition-transform">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('vendor.register') }}" class="text-gold-400 hover:text-white hover:translate-x-1 inline-block transition-transform font-bold">Daftar Sebagai Vendor</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-xl font-bold text-white mb-6 uppercase tracking-widest border-b border-gray-700 pb-3">Hubungi Kami</h5>
                    <ul class="space-y-5 text-lg text-gray-300 mb-8 font-medium">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-gold-500 me-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Jl. Teuku Nyak Arief, Darussalam, Banda Aceh</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-gold-500 me-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            support@eventvendor.com
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-gold-500 me-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            +62 813 7675 2346
                        </li>
                    </ul>
                    <!-- Sosial Media dengan SVG -->
                    <div class="flex gap-3 mt-2">
                        <!-- Instagram -->
                        <a href="#" title="Instagram" class="inline-flex items-center justify-center w-11 h-11 border border-gray-600 rounded-full text-gray-300 hover:bg-gold-500 hover:border-gold-500 hover:text-white transition-all duration-300 shadow-md">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <!-- TikTok -->
                        <a href="#" title="TikTok" class="inline-flex items-center justify-center w-11 h-11 border border-gray-600 rounded-full text-gray-300 hover:bg-gold-500 hover:border-gold-500 hover:text-white transition-all duration-300 shadow-md">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.84 4.84 0 01-1.01-.06z"/></svg>
                        </a>
                        <!-- YouTube -->
                        <a href="#" title="YouTube" class="inline-flex items-center justify-center w-11 h-11 border border-gray-600 rounded-full text-gray-300 hover:bg-gold-500 hover:border-gold-500 hover:text-white transition-all duration-300 shadow-md">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 pb-10">
                <div class="text-center text-lg text-gray-500 font-medium">
                    &copy; {{ date('Y') }} EventVendor. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Script Vanilla JS: Hanya untuk efek Murni Crossfade (Lebih Halus) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const layers = document.querySelectorAll('.hero-layer');
            if(layers.length === 0) return;

            let currentIdx = 0;

            setInterval(() => {
                // Pudarkan gambar saat ini
                layers[currentIdx].classList.remove('opacity-100');
                layers[currentIdx].classList.add('opacity-0');

                // Pindah ke gambar berikutnya
                currentIdx = (currentIdx + 1) % layers.length;

                // Tampilkan gambar berikutnya
                layers[currentIdx].classList.remove('opacity-0');
                layers[currentIdx].classList.add('opacity-100');
            }, 6000); // 6 detik per gambar agar tidak terburu-buru
        });
    </script>
</x-public-layout>
