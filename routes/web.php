<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TinTucController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index']);

Route::get('/jquery', [TestController::class, 'jquery']);
Route::get('/vue', [TestController::class, 'vue']);

Route::get('/demo-data', [TestController::class, 'demoData']);

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

    // Route của Sản Phẩm
    Route::group(['prefix' => '/san-pham'], function() {
        Route::get('/index', [SanPhamController::class, 'index']);

        Route::get('/index-old', [SanPhamController::class, 'index_old']);
        Route::get('/data', [SanPhamController::class, 'data']);
        Route::post('/create', [SanPhamController::class, 'store']);
    });

    // Route của Tài khoản
    Route::group(['prefix' => '/tai-khoan'], function() {
        Route::get('/index-form', [AdminController::class, 'index_form']);
        Route::post('/create-form', [AdminController::class, 'create_form']);

        Route::get('/index-ajax', [AdminController::class, 'index_ajax']);
        Route::get('/index-vue', [AdminController::class, 'index_vue']);

        Route::get('/data', [AdminController::class, 'data']);
        Route::post('/create-ajax', [AdminController::class, 'create_ajax']);
    });
    // Route của Tin Tức
    Route::group(['prefix' => '/tin-tuc'], function() {
        Route::get('/index', [TinTucController::class, 'index']);
        Route::post('/create', [TinTucController::class, 'store']);
        Route::get('/data', [TinTucController::class, 'data']);
        Route::post('/delete', [TinTucController::class, 'destroy']);
        Route::post('/update', [TinTucController::class, 'update']);
        Route::get('/change-status/{id}', [TinTucController::class, 'changeStatus']);


    });
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
