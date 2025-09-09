@extends('layouts.admin')

@section('title', 'Daftar Informasi Terbaru')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Informasi Terbaru</h2>

    {{-- Filter & Tambah Informasi dalam satu baris --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('admin.informasi.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           Tambah Informasi
        </a>
        <form action="{{ route('admin.informasi.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari judul..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <select name="kategori" class="border rounded p-2">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
        </form>


    </div>

    <table class="w-full border-collapse text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Judul</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Tanggal Publish</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($informasis as $informasi)
                <tr>
                    <td class="border p-2 text-left">{{ $informasi->judul }}</td>
                    <td class="border p-2">{{ $informasi->kategori->nama ?? '-' }}</td>
                    <td class="border p-2">
                        {{ $informasi->tanggal_publish?->format('d M Y') ?? '-' }}
                    </td>
                    <td class="border p-2 text-center">
                        @php $status = strtolower($informasi->status ?? 'draft'); @endphp
                        @if($status == 'publish' || $status == '1')
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">Publish</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded">Draft</span>
                        @endif
                    </td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.informasi.edit', $informasi) }}" class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.informasi.destroy', $informasi) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center">Belum ada informasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $informasis->links() }}
    </div>
</div>

@endsection
