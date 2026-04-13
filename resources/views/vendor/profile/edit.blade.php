@extends('layouts.admin_master')
@section('title', 'Profil Bisnis Anda')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 col-lg-8 mx-auto">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="card shadow-sm border-top-primary">
            <div class="card-header">
                <h4><i class="fas fa-store"></i> Atur Profil Bisnis</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Bisnis / Toko</label>
                        <input type="text" name="nama_bisnis" class="form-control" value="{{ $vendor->nama_bisnis }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor WhatsApp (Untuk Tombol Hubungi)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fab fa-whatsapp text-success"></i></div>
                            </div>
                            <input type="text" name="no_whatsapp" class="form-control" value="{{ $vendor->no_whatsapp }}" placeholder="Awali dengan 62..." required>
                        </div>
                        <small class="text-muted">Gunakan format 628xxx (tanpa tanda + atau 0 di depan) agar link WA berfungsi.</small>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat (Muncul di Kartu Pencarian)</label>
                        <input type="text" name="deskripsi_singkat" class="form-control" value="{{ $vendor->deskripsi_singkat }}" maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" style="height: 80px" required>{{ $vendor->alamat_lengkap }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Tentang Kami (Muncul di Detail Profil)</label>
                        <textarea name="tentang_kami" class="form-control" style="height: 120px" required>{{ $vendor->tentang_kami }}</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
