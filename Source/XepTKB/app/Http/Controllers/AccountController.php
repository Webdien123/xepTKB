<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\NguoiDung;
use Hash;

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
            $kq_kichhoat = NguoiDung::KichHoat($email);

            if ($kq_kichhoat) {

                // Tìm người dùng theo email.
                $nguoidung = NguoiDung::TimEmail($email);

                return view('login', [
                    'mssv_xac_thuc' => $nguoidung[0]->MSSV,
                    'ketqua_xuly' => 'Kích hoạt thành công'
                ]);
            } else {
                return route('error', [
                    'mes' => 'Kích hoạt tài khoản thất bại',
                    're' => 'Vui lòng đăng nhập và thử lại']
                );
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

    // Xử lý đăng nhập.
    public function Login_Process(Request $R)
    {
        // Tính giá trị các input.
        $mssv = $R->mssv;
        $password = $R->password;

        // Tìm người dùng theo mã số sinh viên.
        $nguoidung = NguoiDung::TimMSSV($mssv);

        if ($nguoidung != null) {

            // Nếu tài khoản người dùng đã kích hoạt.
            if ($nguoidung[0]->KICHHOAT == "Y")

                // Tính kết quả đăng nhập.
                if (Hash::check($password, $nguoidung[0]->MKHAU)) {

                    // Tạo phiên làm việc.
                    \Session::put('mssv_login', $mssv);
                    \Session::put('name_login', $nguoidung[0]->HOTEN);
                    \Session::put('email_login', $nguoidung[0]->EMAIL);
                    \Session::put('malop_login', $nguoidung[0]->MALOP);

                    // Load trang tạo tkb.
                    return redirect('taotkb');
                    
                } else {
                    $errors = new MessageBag(['errorlogin' => 'MSSV hoặc mật khẩu không đúng.']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }                
                
            else {
                return MailController::GuiMail_KichHoat_P(
                    $nguoidung[0]->EMAIL,
                    $nguoidung[0]->HOTEN
                );
            }
        }
        else {
            $errors = new MessageBag(['errorlogin' => 'Tài khoản này chưa được đăng ký.']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    // Xử lý đăng xuất.
    public function Logout()
    {
        // Xóa phiên làm việc của người đang đăng nhập.
        \Session::forget('mssv_login');
        \Session::forget('name_login');
        \Session::forget('email_login');
        \Session::forget('malop_login');

        // Load trang chủ.
        return redirect('/');
    }

    // Đổi mật khẩu.
    public function DoiMK(Request $R)
    {
        if (\Session::has('mssv_login')){
            // Nhận giá trị từ input.
            $old_pass = $R->old_pass;
            $new_pass = $R->new_pass;

            // Lấy thông tin người dùng đang đăng nhập.
            $nguoidung = NguoiDung::TimMSSV(\Session::get('mssv_login'));

            // Nếu mật khẩu cũ khớp mật khẩu đang dùng.
            if (Hash::check($old_pass, $nguoidung[0]->MKHAU)) {

                // Cập nhật mật khẩu mới cho người dùng
                NguoiDung::Update_Password($nguoidung[0]->MSSV, $new_pass);

                // Xóa phiên làm việc của người đang đăng nhập.
                \Session::forget('mssv_login');
                \Session::forget('name_login');
                \Session::forget('email_login');
                \Session::forget('malop_login');                

                // Về trang đăng nhập.
                return view('login', [
                    'mssv_xac_thuc' => $nguoidung[0]->MSSV,
                    'ketqua_xuly' => 'Đổi mật khẩu thành công'
                ]);
            }
            else {
                $errors = new MessageBag(['errorlogin' => 'Mật khẩu cũ không đúng.']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Reset password.
    public function Reset_MK(Request $R)
    {
        // Nhận giá trị từ input.
        $pass_num = $R->pass_num;
        $pass = $R->pass;
        $mssv = $R->mssv;

        // Lấy thông tin người dùng đang đăng nhập.
        $nguoidung = NguoiDung::TimMSSV($mssv);

        // Nếu mật khẩu cũ khớp mật khẩu đang dùng.
        if (\Session::get('ma_so_re_pass') == $pass_num) {

            // Cập nhật mật khẩu mới cho người dùng
            NguoiDung::Update_Password($mssv, $pass);

            // Về trang đăng nhập.
            return view('login', [
                'mssv_xac_thuc' => $mssv,
                'ketqua_xuly' => 'Đặt lại mật khẩu thành công'
            ]);
        }
        else {
            $errors = new MessageBag(['errorlogin' => 'Mã số không đúng.']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
