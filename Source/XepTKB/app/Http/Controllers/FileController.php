<?php
// Lớp định nghĩa các hàm xử lý file ảnh thu nhỏ TKB
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function Save_TKB_Img(Request $R)
    {
        if (\Session::has('mssv_login')){

            try {
                $imagedata = $R->tkb_img_url;
                $filename = \Session::get("mssv_login")."_".$R->hocki."_".$R->namhoc;

                //path where you want to upload image
                $file = $_SERVER['DOCUMENT_ROOT'].'/tkb_img/'.\Session::get("mssv_login").'/'.$filename.'.png';
                copy($imagedata, $file);
                return "ok";
            } catch (Exception $e) {
                return "fail";
            }
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }
}
