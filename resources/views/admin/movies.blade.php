@extends('admin.panel')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0">Фильмы</h2>
        <a href="{{ route('admin.movies.form') }}" class="btn btn-primary btn-sm">
            <i class="bi-plus-lg me-1"></i> Новый фильм
        </a>
    </div>

    <div class="table-responsive">
        <table class="cine-table table">
            <thead><tr><th>ID</th><th>Постер</th><th>Название</th><th>Жанры</th><th>Год</th><th></th></tr></thead>
            <tbody>
            @forelse($movies as $m)
                <tr>
                    <td style="color:#5a5f70; width:60px;">#{{ $m->id }}</td>
                    <td style="width:70px;">
                        @if($m->poster_url)
                            <img src="{{ asset($m->poster_url) }}" alt="Poster" class="rounded" style="height: 56px; width: 42px; object-fit: cover;">
                        @else
                            <span style="color:#5a5f70;">—</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $m->title }}</td>
                    <td>
                        @forelse($m->genres as $g)
                            <span class="badge-soft-gray">{{ $g->name }}</span>
                        @empty
                            <span style="color:#5a5f70;">—</span>
                        @endforelse
                    </td>
                    <td style="color:#8b90a0;">{{ $m->release_year }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.movies.form', $m) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi-pencil"></i>
                        </a>
                        @if(!$m->screenings()->exists())
                            <form action="{{ route('admin.movies.delete', $m) }}" method="post" class="d-inline"
                                  onsubmit="return confirm('Удалить фильм?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi-trash"></i></button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-outline-secondary" disabled>занят</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-5" style="color:#5a5f70;">Нет фильмов</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $movies->links() }}</div>
@endsection