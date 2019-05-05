<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XepTKB extends Model
{
    // Lấy thông tin đăng ký học phần.
    public function GetXepTKB($mssv, $namhoc, $hocki)
    {
        # code...
    }

    // Thêm thông tin đăng ký học phần mới.
    public static function InsertXepTKB($mssv, $mahp, $kihieu, $namhoc, $hocki)
    {
        \DB::insert('insert into xep_tkb (`MSSV`, `MAHP`, `KIHIEU`, `NAMHOC`, `HOCKI`) VALUES (?, ?, ?, ?, ?) ', [
            $mssv, $mahp, $kihieu, $namhoc, $hocki
        ]);
    }
}
