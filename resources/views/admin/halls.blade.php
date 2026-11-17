@extends('admin.panel')
@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0">Кинозалы</h2>
        <a href="{{ route('admin.halls.form') }}" class="btn btn-primary btn-sm">
            <i class="bi-plus-lg me-1"></i> Новый зал
        </a>
    </div>

    <div class="table-responsive">
        <table class="cine-table table">
            <thead><tr><th>ID</th><th>Название</th><th>Схема</th><th></th></tr></thead>
            <tbody>
            @forelse($halls as $h)
                <tr>
                    <td style="color:#5a5f70; width:70px;">#{{ $h->id }}</td>
                    <td style="font-weight:600;">{{ $h->name }}</td>
                    <td><span class="badge-soft">{{ $h->rows_count }} × {{ $h->seats_per_row }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.halls.form', $h) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi-pencil"></i>
                        </a>
                        @if(!$h->screenings()->exists())
                            <form action="{{ route('admin.halls.delete', $h) }}" method="post" class="d-inline" onsubmit="return confirm('Удалить?')">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger"><i class="bi-trash"></i></button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-outline-secondary" disabled>занят</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-5" style="color:#5a5f70;">Залы не найдены</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $halls->links() }}</div>
@endsection