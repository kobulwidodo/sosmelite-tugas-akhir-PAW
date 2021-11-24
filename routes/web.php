<?php

use App\Http\Controllers\ExploreUserController;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UpdatePasswordController;

Route::get('/', function () {
    return redirect(RouteServiceProvider::HOME);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/timeline', TimelineController::class)->name('timeline');
    Route::get('/status/{status:identifier}', [StatusController::class, 'show'])->name('status.show');
    Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');
    Route::put('/status/{status:identifier}/update', [StatusController::class, 'update'])->name('status.update');
    Route::delete('/status/{status:identifier}/destroy', [StatusController::class, 'destroy'])->name('status.destroy');

    Route::post('/reply/{status:identifier}/store', [ReplyController::class, 'store'])->name('reply.store');
    Route::delete('/reply/{reply:id}/destroy', [ReplyController::class, 'destroy'])->name('reply.destroy');
    
    Route::prefix('profile')->group(function () {
        Route::get('/password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit');
        Route::put('/password/edit', [UpdatePasswordController::class, 'update']);

        Route::get('edit', [ProfileInformationController::class, 'edit'])->name('profile.edit');
        Route::put('update', [ProfileInformationController::class, 'update'])->name('profile.update');
        Route::get('{user:username}', [ProfileInformationController::class, 'index'])->name('profile');
        Route::get('{user:username}/{type}', [ProfileInformationController::class, 'index'])->name('profile.followers');
        Route::post('{user}', [FollowController::class, 'store'])->name('follow.store');
    });

    Route::get('explore', ExploreUserController::class)->name('explore');
});

require __DIR__.'/auth.php';
