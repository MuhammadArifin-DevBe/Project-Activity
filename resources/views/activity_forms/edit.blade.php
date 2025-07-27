@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Buat Form Kegiatan</h2>

    <form action="{{ route('forms.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Judul</label>
            <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}" required
                class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required
                class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">{{ old('description', $activity->description) }}</textarea>
        </div>

        <div class="text-right">
            <a href="{{ route('forms.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">update</button>
        </div>
    </form>
</div>
@endsection