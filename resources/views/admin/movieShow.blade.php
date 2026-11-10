@extends('layout.index')

@section('title', $movie->title)
@section('content')
<div class="container my-4">
    <div class="row g-4">
        <div class="col-md-4">
            @if($movie->poster_url)
                <img src="{{ asset($movie->poster_url) }}" class="img-fluid rounded-4 w-100" alt="{{ $movie->title }}"
                     style="object-fit:cover;">
            @else
                <div class="d-flex align-items-center justify-content-center rounded-4" style="height:480px; background:#171921; color:#5a5f70;">
                    <i class="bi-image" style="font-size:3rem;"></i>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <h1 class="page-title mb-3">{{ $movie->title }}</h1>
            <p class="lead mb-4" style="color:#8b90a0;">{{ $movie->description }}</p>

            <div class="d-flex flex-wrap gap-2 mb-4">
                <span class="badge-soft"><i class="bi-calendar me-1"></i>{{ $movie->release_year }}</span>
                <span class="badge-soft"><i class="bi-clock me-1"></i>{{ $movie->duration }} мин</span>
                <span class="badge-soft"><i class="bi-person-badge me-1"></i>{{ $movie->age_rating }}</span>
            </div>

            <div class="mb-4">
                @foreach($movie->genres as $g)
                    <span class="badge-soft-gray me-1">{{ $g->name }}</span>
                @endforeach
            </div>

            @if($movie->trailer_url)
                <div class="mt-4">
                    <h5 class="mb-3" style="color:#f5a623;"><i class="bi-camera-video me-1"></i> Трейлер</h5>
                    @if(str_contains($movie->trailer_url, 'youtube.com') || str_contains($movie->trailer_url, 'youtu.be'))
                        @php
                            $videoId = preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11}).*/', $movie->trailer_url, $matches) ? $matches[1] : '';
                        @endphp
                        @if($videoId)
                            <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @endif
                    @elseif(str_contains($movie->trailer_url, 'storage/trailers/'))
                        <video controls class="w-100 rounded-3" style="max-height: 400px;">
                            <source src="{{ asset($movie->trailer_url) }}" type="video/mp4">
                            Ваш браузер не поддерживает видео.
                        </video>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if($movie->images()->where('type', 'frame')->count() > 0)
        <hr class="my-5" style="border-color:#262a36;">
        <h3 class="page-title mb-3">Кадры из фильма</h3>
        <div class="row g-3">
            @foreach($movie->images()->where('type', 'frame')->orderBy('sort_order')->get() as $img)
                <div class="col-md-3 col-sm-4 col-6">
                    <img src="{{ asset($img->image_url) }}" class="w-100 rounded-3" style="height:140px; object-fit:cover; cursor:zoom-in;"
                         alt="Кадр" data-bs-toggle="modal" data-bs-target="#imgModal-{{ $img->id }}">
                    <div class="modal fade" id="imgModal-{{ $img->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="background:#171921; border-color:#262a36;">
                                <div class="modal-body p-0">
                                    <img src="{{ asset($img->image_url) }}" class="img-fluid rounded w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection