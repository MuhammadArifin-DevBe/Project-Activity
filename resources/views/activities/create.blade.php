@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Isi Form Kegiatan</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <form action="{{ route('user.activities.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="activity_form_id" class="block font-semibold mb-1">Pilih Form Kegiatan</label>
            <select name="activity_form_id" id="activity_form_id" class="w-full border rounded px-3 py-2">
                @foreach ($activityForms as $form)
                    <option value="{{ $form->id }}">{{ $form->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="tanggal_mulai" class="block font-semibold mb-1">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full border rounded px-3 py-2" value="{{ old('tanggal_mulai') }}">
        </div>

        <div class="mb-4">
            <label for="tanggal_selesai" class="block font-semibold mb-1">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full border rounded px-3 py-2" value="{{ old('tanggal_selesai') }}">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Kirim Kegiatan
        </button>
    </form>
</div>
@endsection
