@extends('admin.panel')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0">Жанры</h2>
        <a href="{{ route('admin.genres.form') }}" class="btn btn-primary btn-sm">
            <i class="bi-plus-lg me-1"></i> Новый жанр
        </a>
    </div>

    <div class="table-responsive">
        <table class="cine-table table">
            <thead><tr><th>ID</th><th>Название</th><th>Slug</th><th></th></tr></thead>
            <tbody>
            @forelse($genres as $genre)
                <tr>
                    <td style="color:#5a5f70; width:70px;">#{{ $genre->id }}</td>
                    <td style="font-weight:600;">{{ $genre->name }}</td>
                    <td><code>{{ $genre->slug }}</code></td>
                    <td class="text-end">
                        <a href="{{ route('admin.genres.form', $genre) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.genres.delete', $genre) }}" method="post" class="d-inline"
                              onsubmit="return confirm('Удалить жанр?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-5" style="color:#5a5f70;">Жанры не найдены</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $genres->links() }}</div>
@endsection