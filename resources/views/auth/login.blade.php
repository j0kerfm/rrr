@extends('layout.index')

@section('title', 'Войти')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height:60vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card">
            <div class="card-body p-4 p-md-5">
                <h2 class="page-title mb-4">Вход</h2>
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection