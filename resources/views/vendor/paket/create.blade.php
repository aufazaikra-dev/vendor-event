@extends('layouts.admin_master')
@section('title', 'Tambah Paket Baru')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Tambah Paket Baru</h1>
    <p class="adm-page-subtitle">Isi informasi paket jasa yang ingin Anda tawarkan kepada klien.</p>
</div>

<div style="max-width:600px;">
    <div class="adm-card">
        <div class="adm-card-header">
            <span class="adm-card-title" style="display:flex;align-items:center;gap:8px;">
                <svg style="width:16px;height:16px;color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Form Input Paket
            </span>
        </div>
        <div style="padding:24px;">
            <form action="{{ route('paket.store') }}" method="POST" style="display:flex;flex-direction:column;gap:18px;">
                @csrf

                <div>
                    <label class="adm-field-label">Nama Paket</label>
                    <input type="text" name="nama_paket" class="adm-field-input"
                           placeholder="Contoh: Paket Wedding Gold" required>
                </div>

                <div>
                    <label class="adm-field-label">Harga (Rupiah)</label>
                    <div style="display:flex;align-items:center;gap:0;">
                        <span style="padding:12px 16px;background:rgba(184,134,11,0.08);border:1px solid rgba(184,134,11,0.2);border-right:none;border-radius:10px 0 0 10px;font-size:15px;font-weight:700;color:#B8860B;">Rp</span>
                        <input type="number" name="harga" class="adm-field-input"
                               style="border-radius:0 10px 10px 0;"
                               placeholder="5000000" required>
                    </div>
                    <p style="font-size:11px;color:#9a9ab0;margin-top:4px;">Masukkan angka saja tanpa titik atau koma.</p>
                </div>

                <div>
                    <label class="adm-field-label">Fitur & Fasilitas</label>
                    <textarea name="fitur_paket" class="adm-field-input" style="height:110px;"
                              placeholder="Jelaskan apa saja yang termasuk dalam paket ini..." required></textarea>
                </div>

                <div style="display:flex;gap:10px;padding-top:8px;">
                    <button type="submit" class="adm-btn adm-btn-primary" style="flex:1;justify-content:center;padding:11px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Simpan Paket
                    </button>
                    <a href="{{ route('paket.index') }}" class="adm-btn adm-btn-outline-red" style="flex:1;justify-content:center;padding:11px;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

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
</style>
@endsection
