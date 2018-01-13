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
        $hocphan = \DB::select('SELECT THU, TIETBD, SOTIET, TENHP, PHONG FROM `lop_hoc_phan` WHERE MAHP = ? AND KIHIEU = ?', [$ma_hp, $kihieu]);
        return $hocphan;
    }
}
