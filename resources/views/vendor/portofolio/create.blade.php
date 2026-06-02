@extends('layouts.admin_master')
@section('title', 'Upload Portofolio')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Upload Foto Portofolio</h1>
    <p class="adm-page-subtitle">Tambahkan foto acara terbaik Anda untuk ditampilkan kepada calon klien.</p>
</div>

<div style="max-width:580px;">
    <div class="adm-card">
        <div class="adm-card-header">
            <span class="adm-card-title" style="display:flex;align-items:center;gap:8px;">
                <svg style="width:16px;height:16px;color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Form Upload Foto Acara
            </span>
        </div>
        <div style="padding:24px;">

            @if($errors->any())
                <div style="display:flex;align-items:start;gap:10px;padding:14px;background:rgba(220,38,38,0.07);border:1px solid rgba(220,38,38,0.2);border-radius:10px;margin-bottom:18px;">
                    <svg style="width:16px;height:16px;color:#dc2626;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span style="font-size:14px;color:#dc2626;">File gambar terlalu besar atau format tidak didukung. Gunakan JPG/PNG maksimal 2MB.</span>
                </div>
            @endif

            <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data"
                  style="display:flex;flex-direction:column;gap:18px;">
                @csrf

                <div>
                    <label class="adm-field-label">Judul Acara / Project</label>
                    <input type="text" name="judul_project" class="adm-field-input"
                           placeholder="Contoh: Wedding Budi & Ani — Banda Aceh" required>
                </div>

                <div>
                    <label class="adm-field-label">Upload Foto (Max 2MB — JPG/PNG)</label>
                    <div style="border:2px dashed rgba(184,134,11,0.25);border-radius:12px;padding:24px;text-align:center;cursor:pointer;background:#FDFAF4;transition:border-color 0.2s,background 0.2s;"
                         onclick="document.getElementById('fileInput').click()"
                         onmouseover="this.style.borderColor='rgba(184,134,11,0.5)';this.style.background='#FFF9ED'"
                         onmouseout="this.style.borderColor='rgba(184,134,11,0.25)';this.style.background='#FDFAF4'">
                        <svg style="width:36px;height:36px;color:rgba(184,134,11,0.5);margin:0 auto 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p style="color:#4a4a6a;font-size:14px;margin:0 0 4px;">Klik untuk pilih foto</p>
                        <p style="color:#9a9ab0;font-size:11px;margin:0;" id="fileLabel">JPG, PNG — Maks. 2MB</p>
                    </div>
                    <input type="file" id="fileInput" name="cover_image"
                           accept="image/png, image/jpeg, image/jpg"
                           style="display:none;" required
                           onchange="document.getElementById('fileLabel').textContent = this.files[0]?.name || 'JPG, PNG — Maks. 2MB'">
                </div>

                <div>
                    <label class="adm-field-label">Cerita Singkat (Opsional)</label>
                    <textarea name="deskripsi" class="adm-field-input" style="height:90px;"
                              placeholder="Ceritakan keseruan acara ini..."></textarea>
                </div>

                <div style="display:flex;gap:10px;padding-top:8px;">
                    <button type="submit" class="adm-btn adm-btn-primary" style="flex:1;justify-content:center;padding:11px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Upload Portofolio
                    </button>
                    <a href="{{ route('portofolio.index') }}" class="adm-btn adm-btn-outline-red" style="flex:1;justify-content:center;padding:11px;">
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
