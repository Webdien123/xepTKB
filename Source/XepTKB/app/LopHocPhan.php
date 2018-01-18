<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Lớp định nghĩa các hàm tham tác trên dữ liệu bảng lớp học phần.
class LopHocPhan extends Model
{
    // Truy xuất lớp HP theo mã HP.
    public static function GetLopHP($ma_hp)
    {
        $hocphan = \DB::select('SELECT * FROM `lop_hoc_phan` WHERE MAHP = ?', [$ma_hp]);
        return $hocphan;
    }

    // Truy xuất thời gian học của học phần.
    public static function GetTimeHP($ma_hp, $kihieu)
    {
        $hocphan = \DB::select('SELECT MAHP, THU, TIETBD, SOTIET, TENHP, PHONG FROM `lop_hoc_phan` WHERE MAHP = ? AND KIHIEU = ?', [$ma_hp, $kihieu]);
        return $hocphan;
    }

    // Truy xuất học kì hiện tại.
    public static function GetHKI()
    {
        $hocki = \DB::select('SELECT * FROM `hocki` WHERE 1 LIMIT 1');
        return $hocki;
    }

    // Truy xuất năm học hiện tại.
    public static function GetNAMHOC()
    {
        $namhoc = \DB::select('SELECT * FROM `namhoc` WHERE 1 LIMIT 1');
        return $namhoc;
    }
}
