<?php

use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index']);

Route::group(['prefix' => '/admin'], function() {
    // Route của Chuyên Mục
    Route::group(['prefix' => '/chuyen-muc'], function() {
        Route::get('/index', [ChuyenMucController::class, 'index']);
        Route::get('/data', [ChuyenMucController::class, 'data']);
        Route::post('/create', [ChuyenMucController::class, 'store']);

        Route::get('/doi-trang-thai/{id}', [ChuyenMucController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [ChuyenMucController::class, 'destroy']);
        Route::get('/edit/{id}', [ChuyenMucController::class, 'edit']);

        Route::post('/update', [ChuyenMucController::class, 'update']);
    });
});
