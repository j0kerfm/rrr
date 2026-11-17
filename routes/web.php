<?php

use Illuminate\Support\Facades\Route;

use App\Models\Genres;
use App\Models\Halls;
use App\Models\Movies;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScreeningController;


Route::get('/', function () {
    $movies = Movies::with('genres')->orderBy('title')->get(); 
    return view('welcome', compact('movies'));
})->name('home');

Route::get('/movies/{slug}', function ($slug) { 
    $movie = Movies::with('genres')->where('slug', $slug)->firstOrFail(); 
    return view('admin.movieShow', compact('movie')); 
})->name('movies.show');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/tickets/{ticket}', [UserController::class, 'showTicket'])->name('user.ticket');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/panel', [AdminController::class, 'panel'])->name('panel');

    Route::get('/admin/genres', [GenreController::class, 'index'])->name('admin.genres');
    Route::match(['get', 'post'], '/admin/genres/form/{genre?}', [GenreController::class, 'form'])->name('admin.genres.form');
    Route::post('/admin/genres/{genre}/delete', [GenreController::class, 'destroy'])->name('admin.genres.delete');

    Route::get('/admin/halls', [HallController::class, 'index'])->name('admin.halls');
    Route::match(['get', 'post'], '/admin/halls/form/{hall?}', [HallController::class, 'form'])->name('admin.halls.form');
    Route::post('/admin/halls/{hall}/delete', [HallController::class, 'destroy'])->name('admin.halls.delete');

    Route::get('/admin/movies', [MovieController::class, 'index'])->name('admin.movies');
    Route::match(['get', 'post'], '/admin/movies/form/{movie?}', [MovieController::class, 'form'])->name('admin.movies.form');
    Route::post('/admin/movies/{movie}/delete', [MovieController::class, 'destroy'])->name('admin.movies.delete');

    Route::get('/admin/screenings', [ScreeningController::class, 'index'])->name('admin.screenings');
    Route::match(['get','post'], '/admin/screenings/form/{screening?}', [ScreeningController::class, 'form'])->name('admin.screenings.form');
    Route::post('/admin/screenings/{screening}/delete', [ScreeningController::class, 'destroy'])->name('admin.screenings.delete');
});