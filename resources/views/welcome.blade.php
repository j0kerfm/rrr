@extends('layout.index')

@section('title', 'Афиша')
@section('content')
<div class="container my-4">
    <h2 class="page-title mb-4">Сейчас в прокате</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
        @forelse($movies as $m)
            <div class="col">
                <a href="{{ route('movies.show', $m->slug) }}" class="d-block card h-100 border-0 overflow-hidden" style="border-radius:16px;">
                    <div class="position-relative">
                        @if($m->poster_url)
                            <img src="{{ asset($m->poster_url) }}" class="w-100" alt="{{ $m->title }}"
                                 style="height: 380px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center" style="height:380px; background:#171921;">
                                <i class="bi-image" style="font-size:3rem; color:#5a5f70;"></i>
                            </div>
                        @endif
                        <div class="position-absolute bottom-0 start-0 end-0 p-3"
                             style="background:linear-gradient(to top, rgba(14,15,19,.95), transparent);">
                            <h5 class="text-white mb-1">{{ $m->title }}</h5>
                            <div class="small" style="color:#c9ccd6;">{{ $m->release_year }} · {{ $m->duration }} мин</div>
                        </div>
                        <span class="position-absolute top-0 end-0 m-2 badge-soft">{{ $m->age_rating }}</span>
                    </div>
                    <div class="card-body" style="background:var(--cine-panel);">
                        <p class="small mb-2" style="color:#8b90a0;">{{ Str::limit($m->description, 90) }}</p>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($m->genres as $g)
                                <span class="badge-soft-gray">{{ $g->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Фильмы не найдены</div></div>
        @endforelse
    </div>
</div>
@endsection