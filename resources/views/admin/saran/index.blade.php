@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Saran & Masukan</h1>

    <table class="w-full border-collapse border border-gray-300 text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Saran</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sarans as $saran)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $saran->nama }}</td>
                    <td class="border px-4 py-2">{{ $saran->email }}</td>
                    <td class="border px-4 py-2">{{ $saran->saran }}</td>
                    {{-- <td class="border px-4 py-2">
                        {{ $saran->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB
                    </td> --}}
                    <td class="border px-4 py-2">
                        {{ $saran->created_at->timezone('Asia/Jakarta')->format('d-m-Y') }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada saran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $sarans->links() }}
    </div>
</div>
@endsection
