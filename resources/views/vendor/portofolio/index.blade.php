@extends('layouts.admin_master')
@section('title', 'Galeri Portofolio')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="section-title mb-0">Foto Acara (Projects)</h2>
        <a href="{{ route('portofolio.create') }}" class="btn btn-primary btn-lg"><i class="fas fa-upload"></i> Upload Foto Baru</a>
    </div>
</div>

<div class="row">
    @forelse($portofolio as $item)
        <div class="col-12 col-md-4 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/' . $item->cover_image) }}" class="card-img-top" alt="Foto Portofolio" style="height: 200px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul_project }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($item->deskripsi, 60) }}</p>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <form action="{{ route('portofolio.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100"><i class="fas fa-trash"></i> Hapus Portofolio</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center shadow-sm">
                Anda belum mengupload portofolio apapun.
                {{-- <br><strong>Penting:</strong> Upload foto portofolio akan meningkatkan skor rekomendasi Anda di mata klien! --}}
            </div>
        </div>
    @endforelse
</div>
@endsection
