<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\NguoiDung;

// Lớp xử lý các thao tác trên thông tin tài khoản.
class AccountController extends Controller
{
    // Xử lý đăng kí.
    public function Dangki_Process(Request $R)
    {
        // Tính giá trị các input.
        $name = $R->name;
        $email = $R->email;
        $malop = $R->malop;
        $mssv = $R->mssv;
        $password = $R->password;

        // Nhận và trả về kết quả đăng ký thông tin ở Model NguoiDung.
        return NguoiDung::DangKyThongTin($name, $email, $malop, $mssv, $password);
    }
}
