@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang, Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl text-center font-semibold">Total  Kegiatan</h2>
            <p class="text-3xl text-center text-gray-400-600 mt-2">{{ $totalForms ?? '-' }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl text-center font-semibold">Total Pengguna</h2>
            <p class="text-3xl text-center text-gray-400-600 mt-2">{{ $totalUsers ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
