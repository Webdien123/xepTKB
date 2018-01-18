<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LopHocPhan;

// Lớp định nghía các hàm thao tác trên các học phần đang mở.
class HocPhanController extends Controller
{
    // Tìm HP theo mã học phần.
    public function TimHP(Request $R)
    {
        $ma_hp = $R->ma_hp;
        $hocphan = LopHocPhan::GetLopHP($ma_hp);
        return $hocphan;
    }

    // Tìm thời gian học của học phần theo mã HP và kí hiệu.
    public function LayTGianHoc(Request $R)
    {
        $ma_hp = $R->ma_hp;
        $kihieu = $R->kihieu;
        $hocphan = LopHocPhan::GetTimeHP($ma_hp, $kihieu);
        return $hocphan;
    }

    // Hàm load học kì hiện tại.
    public function LayHKiHienTai(Request $R)
    {
        $hocki = LopHocPhan::GetHKI();
        return $hocki;
    }

    // Hàm load năm học hiện tại.
    public function LayNamHocHienTai(Request $R)
    {
        $namhoc = LopHocPhan::GetNAMHOC();
        return $namhoc;
    }    
}
