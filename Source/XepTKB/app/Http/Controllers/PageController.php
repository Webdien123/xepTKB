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

    // Hàm load trang thông báo gửi mail thất bại.
    // public function Error_Mail()
    // {
    //     return view('error_mail');
    // }

    // Hàm load trang đăng nhập.
    public function Login()
    {
        if (\Session::has('mssv_login')){
            return redirect('taotkb');
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Hàm load trang đổi mật khẩu.
    public function Doi_MK()
    {
        if (\Session::has('mssv_login')){
            return view('doimatkhau');
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
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

    // Hàm load trang báo lỗi.
    public function Error($mes, $re)
    {
        return view('Error', [
            'mes' => $mes,
            're' => $re
        ]);
    }

    // Hàm load trang reset password.
    public function Reset_MK()
    {
        return view('reset_pass');
    }
}
