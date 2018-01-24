<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\MailController;

// Lớp định nghĩa các hàm tham tác trên dữ liệu bảng 'nguoidung'.
class NguoiDung extends Model
{
    // Tìm thông tin người dùng theo mssv
    public static function TimMSSV($mssv)
    {
        $nguoidung = \DB::select('select * from nguoi_dung where mssv = ?', [$mssv]);
        if($nguoidung)
            return $nguoidung;
        else
            return null;
    }

    // Tìm thông tin người dùng theo email
    public static function TimEmail($email)
    {
        $nguoidung = \DB::select('select * from nguoi_dung where email = ?', [$email]);
        if($nguoidung)
            return $nguoidung;
        else
            return null;
    }

    // Đăng ký thông tin người dùng mới.
    public static function DangKyThongTin($name, $email, $malop, $mssv, $password)
    {
        // Tìm xem có người dùng nào trùng mssv vừa đăng ký không?
        $tim_mssv = NguoiDung::TimMSSV($mssv);

        // Nếu có, trả về trang đăng ký thông báo lỗi MSSV.
        if ($tim_mssv != null) {

            // Tìm xem có người dùng nào trùng email vừa đăng ký không?
            $tim_email = NguoiDung::TimEmail($email);

            // Nếu trùng cả email và mã số.
            if ($tim_email != null) {
                $errors = new MessageBag(['errorlogin' => 'MSSV và email đã tồn tại']);
                return redirect()->back()->withInput()->withErrors($errors);
            }

            $errors = new MessageBag(['errorlogin' => 'MSSV đã tồn tại']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        else{
            // Tìm xem có người dùng nào trùng email vừa đăng ký không?
            $tim_email = NguoiDung::TimEmail($email);

            // Nếu trùng cả Email.
            if ($tim_email != null) {
                $errors = new MessageBag(['errorlogin' => 'Email đã tồn tại']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }

        try{
            // Thêm thông tin tài khoản vào hệ thống.
            \DB::insert('INSERT INTO `nguoi_dung`(`MSSV`, `HOTEN`, `EMAIL`, `MKHAU`, `MALOP`) VALUES (?, ?, ?, ?, ?)', [
                $mssv, 
                ucwords($name),
                $email, 
                $password, 
                $malop
            ]);

            // Gửi mail xác thực và kích hoạt tài khoản.
            return MailController::GuiMail_KichHoat_P($email, $name);
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
        
    }

    // Kích hoạt tài khoản theo email.
    public static function KichHoat($email)
    {
        try{
            \DB::update('update nguoi_dung set kichhoat = "Y" where email = ?', [$email]);
            return true;
        }
        catch (\Exception $e){
            // return false;
            dd($e->getMessage());
        }
    }
}
