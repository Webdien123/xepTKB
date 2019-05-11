<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\XepTKB;

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

            // Tính stt của tkb cần tạo.
            $so_luong = XepTKB::GetSoTkb(\Session::get('mssv_login'));
            $stt = $so_luong + 1;            

            return view('taotkb', [
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc,
                'stt_tkb' => $stt
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
        try {
            // Lấy MSSV.
            $mssv = $R->mssv;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;

            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy stt cần lưu.
            $stt = $R->stt;

            $array = (array) $R->ds_hp_can_luu;

            $size = sizeof($array);

            for ($i=0; $i < $size; $i++) {
                $mahp = $array[$i]["MAHP"];
                $kihieu = $array[$i]["KIHIEU"];

                if ($i == 0 || ($i > 0 && $array[$i]["MAHP"] != $array[$i-1]["MAHP"]) ) {
                    XepTKB::InsertXepTKB($mssv, $mahp, $kihieu, $namhoc, $hocki, $stt);
                }
            }

            return "ok";
        } catch (Exception $e) {
            // return $e->getMessage();
            return "fail";
        }
    }

    public function GetSoLuongTKB(Request $R)
    {
        $so_luong = XepTKB::GetSoTkb($R->mssv);
        $stt = $so_luong + 1;
        return $stt;
    }
}
