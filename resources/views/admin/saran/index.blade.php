@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-2">📋 Daftar Saran & Masukan</h1>
    <p class="text-gray-600 mb-6">Kelola saran yang dikirim oleh pengunjung. Gunakan filter di bawah untuk memudahkan pencarian.</p>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.saran.index') }}"
          class="mb-6 bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-gray-700 mb-3">🔎 Filter Pencarian</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-600 mb-1">Cari</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                       placeholder="Nama, email, atau isi saran..."
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- Start Date -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-600 mb-1">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-600 mb-1">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- Per Page -->
            <div>
                <label for="per_page" class="block text-sm font-medium text-gray-600 mb-1">Tampilkan</label>
                <select id="per_page" name="per_page"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @foreach([10,25,50,100] as $size)
                        <option value="{{ $size }}" {{ request('per_page',10) == $size ? 'selected' : '' }}>
                            {{ $size }} / halaman
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                🔍 Terapkan Filter
            </button>
            <a href="{{ route('admin.saran.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ♻️ Reset
            </a>
        </div>
    </form>

    <!-- Info jumlah data -->
    <div class="text-sm text-gray-600 mb-3">
        Menampilkan
        <span class="font-semibold">{{ $sarans->firstItem() ?? 0 }}</span> -
        <span class="font-semibold">{{ $sarans->lastItem() ?? 0 }}</span>
        dari total <span class="font-semibold">{{ $sarans->total() }}</span> saran.
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border px-4 py-2 w-16">No</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Saran</th>
                    <th class="border px-4 py-2 w-32">Tanggal</th>
                    <th class="border px-4 py-2 w-28">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sarans as $saran)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2 text-center">
                            {{ $loop->iteration + ($sarans->currentPage()-1)*$sarans->perPage() }}
                        </td>
                        <td class="border px-4 py-2 font-medium">{{ $saran->nama }}</td>
                        <td class="border px-4 py-2 text-blue-600">{{ $saran->email }}</td>

                        <!-- Batasi panjang saran -->
                        <td class="border px-4 py-2 text-left">
                            {{ \Illuminate\Support\Str::limit($saran->saran, 60, '...') }}
                        </td>

                        <td class="border px-4 py-2 text-center">
                            {{ $saran->created_at->timezone('Asia/Jakarta')->format('d-m-Y') }}
                        </td>

                        <!-- Tombol Aksi -->
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.saran.show', $saran->id) }}"
                               class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                               Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">Belum ada saran yang masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $sarans->links() }}
    </div>
</div>
@endsection
