<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Load trang chủ website.
Route::get('/', function () {
    // return view('welcome');
    return view('quenmatkhau');
});

// Load trang đăng kí tài khoản.
Route::get('dk_taikhoan', 'PageController@Load_Dky');

// Lưu ảnh thu nhỏ thời khóa biểu lên máy chủ.
Route::post('save_tkb_img', 'FileController@Save_TKB_Img');