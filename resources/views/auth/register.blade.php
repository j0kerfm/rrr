@extends('layout.index')

@section('title', 'Регистрация')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height:60vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card">
            <div class="card-body p-4 p-md-5">
                <h2 class="page-title mb-4">Регистрация</h2>
                <form method="post" action="{{ route('register.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Повторите пароль</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection