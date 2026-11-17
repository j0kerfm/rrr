@extends('admin.panel')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0">Сеансы</h2>
        <a href="{{ route('admin.screenings.form') }}" class="btn btn-primary btn-sm">
            <i class="bi-plus-lg me-1"></i> Новый сеанс
        </a>
    </div>

    {{-- Фильтр по залу --}}
    <form method="get" action="{{ route('admin.screenings') }}" class="mb-3 d-flex gap-2" style="max-width:420px;">
        <select name="hall" class="form-select form-select-sm">
            <option value="">Все залы</option>
            @foreach($halls ?? [] as $h)
                <option value="{{ $h->id }}" {{ request('hall') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-outline-secondary">Фильтр</button>
        @if(request('hall'))
            <a href="{{ route('admin.screenings') }}" class="btn btn-sm btn-outline-secondary">Сброс</a>
        @endif
    </form>

    <div class="table-responsive">
        <table class="cine-table table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Фильм</th>
                    <th>Зал</th>
                    <th>Начало</th>
                    <th>Конец</th>
                    <th>Формат</th>
                    <th>Цена</th>
                    <th>Билеты</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse($screenings as $s)
                <tr>
                    <td style="color:#5a5f70; width:60px;">#{{ $s->id }}</td>
                    <td style="font-weight:600;">{{ $s->movie->title ?? '—' }}</td>
                    <td style="color:#8b90a0;">{{ $s->hall->name ?? '—' }}</td>
                    <td style="color:#8b90a0;">{{ $s->start_time?->format('d.m.Y H:i') }}</td>
                    <td style="color:#8b90a0;">
                        {{ $s->start_time && $s->movie ? $s->start_time->copy()->addMinutes($s->movie->duration)->format('H:i') : '—' }}
                    </td>
                    <td>
                        <span class="badge-soft-gray">{{ $s->format }}</span>
                    </td>
                    <td style="color:#f5a623; font-weight:600;">{{ number_format($s->ticket_price, 0, '', ' ') }} ₽</td>
                    <td style="color:#8b90a0;">{{ $s->tickets_count ?? $s->tickets()->count() }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.screenings.form', $s) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi-pencil"></i>
                        </a>
                        @if(!$s->tickets()->exists())
                            <form action="{{ route('admin.screenings.delete', $s) }}" method="post" class="d-inline"
                                  onsubmit="return confirm('Удалить сеанс?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi-trash"></i></button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-outline-secondary" disabled>занят</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center py-5" style="color:#5a5f70;">Нет сеансов</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $screenings->links() }}</div>
@endsection