<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\NguoiDung;

// Lớp xử lý các thao tác trên thông tin tài khoản.
class AccountController extends Controller
{
    // Xử lý đăng kí.
    public function Dangki_Process(Request $R)
    {
        // Tính giá trị các input.
        $name = $R->name;
        $email = $R->email;
        $malop = $R->malop;
        $mssv = $R->mssv;
        $password = $R->password;

        // Nhận và trả về kết quả đăng ký thông tin ở Model NguoiDung.
        return NguoiDung::DangKyThongTin($name, $email, $malop, $mssv, $password);
    }

    // Kích hoạt tài khoản.
    public function KichHoat(Request $R)
    {
        // Tính giá trị các input.
        $maso = $R->maso;
        $email = $R->email;

        // Nếu mã số xác nhận khớp mã số cần xác thực.
        if ($maso == \Session::get('ma_so_xac_thuc')) {

            // Xóa mã số xác thực đi.
            \Session::forget('ma_so_xac_thuc');
            
            // Kích hoạt tài khoản.
            NguoiDung::KichHoat($email);
        }
        else {

            if (\Session::has('ma_so_xac_thuc')) {
                return view("xac_nhan_maso", [
                    'email' => $email,
                    'status' => 'Over'
                ]);
            } else {
                return view("xac_nhan_maso", [
                    'email' => $email,
                    'status' => 'Over'
                ]);
            }            
        }
    }
}
