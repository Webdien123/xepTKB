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
            $kq_kh = NguoiDung::KichHoat($email);

            if ($kq_kh) {

                // Tìm người dùng theo email.
                $nguoidung = NguoiDung::TimEmail($email);

                return view('login', ['mssv_xac_thuc' => $nguoidung[0]->MSSV]);
            } else {
                return "LỖI KHI KÍCH HOẠT TÀI KHOẢN";
            }
            
        }
        else {

            if (\Session::has('ma_so_xac_thuc')) {
                return view("xac_nhan_maso", [
                    'email' => $email,
                    'status' => 'Err'
                ]);
            } else {
                return view("xac_nhan_maso", [
                    'email' => $email,
                    'status' => 'Over'
                ]);
            }            
        }
    }

    public function Login_Process(Request $R)
    {
        // Tính giá trị các input.
        $mssv = $R->mssv;
        $password = $R->password;

        // Tìm người dùng theo mã số sinh viên.
        $nguoidung = NguoiDung::TimMSSV($mssv);

        if ($nguoidung != null) {

            if ($nguoidung[0]->KICHHOAT == "Y")
                return "OK";
            else {
                return MailController::GuiMail_KichHoat_P(
                    $nguoidung[0]->EMAIL, $nguoidung[0]->HOTEN
                );
            }
        }
        else {
            $errors = new MessageBag(['errorlogin' => 'Tài khoản này chưa được đăng ký.']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
