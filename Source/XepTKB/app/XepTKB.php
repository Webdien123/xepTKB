<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XepTKB extends Model
{
    // Lấy số tkb người dùng đăng nhập đã tậo.
    public static function GetSoTkb($mssv)
    {
        $count_user_tkb = \DB::select("SELECT `MSSV`, COUNT(MSSV) AS `SOLUONG` FROM `xep_tkb` WHERE MSSV = ?  GROUP BY MSSV",[$mssv]);

        if ($count_user_tkb) {
            return $count_user_tkb[0]->SOLUONG;
        }
        else {
            return 0;
        }
    }

    // Lấy thông tin đăng ký học phần.
    public static function GetXepTKB($mssv, $namhoc, $hocki)
    {
        
    }

    // Thêm thông tin đăng ký học phần mới.
    public static function InsertXepTKB($mssv, $mahp, $kihieu, $namhoc, $hocki, $stt)
    {
        // \DB::delete('delete from xep_tkb where 1');

        \DB::insert('insert into xep_tkb (`MSSV`, `MAHP`, `KIHIEU`, `NAMHOC`, `HOCKI`, `STT`) VALUES (?, ?, ?, ?, ?, ?) ', [
            $mssv, $mahp, $kihieu, $namhoc, $hocki, $stt
        ]);
    }
}
