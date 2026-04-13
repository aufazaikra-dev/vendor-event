<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Sebagai Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Gabung Jadi Vendor</h2>
                            <p class="text-muted">Raih lebih banyak klien untuk bisnis Anda.</p>
                        </div>

                        <form method="POST" action="{{ route('vendor.register') }}">
                            @csrf

                            <h6 class="fw-bold text-uppercase text-muted mb-3">Info Akun Login</h6>
                            <div class="mb-3">
                                <label class="form-label">Nama Pemilik</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required minlength="8">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Ulangi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <hr class="my-4">
                            <h6 class="fw-bold text-uppercase text-muted mb-3">Info Bisnis</h6>

                            <div class="mb-3">
                                <label class="form-label">Nama Bisnis / Toko</label>
                                <input type="text" name="nama_bisnis" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Kategori Jasa Utama</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori Jasa --</option>
                                        @foreach(\App\Models\Category::all() as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-4">
                                    <label class="form-label">Kota Operasional</label>
                                    <select name="city_id" class="form-select bg-light" style="pointer-events: none;" required>
                                        <option value="1" selected>Banda Aceh</option>
                                    </select>
                                    <small class="text-danger" style="font-size: 11px;">*Saat ini layanan hanya tersedia di Banda Aceh</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">Daftar Sekarang</button>
                            <div class="text-center mt-3">
                                <small>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
