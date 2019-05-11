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
Route::get('/', 'PageController@Login');

// Load trang đăng kí tài khoản.
Route::get('dk_taikhoan', 'PageController@Dky_TaiKhoan');

// Xử lý đăng kí.
Route::post('dangki_process', 'AccountController@Dangki_Process');

// Load trang đăng nhập.
Route::get('login', 'PageController@Login');

// Xử lý đăng nhập.
Route::post('login_process', 'AccountController@Login_Process');

// Xử lý đăng xuất.
Route::get('logout', 'AccountController@Logout');

// Load trang đổi mật khẩu.
Route::get('doi_mk', 'PageController@Doi_MK');

// Load trang quên mật khẩu.
Route::get('quen_mk', 'PageController@Quen_MK');

// Xử lý gửi mail khi quên mật khẩu.
Route::post('lost_pass', 'MailController@GuiMail_QuenMK');

// Xử lý gửi mail khi đổi mật khẩu.
Route::post('change_pass', 'AccountController@DoiMK');

// Load trang reset mật khẩu.
Route::get('reset_pass', 'PageController@Reset_MK');

// Xử lý reset mật khẩu.
Route::post('reset_pass_process', 'AccountController@Reset_MK');

// Gửi lại mail bị lỗi.
Route::post('send_mail', 'MailController@GuiMail_KichHoat');

// Load trang xác nhận mã số sau khi gửi mail.
Route::get('xac_nhan_ms', 'PageController@Xac_Nhan_MS');

// Xử lý mã số kích hoạt tài khoản.
Route::post('kich_hoat_account', 'AccountController@KichHoat');

// Gửi mail feedback hệ thống.
Route::post('feedback', 'MailController@GuiMail_Feedback');

// Load trang báo lỗi khi gửi mail.
Route::get('error_mail', 'PageController@Error_Mail');

// Load trang tạo thời khóa biểu mới.
Route::get('taotkb', 'TKBController@Tao_TKB');

// Tìm thông tin học phần.
Route::post('tim_hp', 'HocPhanController@TimHP');

// Lấy thời gian học theo mã học phần và kí hiệu nhóm.
Route::post('lay_tgian_hoc', 'HocPhanController@LayTGianHoc');

// Lấy học kì hiện tại.
Route::post('lay_hocki_hientai', 'HocPhanController@LayHKiHienTai');

// Lấy học kì hiện tại.
Route::post('lay_namhoc_hientai', 'HocPhanController@LayNamHocHienTai');

// Lấy lịch họp cố vấn.
Route::post('lay_lich_co_van', 'HocPhanController@LayLichCoVan');

// Tính số thứ tự tkb sẽ tạo. (bằng số lượng tkb hiện tại cộng thêm 1)
Route::post('get_so_luong_tkb', 'TKBController@GetSoLuongTKB');

// Lưu TKB mới.
Route::post('luu_tkb_moi', 'TKBController@Luu_TKB_Moi');

// Load trang quản lý tkb cũ.
Route::get('qly_tkb', 'TKBController@QLy_TKB');

// Load trang thông tin và liên hệ.
Route::get('thongtin', 'PageController@ThongTin_LienHe')->name('thongtin');

// Lưu ảnh thu nhỏ thời khóa biểu lên máy chủ.
Route::post('save_tkb_img', 'FileController@Save_TKB_Img');

// Cập nhật ảnh đại diện.
Route::post('upload_avt', 'AccountController@Upload_Avt');

// Load trang báo lỗi.
Route::get('error', 'PageController@Error')->name('error');

// Xử lý excell.
Route::get('excell', 'ExcellController@importExport');
Route::get('downloadExcel/{type}', 'ExcellController@downloadExcel');
Route::post('importExcel', 'ExcellController@importExcel');