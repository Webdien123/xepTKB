<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Lớp định nghia các hàm load các trang giao diện không cần đọc data trước.
class PageController extends Controller
{
    // Hàm load trang đăng ký tài khoản.
    public function Dky_TaiKhoan()
    {
        return view('dky_taikhoan');
    }

    // Hàm load trang nhập mã số xác nhận sau khi gửi mail.
    public function Xac_Nhan_MS()
    {
        return view('xac_nhan_maso');
    }

    // Hàm load trang đăng nhập.
    public function Login()
    {
        return view('login');
    }

    // Hàm load trang đổi mật khẩu.
    public function Doi_MK()
    {
        return view('doimatkhau');
    }

    // Hàm load trang quên mật khẩu.
    public function Quen_MK()
    {
        return view('quenmatkhau');
    }

    // Hàm load trang thông tin và liên hệ.
    public function ThongTin_LienHe()
    {
        return view('thongtin');
    }
}
