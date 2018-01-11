<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LopHocPhan;

// Lớp định nghía các hàm thao tác trên các học phần đang mở.
class HocPhanController extends Controller
{
    public function TimHP(Request $R)
    {
        $ma_hp = $R->ma_hp;
        $hocphan = LopHocPhan::GetLopHP($ma_hp);
        return $hocphan;
    }
}
