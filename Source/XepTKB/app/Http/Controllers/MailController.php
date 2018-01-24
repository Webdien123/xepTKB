<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Mail;

// Lớp xử lý gửi mail.
class MailController extends Controller
{
    // Xử lý gửi mail xác thực.
    public static function GuiMail($email, $content)
    {
        try{

            Mail::to($email)->send(new OrderShipped($content));

            // Về trang xác nhận mã số.
            return view('xac_nhan_maso', [
                'email' => $email,
                'status' => ''
            ]);
        }
        catch(\Exception $e){
            // return "LOI";
            return $e->getMessage();
        }
    }

    // Xử lý gửi mail xác thực đăng ký (dạng API).
    public function GuiMail_KichHoat(Request $R)
    {
        // Tính random mã số xác thực.
        $ma_so_xac_thuc = mt_rand(100000, 999999);

        // Thêm mã số vào session.
        \Session()->put('ma_so_xac_thuc', $ma_so_xac_thuc);

        // Tạo nội dung dựa theo tên người nhận
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
}
