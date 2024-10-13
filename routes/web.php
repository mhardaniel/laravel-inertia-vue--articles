<?php

use App\Models\Article;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function (Request $request) {

    $filterByStatus = 'for-edit';
    $query = Article::with(['company', 'writer', 'editor'])->orderBy('created_at', 'desc');

    if ($request->has('filterByStatus')) {
        $filterByStatus = $request->input('filterByStatus');
    }

    return Inertia::render('Dashboard',
        [
            'articles' => $query->where('status', $filterByStatus)->get(),
        ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {});

require __DIR__.'/auth.php';
