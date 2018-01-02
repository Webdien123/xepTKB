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
Route::get('/', 'TKBController@Tao_TKB');

// Load trang đăng kí tài khoản.
Route::get('dk_taikhoan', 'PageController@Dky_TaiKhoan');

// Load trang đăng nhập.
Route::get('login', 'PageController@Login');

// Load trang đổi mật khẩu.
Route::get('doi_mk', 'PageController@Doi_MK');

// Load trang quên mật khẩu.
Route::get('quen_mk', 'PageController@Quen_MK');

// Load trang xác nhận mã số sau khi gửi mail.
Route::get('xac_nhan_ms', 'PageController@Xac_Nhan_MS');

// Load trang tạo thời khóa biểu mới.
Route::get('taotkb', 'TKBController@Tao_TKB');

// Load trang quản lý tkb cũ.
Route::get('qly_tkb', 'TKBController@QLy_TKB');

// Load trang thông tin và liên hệ.
Route::get('thongtin', 'PageController@ThongTin_LienHe');

// Lưu ảnh thu nhỏ thời khóa biểu lên máy chủ.
Route::post('save_tkb_img', 'FileController@Save_TKB_Img');