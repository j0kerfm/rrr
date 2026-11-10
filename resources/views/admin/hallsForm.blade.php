@extends('admin.panel')
@section('admin-content')
    <h2 class="page-title mb-4">{{ $hall ? 'Редактирование зала' : 'Новый зал' }}</h2>
    <form action="{{ $hall ? route('admin.halls.form', $hall) : route('admin.halls.form') }}" method="post">
        @csrf
        <div class="card" style="max-width:720px;">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Название *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $hall->name ?? '') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ряды *</label>
                        <input type="number" name="rows_count" class="form-control" min="1" max="50" value="{{ old('rows_count', $hall->rows_count ?? 6) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Мест в ряду *</label>
                        <input type="number" name="seats_per_row" class="form-control" min="1" max="50" value="{{ old('seats_per_row', $hall->seats_per_row ?? 10) }}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi-check-lg me-1"></i> {{ $hall ? 'Сохранить' : 'Создать' }}
            </button>
            <a href="{{ route('admin.halls') }}" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </form>
@endsection