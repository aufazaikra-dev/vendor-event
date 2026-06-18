@extends('layouts.admin_master')
@section('title', 'Galeri Portofolio')
@section('content')

<div class="adm-page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h1 class="adm-page-title">Galeri Portofolio</h1>
        <p class="adm-page-subtitle">Tampilkan foto acara terbaik Anda untuk menarik lebih banyak klien.</p>
    </div>
    <a href="{{ route('portofolio.create') }}" class="adm-btn adm-btn-primary">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
        Upload Foto Baru
    </a>
</div>

@if($portofolio->isEmpty())
    <div class="adm-card" style="padding:48px;text-align:center;">
        <svg style="width:56px;height:56px;margin:0 auto 16px;display:block;opacity:0.2;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p style="color:#9a9ab0;font-size:16px;margin-bottom:16px;">Anda belum mengupload portofolio apapun.</p>
        <a href="{{ route('portofolio.create') }}" class="adm-btn adm-btn-primary">Upload Foto Pertama</a>
    </div>
@else
    <div class="row">
        @foreach($portofolio as $item)
        <div class="col-12 col-md-4 mb-4">
            <div class="adm-card h-100" style="overflow:hidden;">
                <!-- Foto -->
                <div style="position:relative;overflow:hidden;">
                    @php
                        $cover = str_starts_with($item->cover_image, 'http') ? $item->cover_image : asset('storage/' . $item->cover_image);
                    @endphp
                    <img src="{{ $cover }}"
                         alt="{{ $item->judul_project }}"
                         style="width:100%;height:210px;object-fit:cover;transition:transform 0.3s ease;"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform='scale(1)'">
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.3) 0%,transparent 50%);pointer-events:none;"></div>
                </div>
                <!-- Info -->
                <div style="padding:16px 18px;">
                    <div style="font-weight:700;color:#1a1a2e;font-size:16px;margin-bottom:4px;">{{ $item->judul_project }}</div>
                    @if($item->deskripsi)
                        <div style="font-size:14px;color:#7a7a9a;line-height:1.5;">{{ Str::limit($item->deskripsi, 70) }}</div>
                    @endif
                </div>
                <!-- Hapus -->
                <div style="padding:0 18px 16px;">
                    <form action="{{ route('portofolio.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="adm-btn adm-btn-outline-red" style="width:100%;justify-content:center;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus Foto
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
