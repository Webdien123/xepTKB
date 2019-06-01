<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XepTKB extends Model
{
    // Lấy số tkb người dùng đăng nhập đã tậo.
    public static function GetSoTkb($mssv)
    {
        $count_user_tkb = \DB::select("SELECT DISTINCT `MSSV`, `STT` FROM `xep_tkb` WHERE MSSV = ?",[$mssv]);
        $count = sizeof($count_user_tkb);

        return $count;
    }

    // Lấy thông tin đăng ký học phần.
    public static function GetXepTKB($mssv, $stt)
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

    // Xóa thời khóa biểu.
    public static function Delete_XepTKB($mssv, $stt)
    {
        \DB::delete('DELETE FROM `xep_tkb` WHERE MSSV = ? AND STT = ?', [
            $mssv,
            $stt
        ]);

        \DB::update('UPDATE `xep_tkb` SET `STT` = STT - 1 WHERE STT > ?', [$stt]);
    }
}
