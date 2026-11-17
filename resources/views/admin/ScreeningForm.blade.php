@extends('admin.panel')

@section('admin-content')
    <h2 class="page-title mb-4">{{ $screening ? 'Редактирование сеанса' : 'Новый сеанс' }}</h2>

    <form action="{{ $screening ? route('admin.screenings.form', $screening) : route('admin.screenings.form') }}"
          method="post">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Фильм *</label>
                            <select name="movie_id" class="form-select" required>
                                <option value="">— выберите фильм —</option>
                                @foreach($movies as $m)
                                    <option value="{{ $m->id }}"
                                        {{ old('movie_id', $screening->movie_id ?? '') == $m->id ? 'selected' : '' }}>
                                        {{ $m->title }} ({{ $m->duration }} мин)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Зал *</label>
                            <select name="hall_id" class="form-select" required>
                                <option value="">— выберите зал —</option>
                                @foreach($halls as $h)
                                    <option value="{{ $h->id }}"
                                        {{ old('hall_id', $screening->hall_id ?? '') == $h->id ? 'selected' : '' }}>
                                        {{ $h->name }} ({{ $h->rows_count }}×{{ $h->seats_per_row }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Дата и время начала *</label>
                                <input type="datetime-local" name="start_time" class="form-control"
                                       value="{{ old('start_time', isset($screening) && $screening->start_time ? $screening->start_time->format('Y-m-d\TH:i') : '') }}"
                                       required>
                                @error('start_time')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Формат *</label>
                                <select name="format" class="form-select" required>
                                    @foreach(['2D', '3D', 'IMAX', 'VIP'] as $f)
                                        <option value="{{ $f }}"
                                            {{ old('format', $screening->format ?? '2D') == $f ? 'selected' : '' }}>
                                            {{ $f }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Цена, ₽ *</label>
                                <input type="number" name="ticket_price" class="form-control" min="0" step="1"
                                       value="{{ old('price', $screening->price ?? 300) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi-check-lg me-1"></i> {{ $screening ? 'Сохранить' : 'Создать' }}
            </button>
            <a href="{{ route('admin.screenings') }}" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </form>
@endsection