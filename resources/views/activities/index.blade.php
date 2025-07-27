@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Daftar Kegiatan</h1>

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Nama Kegiatan</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Dibuat Oleh</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $index => $activity)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $activity->name }}</td>
                <td class="border px-4 py-2">{{ $activity->created_at->format('d-m-Y') }}</td>
                <td class="border px-4 py-2">{{ $activity->user->name ?? '-' }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('activities.show', $activity->id) }}" class="text-blue-500">Lihat</a>
                    @if(auth()->user()->id == $activity->user_id)
                        | <a href="{{ route('activities.edit', $activity->id) }}" class="text-yellow-500">Edit</a>
                        | <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Yakin?')">Hapus</button>
                          </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
