<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $vendor->nama_bisnis }} - Profil Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-banner {
            height: 300px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop') center/cover;
            color: white;
            display: flex;
            align-items: center;
        }
        .blur-overlay {
            position: absolute; bottom: 0; left: 0; right: 0; top: 0;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(5px);
            display: flex; align-items: center; justify-content: center;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-light bg-white shadow-sm mb-0">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand fw-bold text-primary" href="/">
                <i class="fas fa-arrow-left"></i> Kembali ke Pencarian
            </a>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Masuk / Daftar</a>
            @endguest
        </div>
    </nav>

    <div class="hero-banner">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">{{ $vendor->nama_bisnis }}</h1>
            <p class="lead">{{ $vendor->deskripsi_singkat }}</p>
            {{-- <span class="badge bg-success px-3 py-2 fs-6 mt-2">
                <i class="fas fa-check-circle"></i> Vendor Terverifikasi
            </span> --}}
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        <h4 class="fw-bold border-bottom pb-2 mb-3">Tentang Kami</h4>
                        <p class="text-muted" style="white-space: pre-line;">{{ $vendor->tentang_kami }}</p>

                        <h5 class="fw-bold mt-4"><i class="fas fa-map-marker-alt text-danger"></i> Alamat Lengkap:</h5>
                        <p class="text-muted">{{ $vendor->address->jalan }}, {{ $vendor->address->desa }}, {{ $vendor->address->kecamatan }}</p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        <h4 class="fw-bold border-bottom pb-2 mb-3">Daftar Paket Harga (Pricelist)</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Fasilitas</th>
                                        <th class="text-end">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vendor->pricelists as $paket)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $paket->nama_paket }}</td>
                                        <td><small class="text-muted">{{ $paket->fitur_paket }}</small></td>
                                        <td class="text-end fw-bold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center text-muted">Belum ada paket harga.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4 border-0 sticky-top" style="top: 20px;">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Tertarik dengan Vendor ini?</h5>
                        <p class="text-muted small">Diskusikan acara impian Anda langsung dengan vendor.</p>

                        @auth
                            <a href="https://wa.me/{{ $vendor->no_whatsapp }}" target="_blank" class="btn btn-success btn-lg w-100 mb-3 shadow">
                                <i class="fab fa-whatsapp fs-5"></i> Chat via WhatsApp
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3 shadow">
                                <i class="fas fa-lock"></i> Masuk untuk Hubungi Vendor
                            </a>
                            <p class="small text-danger">Anda harus login terlebih dahulu untuk melihat nomor kontak.</p>
                        @endauth
                        <hr>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-muted">Total Portofolio:</span>
                            <span class="fw-bold fs-5">{{ $vendor->projects->count() }} Album</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold mb-4 mt-2">Galeri Portofolio Acara</h4>
        <div class="row g-4 position-relative">

            @php
                // Jika belum login, ambil 3 foto saja. Jika sudah login, ambil semua.
                $photos = auth()->check() ? $vendor->projects : $vendor->projects->take(3);
                $totalPhotos = $vendor->projects->count();
            @endphp

            @forelse($photos as $foto)
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ asset('storage/' . $foto->cover_image) }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Portofolio">
                    <div class="card-body text-center">
                        <h6 class="fw-bold mb-0">{{ $foto->judul_project }}</h6>
                        <small class="text-muted">{{ $foto->deskripsi }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>Vendor ini belum mengunggah foto portofolio acara.</p>
            </div>
            @endforelse

            @if(!auth()->check() && $totalPhotos > 3)
            <div class="col-12 mt-4 text-center">
                <div class="p-4 bg-white shadow-sm border rounded-4">
                    <h5 class="fw-bold text-dark"><i class="fas fa-images text-primary"></i> Ada {{ $totalPhotos - 3 }} foto lainnya yang disembunyikan.</h5>
                    <p class="text-muted mb-3">Login sekarang untuk melihat seluruh portofolio dan ulasan klien.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-5">Daftar / Masuk Sekarang</a>
                </div>
            </div>
            @endif

        </div>
    </div>

    <h4 class="fw-bold mb-4 mt-5 border-top pt-4">Ulasan Klien</h4>
    <div class="row">
        <div class="col-lg-8">
            @forelse($vendor->reviews as $rev)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-1">{{ $rev->user->name }}</h6>
                        <span class="text-warning"><i class="fas fa-star"></i> {{ $rev->rating }}/5</span>
                    </div>
                    <p class="text-muted mb-0 small">{{ $rev->komentar }}</p>
                </div>
            </div>
            @empty
            <div class="alert alert-light border">Belum ada ulasan untuk vendor ini.</div>
            @endforelse
        </div>

        <div class="col-lg-4">
            @auth
                @if(auth()->user()->role === 'user')
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold">Tulis Pengalaman Anda</h6>

                        @if(session('success'))
                            <div class="alert alert-success py-2 mt-2">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger py-2 mt-2">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('review.store', $vendor->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Beri Bintang (1-5)</label>
                                <select name="rating" class="form-select" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Puas)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 - Puas)</option>
                                    <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                                    <option value="2">⭐⭐ (2 - Kurang)</option>
                                    <option value="1">⭐ (1 - Buruk)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Komentar</label>
                                <textarea name="komentar" class="form-control" rows="3" required placeholder="Ceritakan kepuasan Anda..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim Ulasan</button>
                        </form>
                    </div>
                </div>
                @endif
            @endauth
        </div>
    </div>

</body>
</html>
