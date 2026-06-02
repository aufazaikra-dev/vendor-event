@extends('layouts.admin_master')
@section('title', 'Profil Bisnis')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Profil Bisnis</h1>
    <p class="adm-page-subtitle">Lengkapi informasi bisnis Anda agar mudah ditemukan pelanggan.</p>
</div>

@if(session('success'))
    <div class="adm-alert-success">
        <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('vendor.profile.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Kolom Kiri: Info Utama -->
        <div class="col-md-6 mb-4">
            <div class="adm-card h-100">
                <div class="adm-card-header">
                    <span class="adm-card-title" style="display:flex;align-items:center;gap:8px;">
                        <svg style="width:16px;height:16px;color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Informasi Utama & Sosial Media
                    </span>
                </div>
                <div style="padding:24px;display:flex;flex-direction:column;gap:18px;">

                    <div>
                        <label class="adm-field-label">Nama Bisnis / Toko</label>
                        <input type="text" name="nama_bisnis" class="adm-field-input"
                               value="{{ $vendor->nama_bisnis }}" placeholder="Contoh: Budi Wedding Organizer" required>
                    </div>

                    <div>
                        <label class="adm-field-label">Deskripsi Singkat (Slogan)</label>
                        <input type="text" name="deskripsi_singkat" class="adm-field-input"
                               value="{{ $vendor->deskripsi_singkat }}" placeholder="Muncul di kartu pencarian" required>
                    </div>

                    <div>
                        <label class="adm-field-label">Tentang Kami (Detail)</label>
                        <textarea name="tentang_kami" class="adm-field-input" rows="4"
                                  placeholder="Ceritakan keunggulan bisnis Anda..." required>{{ $vendor->tentang_kami }}</textarea>
                    </div>

                    <div style="border-top:1px solid rgba(184,134,11,0.1);padding-top:18px;">
                        <div style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#B8860B;margin-bottom:14px;">Kontak & Sosial Media</div>

                        <div style="margin-bottom:14px;">
                            <label class="adm-field-label" style="display:flex;align-items:center;gap:6px;">
                                <svg style="width:14px;height:14px;color:#16a34a;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.556 4.116 1.528 5.849L.057 23.27c-.078.316.201.595.517.517l5.421-1.472C7.884 23.444 9.877 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>
                                No. WhatsApp
                            </label>
                            <input type="text" name="no_whatsapp" class="adm-field-input"
                                   value="{{ $vendor->no_whatsapp }}" placeholder="Contoh: 6281234567890" required>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="adm-field-label">Instagram</label>
                                <input type="text" name="instagram" class="adm-field-input"
                                       value="{{ $vendor->instagram }}" placeholder="@username_ig">
                            </div>
                            <div class="col-6">
                                <label class="adm-field-label">TikTok</label>
                                <input type="text" name="tiktok" class="adm-field-input"
                                       value="{{ $vendor->tiktok }}" placeholder="@username_tiktok">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail Alamat -->
        <div class="col-md-6 mb-4">
            <div class="adm-card h-100">
                <div class="adm-card-header">
                    <span class="adm-card-title" style="display:flex;align-items:center;gap:8px;">
                        <svg style="width:16px;height:16px;color:#dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Detail Alamat (Banda Aceh)
                    </span>
                </div>
                <div style="padding:24px;display:flex;flex-direction:column;gap:18px;">

                    <div style="display:flex;align-items:start;gap:10px;padding:12px 14px;background:rgba(234,179,8,0.07);border:1px solid rgba(234,179,8,0.18);border-radius:10px;">
                        <svg style="width:16px;height:16px;color:#ca8a04;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span style="font-size:14px;color:#4a4a6a;">Pastikan alamat diisi dengan lengkap dan benar agar pelanggan mudah menemukan lokasi Anda.</span>
                    </div>

                    <div>
                        <label class="adm-field-label">Nama Jalan / Gedung / Patokan</label>
                        <input type="text" name="jalan" class="adm-field-input"
                               value="{{ $vendor->address->jalan ?? '' }}"
                               placeholder="Contoh: Jl. T. Hasan Dek No. 12 (Samping SPBU)" required>
                    </div>

                    <div>
                        <label class="adm-field-label">Nama Desa / Gampong</label>
                        <input type="text" name="desa" class="adm-field-input"
                               value="{{ $vendor->address->desa ?? '' }}"
                               placeholder="Contoh: Beurawe" required>
                    </div>

                    <div>
                        <label class="adm-field-label">Kecamatan</label>
                        <select name="kecamatan" class="adm-field-input adm-field-select" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec }}" {{ (isset($vendor->address) && $vendor->address->kecamatan == $kec) ? 'selected' : '' }}>
                                    Kec. {{ $kec }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-top:auto;padding-top:16px;">
                        <button type="submit" class="adm-btn adm-btn-primary" style="width:100%;justify-content:center;padding:12px;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            Simpan Profil Bisnis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .adm-field-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        color: #B8860B;
        margin-bottom: 6px;
    }
    .adm-field-input {
        display: block;
        width: 100%;
        padding: 10px 14px;
        background: #F8F6F0;
        border: 1px solid rgba(184,134,11,0.2);
        border-radius: 10px;
        color: #1a1a2e;
        font-size: 15px;
        font-family: 'Inter', sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .adm-field-input::placeholder { color: #9a9ab0; }
    .adm-field-input:focus {
        outline: none;
        border-color: #B8860B;
        box-shadow: 0 0 0 3px rgba(184,134,11,0.1);
        background: #ffffff;
    }
    .adm-field-select option { background: #fff; color: #1a1a2e; }
</style>
@endsection
