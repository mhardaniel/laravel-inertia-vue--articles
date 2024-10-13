<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RouteEditorAccess;
use App\Http\Middleware\RouteWriterAccess;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::middleware('auth')->group(function () {

    Route::middleware([RouteEditorAccess::class])->group(function () {
        Route::resources([
            'users' => UserController::class,
            'companies' => CompanyController::class,
        ]);
    });

    Route::middleware([RouteWriterAccess::class])->group(function () {

        Route::resource(
            'articles', ArticleController::class
        )->only([
            'create',
        ]);

    });

    Route::resource(
        'articles', ArticleController::class
    )->except([
        'create',
    ]);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
