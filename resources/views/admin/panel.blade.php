@extends('layout.index')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-0 flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 min-vh-100" style="background:#12141b; border-right:1px solid #262a36;">
            <div class="d-flex flex-column p-3 min-vh-100">
                <div class="text-uppercase small fw-bold mb-3 px-2" style="color:#f5a623; letter-spacing:.15em;">Управление</div>
                <ul class="nav flex-column gap-1">
                    <li class="nav-item">
                        <a href="{{ route('admin.genres') }}" class="nav-link px-3 py-2 rounded-pill" style="color:#8b90a0;">
                            <i class="bi-tags me-2"></i> Жанры
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.halls') }}" class="nav-link px-3 py-2 rounded-pill" style="color:#8b90a0;">
                            <i class="bi-building me-2"></i> Залы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.movies') }}" class="nav-link px-3 py-2 rounded-pill" style="color:#8b90a0;">
                            <i class="bi-film me-2"></i> Фильмы
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col py-4 px-4">
            @yield('admin-content')
        </div>
    </div>
</div>
@endsection