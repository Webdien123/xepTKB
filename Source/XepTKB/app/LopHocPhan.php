<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Lớp định nghĩa các hàm tham tác trên dữ liệu bảng lớp học phần.
class LopHocPhan extends Model
{
    public static function GetLopHP($ma_hp)
    {
        $hocphan = \DB::select('SELECT * FROM `lop_hoc_phan` WHERE MAHP = ?', [$ma_hp]);
        return $hocphan;
    }
}
