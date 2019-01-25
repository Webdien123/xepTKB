<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Lớp định nghia các hàm load các trang giao diện không cần đọc data trước.
class PageController extends Controller
{
    // Hàm load trang đăng ký tài khoản.
    public function Dky_TaiKhoan()
    {
        return view('dky_taikhoan');
    }

    // Hàm load trang nhập mã số xác nhận sau khi gửi mail.
    public function Xac_Nhan_MS()
    {
        return view('xac_nhan_maso');
    }

    // Hàm load trang thông báo gửi mail thất bại.
    public function Error_Mail()
    {
        return view('error_mail');
    }

    // Hàm load trang đăng nhập.
    public function Login()
    {
        // ========================================
        // Phần kiểm tra dữ liệu học kì mới tự động

        // Lấy học kì hiện tại.
        $hocki = \DB::select('select * from hocki', [1]);
        $hocki = $hocki[0]->HOCKI;

        // Lấy năm học hiện tại.
        $namhoc = \DB::select('select * from namhoc', [1]);
        $namhoc = $namhoc[0]->NAMHOC;
        $namhoc_1 =  (int)substr($namhoc, 0, 2);
        $namhoc_2 =  (int)substr($namhoc, 3, 2);

        if (($hocki + 1) > 3) {
            $hocki = 1;
            $namhoc_1++;
            $namhoc_2++;
        }
        else{
            $hocki++;
        }

        $url = "https://dkmh2.ctu.edu.vn/tracuu/DANHSACHHOCPHANMOHK".$hocki."_".$namhoc_1 . "_" . $namhoc_2.".XLS";

        // echo "Học ki kế tiếp: " . $hocki;
        // echo "<br>Năm học kế tiếp: " . $namhoc_1 . "-" . $namhoc_2;
        // echo "<br>".$url;
        
        $headers = @get_headers($url);
        if(strpos($headers[0],'404') === false)
        {
            echo "<br>Đã có lịch mới";
        }
        else
        {
            // Load trang login.
            if (\Session::has('mssv_login')){
                return redirect('taotkb');
            }
            return view('login', [
                'mssv_xac_thuc' => '',
                'ketqua_xuly' => ''
            ]);
        }
    }

    // Hàm load trang đổi mật khẩu.
    public function Doi_MK()
    {
        if (\Session::has('mssv_login')){
            return view('doimatkhau');
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Hàm load trang quên mật khẩu.
    public function Quen_MK()
    {
        return view('quenmatkhau');
    }

    // Hàm load trang thông tin và liên hệ.
    public function ThongTin_LienHe()
    {
        if (\Session::has('mssv_login')){
            return view('thongtin', [
                'ketqua_xuly' => ''
            ]);
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Hàm load trang báo lỗi.
    public function Error($mes, $re)
    {
        return view('Error', [
            'mes' => $mes,
            're' => $re
        ]);
    }

    // Hàm load trang reset password.
    public function Reset_MK()
    {
        return view('reset_pass');
    }
}
