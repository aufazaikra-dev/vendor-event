<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventVendor - Temukan Vendor Terbaik di Banda Aceh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Desain Background Animasi Lembut ala Web USK */
        .hero-section {
            position: relative;
            padding: 120px 0;
            color: white;
            overflow: hidden; /* Mencegah gambar tumpah ke luar saat efek zoom */
        }

        /* Layer Gambar untuk Crossfade */
        .hero-bg-layer {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -2;
            opacity: 0;
            /* Transisi super mulus 2 detik dan efek zoom (scale) pelan 6 detik */
            transition: opacity 2s ease-in-out, transform 6s linear;
            transform: scale(1);
        }

        /* Saat gambar aktif: muncul dan sedikit membesar (zoom-in pelan) */
        .hero-bg-layer.active {
            opacity: 1;
            transform: scale(1.05);
        }

        /* Layer Gradient Gelap (Overlay) agar teks putih selalu terbaca */
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(0, 0, 0, 0.7));
            z-index: -1;
        }
        .category-box { text-align: center; transition: 0.3s; cursor: pointer; color: #333; text-decoration: none; border-radius: 15px; }
        .category-box:hover { transform: translateY(-5px); color: #0d6efd; box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .category-icon { font-size: 2.5rem; margin-bottom: 15px; color: #0d6efd; }
        .footer-dark { background-color: #1a1a1a; color: #f8f9fa; padding: 50px 0 20px; }
        .footer-dark a { color: #adb5bd; text-decoration: none; transition: 0.3s; }
        .footer-dark a:hover { color: #fff; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="/"><i class="fas fa-ring"></i> EventVendor</a>
            <div class="ms-auto d-flex">
                @auth
                    @if(Auth::user()->role === 'vendor')
                        <a href="{{ route('vendor.dashboard') }}" class="btn btn-outline-primary me-2 fw-bold">Dashboard Vendor</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger me-2 fw-bold">Dashboard Admin</a>
                    @else
                        <span class="navbar-text me-3 d-none d-md-block">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                        <a href="{{ route('user.transactions') }}" class="btn btn-outline-primary me-3 fw-bold"><i class="fas fa-shopping-bag"></i> Pesanan Saya</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger fw-bold">Logout</button>
                    </form>
                @else
                    <a href="{{ route('vendor.register') }}" class="btn btn-outline-primary me-2 fw-bold">Jadi Vendor</a>
                    <a href="{{ route('login') }}" class="btn btn-primary fw-bold">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div class="hero-bg-layer active" style="background-image: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2070&auto=format&fit=crop');"></div>
        <div class="hero-bg-layer" style="background-image: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop');"></div>
        <div class="hero-bg-layer" style="background-image: url('https://t4.ftcdn.net/jpg/00/80/36/21/360_F_80362106_deNgYJ5oiK13697NhgxS6G9YpGOd1TlV.jpg');"></div>

        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3 shadow-sm">Wujudkan Acara Impian Anda</h1>
                    <p class="lead fw-light">Sistem Cerdas Pemilihan Vendor di Banda Aceh menggunakan Metode SAW.</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-4 p-4 text-dark bg-white">
                        <form action="/" method="GET">
                            <input type="hidden" name="cari" value="yes">

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small text-muted">Kategori Jasa</label>
                                    <select name="kategori" class="form-select form-select-lg">
                                        <option value="">Semua Kategori</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ (isset($old_input['kategori']) && $old_input['kategori'] == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small text-muted">Kecamatan (Banda Aceh)</label>
                                    <select name="kecamatan" class="form-select form-select-lg">
                                        <option value="">Semua Kecamatan</option>
                                        @foreach($kecamatans as $kec)
                                            <option value="{{ $kec }}" {{ (isset($old_input['kecamatan']) && $old_input['kecamatan'] == $kec) ? 'selected' : '' }}>{{ $kec }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small text-muted"><i class="fas fa-wallet text-success"></i> Budget Max (Rp)</label>
                                    <input type="number" name="max_budget" class="form-control form-control-lg" placeholder="Contoh: 5000000" value="{{ $old_input['max_budget'] ?? '' }}">
                                </div>
                            </div>

                            <hr>
                            <h5 class="fw-bold mb-3 text-center">Atur Prioritas Rekomendasi (Metode SAW)</h5>
                            <div class="row g-4 mt-1">
                                <div class="col-md-4 text-center">
                                    <label class="form-label fw-bold text-success mb-0">Prioritas Harga</label>
                                    <input type="range" class="form-range" name="bobot_harga" value="{{ $old_input['bobot_harga'] ?? 50 }}">
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">*Geser ke kanan jika Anda mengutamakan harga yang <b>paling murah</b>.</small>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label class="form-label fw-bold text-warning mb-0">Prioritas Rating</label>
                                    <input type="range" class="form-range" name="bobot_rating" value="{{ $old_input['bobot_rating'] ?? 30 }}">
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">*Geser ke kanan jika Anda mengutamakan <b>kualitas & ulasan terbaik</b>.</small>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label class="form-label fw-bold text-primary mb-0">Prioritas Pengalaman</label>
                                    <input type="range" class="form-range" name="bobot_pengalaman" value="{{ $old_input['bobot_pengalaman'] ?? 20 }}">
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">*Geser ke kanan jika Anda mencari vendor dengan <b>jam terbang tertinggi</b>.</small>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">
                                    <i class="fas fa-search me-2"></i> Cari Rekomendasi Vendor
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        @if(isset($error) && $error != null)
            <div class="alert alert-danger text-center shadow-sm rounded-3 py-4">
                <i class="fas fa-search-minus fa-2x mb-2"></i><br>
                <strong>Oops!</strong> {{ $error }}
            </div>
        @endif

        @if(isset($vendors) && !isset($error))
            <h3 class="fw-bold mb-4 text-center">Hasil Rekomendasi Terbaik Untuk Anda</h3>
            <div class="row g-4">
                @foreach($vendors as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden position-relative">

                            <div class="position-absolute top-0 end-0 m-3 badge bg-success shadow fs-6">
                                Skor SAW: {{ number_format($item->skor, 3) }}
                            </div>

                            @php
                                $cover = $item->data->projects->first() ? asset('storage/'.$item->data->projects->first()->cover_image) : 'https://via.placeholder.com/400x250?text=Belum+Ada+Foto';
                            @endphp
                            <img src="{{ $cover }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="Cover">

                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-1">{{ $item->data->nama_bisnis }}</h5>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-map-marker-alt text-danger"></i> Kec. {{ $item->data->address->kecamatan ?? 'Banda Aceh' }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-light text-dark border p-2"><i class="fas fa-star text-warning"></i> {{ number_format($item->rating_tampil, 1) }}</span>
                                    <span class="badge bg-light text-dark border p-2"><i class="fas fa-handshake text-primary"></i> {{ $item->pengalaman_tampil }} Transaksi</span>
                                </div>
                                <h6 class="fw-bold text-success mb-3">Mulai Rp {{ number_format($item->harga_tampil, 0, ',', '.') }}</h6>

                                <a href="{{ route('frontend.vendor.detail', $item->data->slug) }}" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                    Lihat Detail & Portofolio
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <footer class="footer-dark mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold text-white mb-3"><i class="fas fa-ring text-primary"></i> EventVendor</h5>
                    <p class="small text-light" style="opacity: 0.85;">Platform penyedia layanan pencarian vendor acara terbaik di Banda Aceh. Kami menggunakan Sistem Pendukung Keputusan cerdas untuk mencocokkan budget dan kebutuhan Anda.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold text-white mb-3">Tentang Kami</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#">Cara Kerja Metode SAW</a></li>
                        <li class="mb-2"><a href="#">Syarat & Ketentuan</a></li>
                        <li class="mb-2"><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('vendor.register') }}">Daftar Sebagai Vendor</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold text-white mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled small text-light" style="opacity: 0.85;">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Jl. Teuku Nyak Arief, Darussalam, Banda Aceh</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i> support@eventvendor.com</li>
                        <li class="mb-3"><i class="fas fa-phone me-2 text-primary"></i> +62 813 7675 2346</li>
                    </ul>
                    <div>
                        <a href="#" class="btn btn-outline-light btn-sm me-2 rounded-circle"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm me-2 rounded-circle"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="text-center small text-light" style="opacity: 0.6;">
                &copy; {{ date('Y') }} EventVendor. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const layers = document.querySelectorAll('.hero-bg-layer');
            let currentIdx = 0;

            setInterval(() => {
                // Hilangkan status aktif dari gambar saat ini (memudar)
                layers[currentIdx].classList.remove('active');

                // Lanjut ke gambar berikutnya
                currentIdx = (currentIdx + 1) % layers.length;

                // Aktifkan gambar berikutnya (muncul perlahan dengan efek zoom)
                layers[currentIdx].classList.add('active');
            }, 4000); // Berubah setiap 4 detik (sangat ideal untuk dibaca)
        });
    </script>
</body>
</html>
