<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <span class="font-medium">Berhasil!</span> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">Gagal!</span> {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Pesanan Jasa Vendor</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($transactions as $trx)
                        <div class="border rounded-lg p-5 shadow-sm bg-white">

                            <div class="flex justify-between items-start mb-3">
                                <div class="pr-3">
                                    <p class="text-sm text-gray-500 mb-1">Kode: <span class="font-mono text-indigo-600 font-bold">{{ $trx->kode_pesanan }}</span></p>
                                    <h4 class="font-bold text-xl text-gray-800">{{ $trx->vendor->nama_bisnis ?? 'Vendor Dihapus' }}</h4>
                                    <p class="text-gray-600 text-sm mt-1">{{ $trx->pricelist->nama_paket ?? 'Paket Dihapus' }}</p>
                                </div>

                                <div>
                                    <span class="text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap
                                        {{ $trx->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ strtoupper(str_replace('_', ' ', $trx->status)) }}
                                    </span>
                                </div>
                            </div>

                            <hr class="mb-4">

                            @if($trx->status == 'selesai' && !$trx->review)
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-sm text-blue-800 font-bold mb-2">Ayo berikan ulasan Anda!</p>
                                    <form action="{{ route('user.review.store', $trx->id) }}" method="POST">
                                        @csrf
                                        <select name="rating" class="w-full text-sm border-gray-300 rounded-md mb-2" required>
                                            <option value="">-- Beri Bintang --</option>
                                            <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                                            <option value="4">⭐⭐⭐⭐ (Puas)</option>
                                            <option value="3">⭐⭐⭐ (Cukup)</option>
                                            <option value="2">⭐⭐ (Kurang)</option>
                                            <option value="1">⭐ (Buruk)</option>
                                        </select>
                                        <textarea name="komentar" class="w-full text-sm border-gray-300 rounded-md mb-2" rows="2" placeholder="Bagaimana pengalaman Anda?" required></textarea>
                                        <button type="submit" class="w-full text-sm font-bold py-2 rounded mt-2" style="background-color: #4f46e5; color: white; border: none;">Kirim Ulasan</button>
                                    </form>
                                </div>

                            @elseif($trx->review)
                                <div class="bg-gray-50 p-4 rounded-lg border">
                                    <p class="text-yellow-500 text-sm mb-1">⭐ {{ $trx->review->rating }} / 5</p>
                                    <p class="text-sm text-gray-700 italic">"{{ $trx->review->komentar }}"</p>

                                    @if($trx->review->balasan_vendor)
                                        <div class="mt-3 pl-3 border-l-4 border-indigo-500">
                                            <p class="text-xs font-bold text-indigo-600">Balasan Vendor:</p>
                                            <p class="text-xs text-gray-600">{{ $trx->review->balasan_vendor }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-gray-400 italic">Pesanan belum selesai. Anda baru bisa memberi ulasan setelah vendor menyelesaikan pesanan.</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full p-6 text-center text-gray-500 border rounded-lg bg-gray-50">
                            Anda belum memiliki riwayat pesanan vendor.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
