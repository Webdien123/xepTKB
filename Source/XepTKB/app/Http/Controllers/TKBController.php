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
            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;

            return view('taotkb', [
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc
            ]);
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
            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;
            
            return view('thoikhoabieu',[
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc
            ]);
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    public function Luu_TKB_Moi(Request $R)
    {
        return $R->ds_hp_can_luu[0];
        // return $R->mssv;
    }
}
