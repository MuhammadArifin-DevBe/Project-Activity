@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Daftar Kegiatan Saya</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('user.activities.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 inline-block mb-5">Tambah Aktivitas</a>
    

    @if ($activities->isEmpty())
        <p class="text-gray-600">Belum ada kegiatan yang kamu input.</p>
    @else
        <div class="space-y-4">
            @foreach ($activities as $activity)
                <div class="p-4 border rounded-lg bg-gray-50 shadow-sm">
                    <h3 class="text-lg font-semibold mb-1">{{ $activity->activityForm->title }}</h3>
                    <p class="text-gray-700 mb-2">{{ $activity->description }}</p>
                    <div class="text-sm text-gray-500">
                        <span><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($activity->tanggal_mulai)->format('d M Y') }}</span> <br>
                        <span><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($activity->tanggal_selesai)->format('d M Y') }}</span>
                    </div>
                    <div class="text-sm mt-2">
                        <span class="px-2 py-1 rounded 
                            @if ($activity->status === 'disetujui') bg-green-100 text-green-800
                            @elseif ($activity->status === 'ditolak') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            Status: {{ ucfirst($activity->status) }}
                        </span>
                    </div>

                    {{-- Tombol Edit dan Hapus --}}
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('user.activities.edit', $activity->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>

                        <form action="{{ route('user.activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
