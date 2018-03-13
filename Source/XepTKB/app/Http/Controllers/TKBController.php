<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Lớp định nghĩa các hàm xử lý thời khóa biểu.
class TKBController extends Controller
{
    // Hàm load trang tạo TKB mới.
    public function Tao_TKB()
    {
        if (\Session::has('mssv_login')){
            return view('taotkb');
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Hàm load trang quản lý tkb cũ.
    public function QLy_TKB()
    {
        if (\Session::has('mssv_login')){
            return view('thoikhoabieu');
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    public function Luu_TKB_Moi(Request $R)
    {
        // return $R->ds_hp_can_luu[0];
        return $R->mssv;
    }
}
