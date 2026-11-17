@extends('admin.panel')

@section('admin-content')
    <h2 class="page-title mb-4">{{ $movie ? 'Редактирование фильма' : 'Новый фильм' }}</h2>

    <form action="{{ $movie ? route('admin.movies.form', $movie) : route('admin.movies.form') }}"
          method="post" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Название *</label>
                            <input type="text" name="title" class="form-control form-control-lg" value="{{ old('title', $movie->title ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug (URL)</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $movie->slug ?? '') }}">
                            <div class="form-text">Можно оставить пустым</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Описание</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $movie->description ?? '') }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Длительность (мин) *</label>
                                <input type="number" name="duration" class="form-control" value="{{ old('duration', $movie->duration ?? 90) }}" required min="1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Год *</label>
                                <input type="number" name="release_year" class="form-control" value="{{ old('release_year', $movie->release_year ?? date('Y')) }}" required min="1900">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Возраст *</label>
                                <select name="age_rating" class="form-select" required>
                                    @foreach(['0+', '6+', '12+', '16+', '18+'] as $r)
                                        <option value="{{ $r }}" {{ (old('age_rating', $movie->age_rating ?? '') == $r) ? 'selected' : '' }}>{{ $r }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Жанры</label>
                            <select name="genres[]" class="form-select" multiple size="8">
                                @foreach($allGenres as $g)
                                    <option value="{{ $g->id }}" {{ (is_array(old('genres')) && in_array($g->id, old('genres'))) || ($movie && $movie->genres->contains($g->id)) ? 'selected' : '' }}>{{ $g->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Ctrl / Shift — выбрать несколько</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header small text-uppercase" style="color:#8b90a0; letter-spacing:.08em;">
                        <i class="bi-image me-1"></i> Постер
                    </div>
                    <div class="card-body">
                        <input type="file" name="poster" class="form-control" accept="image/*">
                        @if($movie?->poster_url)
                            <img src="{{ asset($movie->poster_url) }}" class="img-fluid rounded mt-3" style="max-height: 220px;">
                        @endif
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header small text-uppercase" style="color:#8b90a0; letter-spacing:.08em;">
                        <i class="bi-camera-video me-1"></i> Трейлер
                    </div>
                    <div class="card-body">
                        <input type="file" name="trailer" class="form-control mb-2" accept="video/*">
                        <input type="url" name="trailer_url_input" class="form-control" placeholder="https://" value="{{ old('trailer_url_input', $movie->trailer_url ?? '') }}">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header small text-uppercase" style="color:#8b90a0; letter-spacing:.08em;">
                        <i class="bi-images me-1"></i> Кадры (галерея)
                    </div>
                    <div class="card-body">
                        <input type="file" name="frames[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text mb-2">Можно несколько файлов</div>
                        @if($movie)
                            <div class="row g-1">
                                @foreach($movie->images()->where('type', 'frame')->orderBy('sort_order')->get() as $img)
                                    <div class="col-4">
                                        <img src="{{ asset($img->image_url) }}" class="img-thumbnail" style="height: 60px; width: 100%; object-fit: cover; background:#0e0f13; border-color:#262a36;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi-check-lg me-1"></i> {{ $movie ? 'Сохранить' : 'Создать' }}
            </button>
            <a href="{{ route('admin.movies') }}" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </form>
@endsection