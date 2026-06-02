<x-public-layout>
    <style>
        /* ── FONTS ── */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap');

        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; }

        /* ── ANIMATIONS ── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }

        /* ── HERO BANNER ── */
        .txn-hero {
            background:
                linear-gradient(to bottom, rgba(17,24,39,0.75), rgba(10,14,23,0.95)),
                url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=2073&auto=format&fit=crop')
                center/cover no-repeat;
            padding: 160px 0 80px;
            text-align: center;
        }

        /* ── GRADIENT TEXT ── */
        .gradient-text {
            background: linear-gradient(135deg, #C5A028, #e8c84a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── CARD ── */
        .txn-card {
            background: #ffffff;
            border: 1px solid rgba(184,134,11,0.15);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .txn-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.1);
        }
        .txn-card-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid rgba(184,134,11,0.1);
            background: linear-gradient(135deg, #FDFAF4, #F8F6F0);
        }

        /* ── BADGE ── */
        .badge-selesai {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 50px; font-size: 11px; font-weight: 700;
            letter-spacing: 0.8px; text-transform: uppercase;
            background: rgba(22,163,74,0.1); color: #16a34a; border: 1px solid rgba(22,163,74,0.25);
        }
        .badge-proses {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 50px; font-size: 11px; font-weight: 700;
            letter-spacing: 0.8px; text-transform: uppercase;
            background: rgba(234,88,12,0.1); color: #ea580c; border: 1px solid rgba(234,88,12,0.25);
        }
        .badge-pending {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 50px; font-size: 11px; font-weight: 700;
            letter-spacing: 0.8px; text-transform: uppercase;
            background: rgba(234,179,8,0.1); color: #ca8a04; border: 1px solid rgba(234,179,8,0.25);
        }

        /* ── REVIEW FORM AREA ── */
        .review-prompt {
            background: linear-gradient(135deg, rgba(37,99,235,0.05), rgba(37,99,235,0.02));
            border: 1px solid rgba(37,99,235,0.15);
            border-radius: 12px;
            padding: 18px;
        }
        .review-done {
            background: #FDFAF4;
            border: 1px solid rgba(184,134,11,0.15);
            border-radius: 12px;
            padding: 16px;
        }
        .review-pending-msg {
            background: rgba(234,88,12,0.05);
            border: 1px solid rgba(234,88,12,0.15);
            border-radius: 12px;
            padding: 14px 18px;
        }

        /* ── FORM ELEMENTS ── */
        .lux-select, .lux-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid rgba(184,134,11,0.2);
            border-radius: 10px;
            background: #F8F6F0;
            color: #1a1a2e;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .lux-select:focus, .lux-textarea:focus {
            border-color: #B8860B;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.1);
            background: #fff;
        }
        .lux-textarea { resize: none; }
        .lux-btn-gold {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #B8860B, #D4A017);
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(184,134,11,0.25);
        }
        .lux-btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(184,134,11,0.35);
        }

        /* ── STAR RATING ── */
        .stars {
            display: flex; gap: 3px;
            font-size: 16px;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            background: #FDFAF4;
            border: 2px dashed rgba(184,134,11,0.3);
            border-radius: 24px;
            padding: 72px 32px;
            text-align: center;
        }
        .empty-icon-wrap {
            width: 96px; height: 96px;
            background: rgba(184,134,11,0.08);
            border: 1px solid rgba(184,134,11,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
        }

        /* ── SEPARATOR ── */
        .gold-divider {
            border: none;
            border-top: 1px solid rgba(184,134,11,0.12);
            margin: 16px 0;
        }

        /* ── STAT BAR ── */
        .stat-bar {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }
        .stat-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(184,134,11,0.08);
            border: 1px solid rgba(184,134,11,0.2);
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #B8860B;
        }
        .stat-chip svg { width: 15px; height: 15px; }

        /* ── FOOTER ── */
        .txn-footer {
            background: linear-gradient(to bottom, #111827, #000000);
            border-top: 3px solid #B8860B;
            padding: 32px 0;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
    </style>

    <!-- ─── NAVBAR ─── -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm" style="padding: 14px 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Left: Back to home -->
            <a href="/" class="flex items-center gap-2 font-semibold text-sm" style="color:#B8860B;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>

            <!-- Right: User info + logout -->
            <div class="flex items-center gap-3">
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-full" style="background:rgba(184,134,11,0.08); border:1px solid rgba(184,134,11,0.2);">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs font-bold" style="background:linear-gradient(135deg,#B8860B,#D4A017);">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-semibold" style="color:#1a1a2e;">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 text-sm font-medium px-3 py-1.5 rounded-full transition-all" style="color:#7a7a9a; border:1px solid rgba(184,134,11,0.15);" onmouseover="this.style.color='#dc2626'; this.style.borderColor='rgba(220,38,38,0.3)';" onmouseout="this.style.color='#7a7a9a'; this.style.borderColor='rgba(184,134,11,0.15)';">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ─── HERO SECTION ─── -->
    <section class="txn-hero">
        <div class="max-w-3xl mx-auto px-4">
            <p class="fade-in-up text-xs font-bold tracking-widest uppercase mb-4" style="color:#C5A028;">Akun Saya</p>
            <h1 class="fade-in-up delay-1 text-4xl md:text-5xl font-bold mb-4 text-white" style="font-family:'Playfair Display', serif; line-height:1.2;">
                Riwayat <span class="gradient-text">Pesanan</span> Saya
            </h1>
            <p class="fade-in-up delay-2 text-gray-300 text-lg">
                Pantau status pemesanan dan berikan ulasan untuk vendor favorit Anda.
            </p>
        </div>
    </section>

    <!-- ─── CONTENT AREA ─── -->
    <div style="background: linear-gradient(to bottom, #F8F6F0, #FDFAF4); min-height: 60vh; padding: 48px 0 80px;">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Bar -->
            <div class="fade-in-up delay-1 flex flex-wrap gap-3 mb-8">
                @php
                    $totalPesanan   = $transactions->count();
                    $totalSelesai   = $transactions->where('status', 'selesai')->count();
                    $totalBerjalan  = $transactions->where('status', '!=', 'selesai')->count();
                @endphp
                <div class="stat-chip">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    {{ $totalPesanan }} Total Pesanan
                </div>
                <div class="stat-chip" style="background:rgba(22,163,74,0.08); border-color:rgba(22,163,74,0.2); color:#16a34a;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $totalSelesai }} Selesai
                </div>
                <div class="stat-chip" style="background:rgba(234,88,12,0.08); border-color:rgba(234,88,12,0.2); color:#ea580c;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $totalBerjalan }} Berjalan
                </div>
            </div>

            <!-- Transactions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @forelse($transactions as $index => $trx)

                    @php
                        $delayClass = 'delay-' . min($index + 1, 5);
                    @endphp

                    <div class="txn-card fade-in-up {{ $delayClass }}">

                        <!-- Card Header -->
                        <div class="txn-card-header">
                            <div class="flex justify-between items-start gap-3">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs mb-1.5 flex items-center gap-1.5" style="color:#9a9ab0;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        <code class="font-mono font-bold" style="color:#B8860B;">{{ $trx->kode_pesanan }}</code>
                                    </p>
                                    <h4 class="font-bold text-lg truncate" style="color:#1a1a2e; font-family:'Playfair Display', serif;">
                                        {{ $trx->vendor->nama_bisnis ?? 'Vendor Dihapus' }}
                                    </h4>
                                    <p class="text-sm mt-0.5" style="color:#6b7280;">{{ $trx->pricelist->nama_paket ?? 'Paket Dihapus' }}</p>
                                </div>
                                <!-- Status Badge -->
                                <div class="flex-shrink-0">
                                    @if($trx->status == 'selesai')
                                        <span class="badge-selesai">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Selesai
                                        </span>
                                    @elseif($trx->status == 'diproses')
                                        <span class="badge-proses">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            Diproses
                                        </span>
                                    @else
                                        <span class="badge-pending">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ ucfirst(str_replace('_', ' ', $trx->status)) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div style="padding: 20px 24px;">

                            @if($trx->status == 'selesai' && !$trx->review)
                                <!-- Prompt to Review -->
                                <div class="review-prompt">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(37,99,235,0.1);">
                                            <svg class="w-4 h-4" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                        </div>
                                        <p class="font-bold text-sm" style="color:#2563eb;">Bagikan pengalaman Anda!</p>
                                    </div>
                                    <form action="{{ route('user.review.store', $trx->id) }}" method="POST" class="space-y-3">
                                        @csrf
                                        <select name="rating" class="lux-select" required>
                                            <option value="">⭐ Pilih Rating Bintang...</option>
                                            <option value="5">⭐⭐⭐⭐⭐ — Sangat Puas (5/5)</option>
                                            <option value="4">⭐⭐⭐⭐ — Puas (4/5)</option>
                                            <option value="3">⭐⭐⭐ — Cukup (3/5)</option>
                                            <option value="2">⭐⭐ — Kurang (2/5)</option>
                                            <option value="1">⭐ — Buruk (1/5)</option>
                                        </select>
                                        <textarea name="komentar" class="lux-textarea" rows="2" placeholder="Ceritakan pengalaman Anda bersama vendor ini..." required></textarea>
                                        <button type="submit" class="lux-btn-gold">
                                            Kirim Ulasan Sekarang
                                        </button>
                                    </form>
                                </div>

                            @elseif($trx->review)
                                <!-- Review Already Submitted -->
                                <div class="review-done">
                                    <p class="text-xs font-bold uppercase tracking-wider mb-2" style="color:#B8860B;">Ulasan Anda</p>
                                    <!-- Stars -->
                                    <div class="stars mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $trx->review->rating)
                                                <span style="color:#FBBF24;">★</span>
                                            @else
                                                <span style="color:#D1D5DB;">★</span>
                                            @endif
                                        @endfor
                                        <span class="text-sm font-semibold ml-1" style="color:#1a1a2e;">{{ $trx->review->rating }}/5</span>
                                    </div>
                                    <p class="text-sm italic leading-relaxed" style="color:#4a4a6a;">"{{ $trx->review->komentar }}"</p>

                                    @if($trx->review->balasan_vendor)
                                        <div class="mt-3 pt-3" style="border-top: 1px solid rgba(184,134,11,0.15);">
                                            <div class="flex items-center gap-2 mb-1">
                                                <div class="w-5 h-5 rounded-full flex items-center justify-center" style="background:#B8860B;">
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                                                    </svg>
                                                </div>
                                                <p class="text-sm font-bold" style="color:#B8860B;">Balasan Vendor</p>
                                            </div>
                                            <p class="text-sm leading-relaxed" style="color:#4a4a6a;">{{ $trx->review->balasan_vendor }}</p>
                                        </div>
                                    @endif
                                </div>

                            @else
                                <!-- Order Not Finished -->
                                <div class="review-pending-msg">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 flex-shrink-0" style="color:#ea580c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-sm" style="color:#7a7a9a;">Ulasan tersedia setelah vendor menandai pesanan sebagai <strong style="color:#1a1a2e;">selesai</strong>.</p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                @empty
                    <!-- Empty State -->
                    <div class="col-span-full empty-state fade-in-up">
                        <div class="empty-icon-wrap">
                            <svg class="w-12 h-12" style="color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-3" style="color:#1a1a2e; font-family:'Playfair Display', serif;">
                            Belum Ada Pesanan
                        </h2>
                        <p class="text-base mb-8 max-w-sm mx-auto" style="color:#7a7a9a;">
                            Anda belum memiliki riwayat pemesanan. Temukan vendor terbaik untuk acara Anda sekarang!
                        </p>
                        <a href="/" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-bold text-white text-base transition-all hover:-translate-y-1"
                           style="background:linear-gradient(135deg,#B8860B,#D4A017); box-shadow:0 6px 24px rgba(184,134,11,0.35);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari Vendor Sekarang
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

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

    <!-- SweetAlert2 (inherited via public layout, duplicated for session flashes) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{!! session('success') !!}', confirmButtonColor: '#B8860B' });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Gagal!', text: '{!! session('error') !!}', confirmButtonColor: '#dc2626' });
            @endif
        });
    </script>

</x-public-layout>
