@extends('layouts.admin_master')
@section('title', 'Upload Portofolio Baru')

@section('content')
<div class="card shadow-sm border-top-primary">
    <div class="card-header">
        <h4>Form Upload Foto Acara</h4>
    </div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                File gambar kebesaran atau formatnya salah! Pastikan ukuran maksimal 2MB (JPG/PNG).
            </div>
        @endif

        <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Judul Acara / Project</label>
                <input type="text" name="judul_project" class="form-control" placeholder="Contoh: Wedding Budi & Ani di Bali" required>
            </div>

            <div class="form-group">
                <label>Upload Foto (Max 2MB)</label>
                <input type="file" name="cover_image" class="form-control-file border p-2 rounded" accept="image/png, image/jpeg, image/jpg" required>
            </div>

            <div class="form-group">
                <label>Cerita Singkat / Deskripsi (Opsional)</label>
                <textarea name="deskripsi" class="form-control" style="height: 100px" placeholder="Ceritakan keseruan acara ini..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Upload Portofolio</button>
            <a href="{{ route('portofolio.index') }}" class="btn btn-secondary btn-lg">Batal</a>
        </form>
    </div>
</div>
@endsection
