<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Mail;

// Lớp xử lý gửi mail.
class MailController extends Controller
{
    // Xử lý gửi mail xác thực.
    public static function GuiMail($email, $name)
    {
        try{
            // Tính random mã số xác thực.
            $ma_so_xac_thuc = mt_rand(100000, 999999);

            // Thêm mã số vào session.
            \Session()->put('ma_so_xac_thuc', $ma_so_xac_thuc);

            // Tạo nội dung dựa theo tên người nhận
            $content = [
                'noidung'=> 'Xin chào '. $name .
                    "<br>Mã số kích hoạt tài khoản của bạn là: " . $ma_so_xac_thuc
            ];

            Mail::to($email)->send(new OrderShipped($content));

            return "OK";
        }
        catch(\Exception $e){
            // return "LOI";
            return $e->getMessage();
        }
    }

    // Xử lý gửi mail.
    public static function FunctionName(Type $var = null)
    {
        # code...
    }
}
