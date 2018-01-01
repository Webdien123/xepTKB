<?php

// Lớp định nghia các hàm load các trang giao diện không cần đọc data trước.
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Hàm load trang đăng ký tài khoản.
    public function Load_Dky()
    {
        return view('dky_taikhoan');
    }
}
