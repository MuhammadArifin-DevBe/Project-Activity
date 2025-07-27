@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Kegiatan</h1>

    <a href="{{ route('admin.forms.create') }}" class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
        Tambah Kegiatan
    </a>
    <a href="{{ route('admin.forms.export.pdf') }}" class="inline-block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
        Cetak PDF
    </a>
    <a href="{{ route('admin.forms.export.excel') }}" class="inline-block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
        Export Excel
    </a>
    <a href="{{ route('admin.forms.export.csv') }}" class="inline-block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
        Export CSV
    </a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="border px-4 py-2 text-center">No</th>
                    <th class="border px-4 py-2 text-center">Judul</th>
                    <th class="border px-4 py-2 text-center">Deskripsi</th>
                    <th class="border px-4 py-2 text-center">Tanggal Dibuat</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $index => $activity)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $activity->title }}</td>
                    <td class="border px-4 py-2">{{ $activity->description }}</td>
                    <td class="border px-4 py-2 text-center">{{ $activity->created_at->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2 text-center whitespace-nowrap">
                        <a href="{{ route('admin.forms.edit', $activity->id) }}" class="inline-block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                            Edit
                        </a>
                        <form action="{{ route('admin.forms.destroy', $activity->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada kegiatan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection
