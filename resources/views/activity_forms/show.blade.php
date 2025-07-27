@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">{{ $activity->title }}</h2>
    <p class="mb-4 text-gray-700">{{ $activity->description }}</p>
    <p class="text-sm text-gray-500">Dibuat pada: {{ $activity->created_at->format('d M Y') }}</p>
    <a href="{{ route('dashboard') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Kembali</a>
</div>
@endsection
