@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Halo, {{ auth()->user()->name }} 👋</h1>

    <div class="grid grid-cols-3 gap-4">
        {{-- Total Aktivitas --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold">Total Aktivitas</h2>
            <p class="text-blue-600 text-2xl">{{ $totalActivities }}</p>
        </div>

        {{-- Aktivitas Terakhir --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold mb-2">Aktivitas Terakhir</h2>

            @if ($latestActivity)
                <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Deskripsi:</strong> {{ $latestActivity->description }}</p>
                <p><strong>Tanggal:</strong> {{ $latestActivity->created_at->format('d M Y') }}</p>
                <p><strong>Status:</strong> 
                    <span class="px-2 py-1 rounded 
                        @if ($latestActivity->status === 'disetujui') bg-green-100 text-green-800
                        @elseif ($latestActivity->status === 'ditolak') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($latestActivity->status) }}
                    </span>
                </p>
                <p class="mt-2">
                    <a href="{{ route('user.activities.index', $latestActivity->id) }}" class="text-blue-500 hover:underline text-sm">
                        📄 Lihat Detail
                    </a>
                </p>
            @else
                <p class="text-gray-600">Belum ada aktivitas</p>
            @endif
        </div>
    </div>
</div>
@endsection
