<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\MessageBag;
use App\NguoiDung;
use Mail;

// Lớp xử lý gửi mail.
class MailController extends Controller
{
    // Xử lý gửi mail xác thực.
    public static function GuiMail($email, $content, $mail_type = "dangky", $mssv_mail = "")
    {
        try{
            Mail::to($email)->send(new OrderShipped($content));

            // Nếu yêu cầu gửi mail từ trang quên mật khẩu.
            if ($mail_type == "quenmk") {
                
                // Về trang reset password.
                $info = new MessageBag(['mssv' => $mssv_mail]);                
                return redirect('reset_pass')->withErrors($info);
            }

            else {
                // Về trang xác nhận mã số.
                return view('xac_nhan_maso', [
                    'email' => $email,
                    'status' => ''
                ]);
            }
            
        }
        catch(\Exception $e){

            if ($mail_type == "dangky") {

                // Tìm tài khoản theo email.
                $nguoidung = NguoiDung::TimEmail($email);

                return view("error_mail", [
                    'email' => $email,
                    '$name' => $nguoidung[0]->EMAIL,
                    'mail_type' => $mail_type
                ]);
            }

            if ($mail_type == "quenmk") {

                return view("error_mail", [
                    'email' => $email,
                    'mail_type' => $mail_type
                ]);
            }

            // return $e->getMessage();
        }
    }

    // Xử lý gửi mail xác thực đăng ký (dạng API).
    public function GuiMail_KichHoat(Request $R)
    {
        // // Tính random mã số xác thực.
        $ma_so_xac_thuc = mt_rand(100000, 999999);

        // // Thêm mã số vào session.
        \Session()->put('ma_so_xac_thuc', $ma_so_xac_thuc);

        // // Tạo nội dung dựa theo tên người nhận
        $content = [
            'noidung'=> 'Xin chào '. $R->name .
                "<br>Mã số kích hoạt tài khoản của bạn là: " . $ma_so_xac_thuc
        ];

        // Gọi hàm xử lý gửi mail.
        return MailController::GuiMail($R->email, $content, $R->mail_type);
    }

    // Xử lý gửi mail xác thực đăng ký (dạng tham số).
    public static function GuiMail_KichHoat_P($email, $name)
    {
        // Tính random mã số xác thực.
        $ma_so_xac_thuc = mt_rand(100000, 999999);

        // Thêm mã số vào session.
        \Session()->put('ma_so_xac_thuc', $ma_so_xac_thuc);

        // Tạo nội dung dựa theo tên người nhận
        $content = [
            'noidung'=> 'Xin chào '. $name .
                "<br>Mã số kích hoạt tài khoản của bạn là: " . $ma_so_xac_thuc
        ];

        // Gọi hàm xử lý gửi mail.
        return MailController::GuiMail($email, $content);
    }

    // Tạo chuỗi ngẫu nhiên.
    public static function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Xử lý gửi mail lấy lại mật khẩu.
    public function GuiMail_QuenMK(Request $R)
    {
        // Lấy giá trị input.
        $email = $R->email;

        // Tìm tài khoản theo email.
        $nguoidung = NguoiDung::TimEmail($email);

        if ($nguoidung != null) {
            $temp_pass = MailController::generateRandomString(25);

            // Thêm mã số vào session.
            \Session()->put('ma_so_re_pass', $temp_pass);

            // Cập nhạt mật khẩu cho người dùng.
            NguoiDung::Update_Password($nguoidung[0]->MSSV, $temp_pass);

            // Tạo nội dung dựa theo tên người nhận
            $content = [
                'noidung'=> 'Xin chào '. $R->name .
                    "<br>Copy dòng mã dưới đây dán lên trang reset mật khẩu để đặt mật khẩu mới:<br>".
                    $temp_pass
            ];

            // Về trang reset mật khẩu.
            return MailController::GuiMail($email, $content, "quenmk", $nguoidung[0]->MSSV);
        } else {
            $errors = new MessageBag(['errorlogin' => 'Email này chưa được đăng ký.']);
            return redirect()->back()->withInput()->withErrors($errors);
        }        
    }
}
