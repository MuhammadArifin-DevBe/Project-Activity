@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-xl rounded-2xl p-6">
        <div class="d-flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold text-gray-800">Pratinjau Kegiatan Terbaru</h4>
            <a href="{{ route('forms.index') }}" class="text-blue-600 text-sm hover:underline">
                Lihat Semua
            </a>
        </div>

        @if ($activities->count())
            <div class="row">
                @foreach ($activities as $activity)
                    <div class="col-md-6 mb-4">
                        <div class="bg-light border border-secondary rounded-lg p-4 shadow-sm">
                            <h5 class="text-md font-bold text-dark mb-1">
                                {{ $activity->name ?? $activity->title }}
                            </h5>
                            <p class="text-sm text-muted mb-2">
                                {{ \Illuminate\Support\Str::limit($activity->description ?? '-', 10) }}
                            </p>
                            <p class="text-xs text-secondary">
                                {{ $activity->created_at->format('d M Y') }}
                                <!-- @if (Auth::user()->hasRole('admin'))
                                    oleh {{ $activity->user->name ?? '-' }}
                                @endif -->
                            </p>

                            <div class="mt-3">
                                <a href="{{ route('forms.show', $activity->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada aktivitas yang ditambahkan.</p>
        @endif
    </div>
</div>
@endsection
