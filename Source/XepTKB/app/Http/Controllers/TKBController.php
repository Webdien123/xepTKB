<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Lớp định nghĩa các hàm xử lý thời khóa biểu.
class TKBController extends Controller
{
    // Hàm load trang tạo TKB mới.
    public function Tao_TKB()
    {
        return view('taotkb');
    }

    // Hàm load trang quản lý tkb cũ.
    public function QLy_TKB()
    {
        return view('thoikhoabieu');
    }
}
