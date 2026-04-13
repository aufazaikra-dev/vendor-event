@extends('layouts.admin_master')
@section('title', 'Kelola Paket Harga')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Daftar Paket Anda</h4>
        <div class="card-header-action">
            <a href="{{ route('paket.create') }}" class="btn btn-primary">+ Tambah Paket Baru</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Harga (Rp)</th>
                        <th>Fitur / Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paket as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_paket }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ Str::limit($item->fitur_paket, 50) }}</td>
                        <td>
                            <form action="{{ route('paket.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada paket harga. Silakan tambah dulu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
