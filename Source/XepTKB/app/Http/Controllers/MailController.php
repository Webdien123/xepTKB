<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Mail;

// Lớp xử lý gửi mail.
class MailController extends Controller
{
    // Xử lý gửi mail xác thực.
    public function GuiMail()
    {
        try{
            // Tạo nội dung dựa theo tên người nhận
            $content = [
                'noidung'=> 'Xin chào '.
                    "<br>Mã số kích hoạt tài khoản của bạn là: "
            ];

            // Gửi mail.
            // Mail::to($email)->send(new ChuyenMail($content));

            $receiverAddress = 'lyvamax2018@gmail.com';

            Mail::to($receiverAddress)->send(new OrderShipped($content));

            return "OK";
        }
        catch(\Exception $e){
            // return "LOI";
            dd($e->getMessage());
        }
    }
}
