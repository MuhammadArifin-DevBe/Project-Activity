@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Pengajuan Kegiatan</h1>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow rounded">
            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <tr>
                    <th class="py-3 px-4 border-b">Nama User</th>
                    <th class="py-3 px-4 border-b">Deskripsi</th>
                    <th class="py-3 px-4 border-b">Tanggal Mulai</th>
                    <th class="py-3 px-4 border-b">Tanggal Selesai</th>
                    <th class="py-3 px-4 border-b">Status</th>
                    <th class="py-3 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @foreach ($activities as $activity)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $activity->user->name ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $activity->description }}</td>
                    <td class="py-2 px-4 border-b">{{ $activity->tanggal_mulai }}</td>
                    <td class="py-2 px-4 border-b">{{ $activity->tanggal_selesai }}</td>
                    <td class="py-2 px-4 border-b">
                        <span class="px-2 py-1 rounded text-white 
                                {{ $activity->status === 'menunggu' ? 'bg-yellow-500' : ($activity->status === 'disetujui' ? 'bg-green-500' : 'bg-red-500') }}">
                            {{ ucfirst($activity->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b">
                        @if ($activity->status === 'menunggu')
                        <form action="{{ route('admin.forms.approve', $activity->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Setujui pengajuan ini?')"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">
                                Setujui
                            </button>
                        </form>
                        <form action="{{ route('admin.forms.reject', $activity->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Tolak pengajuan ini?')"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">
                                Tolak
                            </button>
                        </form>
                        @else
                        <span class="text-gray-500 text-xs italic">{{ ucfirst($activity->status) }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection