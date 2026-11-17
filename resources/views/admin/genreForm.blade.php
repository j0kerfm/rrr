@extends('admin.panel')

@section('admin-content')
    <h2 class="page-title mb-4">{{ $genre ? 'Редактирование жанра' : 'Новый жанр' }}</h2>

    <form action="{{ $genre ? route('admin.genres.form', $genre) : route('admin.genres.form') }}" method="post">
        @csrf

        <div class="card" style="max-width:600px;">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Название *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $genre->name ?? '') }}" required>
                </div>
                <div class="mb-0">
                    <label class="form-label">Slug (URL)</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $genre->slug ?? '') }}">
                    <div class="form-text">Можно оставить пустым — сгенерируется из названия.</div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi-check-lg me-1"></i> {{ $genre ? 'Сохранить' : 'Создать' }}
            </button>
            <a href="{{ route('admin.genres') }}" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </form>
@endsection