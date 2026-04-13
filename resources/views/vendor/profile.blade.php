@extends('layouts.admin_master')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Profil Bisnis Vendor</h2>

    @if(session('success'))
        <div class="alert alert-success fw-bold"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <form action="{{ route('vendor.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="fas fa-store"></i> Informasi Utama & Sosial Media
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Bisnis / Toko</label>
                            <input type="text" name="nama_bisnis" class="form-control" value="{{ $vendor->nama_bisnis }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat (Slogan)</label>
                            <input type="text" name="deskripsi_singkat" class="form-control" value="{{ $vendor->deskripsi_singkat }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tentang Kami (Detail)</label>
                            <textarea name="tentang_kami" class="form-control" rows="4" required>{{ $vendor->tentang_kami }}</textarea>
                        </div>

                        <hr>
                        <h6 class="fw-bold text-muted mb-3">Kontak & Sosial Media</h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-success"><i class="fab fa-whatsapp"></i> No. WhatsApp</label>
                            <input type="text" name="no_whatsapp" class="form-control" value="{{ $vendor->no_whatsapp }}" placeholder="Contoh: 6281234567890" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold" style="color: #E1306C;"><i class="fab fa-instagram"></i> Username IG</label>
                                <input type="text" name="instagram" class="form-control" value="{{ $vendor->instagram }}" placeholder="@vendor_ig">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold text-dark"><i class="fab fa-tiktok"></i> Username TikTok</label>
                                <input type="text" name="tiktok" class="form-control" value="{{ $vendor->tiktok }}" placeholder="@vendor_tiktok">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-danger text-white fw-bold">
                        <i class="fas fa-map-marker-alt"></i> Detail Alamat Lengkap (Banda Aceh)
                    </div>
                    <div class="card-body bg-light">
                        <div class="alert alert-warning small py-2 mb-4">
                            <i class="fas fa-info-circle"></i> Pastikan alamat diisi dengan lengkap dan benar agar pelanggan mudah menemukan lokasi Anda.
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Jalan / Gedung / Patokan</label>
                            <input type="text" name="jalan" class="form-control" value="{{ $vendor->address->jalan ?? '' }}" placeholder="Contoh: Jl. T. Hasan Dek No. 12 (Samping SPBU)" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Desa / Gampong</label>
                            <input type="text" name="desa" class="form-control" value="{{ $vendor->address->desa ?? '' }}" placeholder="Contoh: Beurawe" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kecamatan</label>
                            <select name="kecamatan" class="form-select" required>
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatans as $kec)
                                    <option value="{{ $kec }}" {{ (isset($vendor->address) && $vendor->address->kecamatan == $kec) ? 'selected' : '' }}>
                                        Kec. {{ $kec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-5 text-end">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm"><i class="fas fa-save"></i> Simpan Profil Bisnis</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
