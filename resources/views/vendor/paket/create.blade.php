@extends('layouts.admin_master')
@section('title', 'Tambah Paket Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Form Input Paket</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('paket.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" placeholder="Contoh: Paket Wedding Gold" required>
            </div>

            <div class="form-group">
                <label>Harga (Rupiah)</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                    </div>
                    <input type="number" name="harga" class="form-control" placeholder="5000000" required>
                </div>
                <small class="text-muted">Masukkan angka saja tanpa titik/koma.</small>
            </div>

            <div class="form-group">
                <label>Fitur & Fasilitas</label>
                <textarea name="fitur_paket" class="form-control" style="height: 100px" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Paket</button>
            <a href="{{ route('paket.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
