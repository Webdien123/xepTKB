<?php
// Lớp định nghĩa các hàm xử lý file ảnh thu nhỏ TKB
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class FileController extends Controller
{
    // Lưu ảnh thu nhỏ
    public function Save_TKB_Img(Request $R)
    {
        if (\Session::has('mssv_login')){

            try {
                $imagedata = $R->tkb_img_url;
                $filename = $R->stt."_".$R->hocki."_".$R->namhoc;

                $data = $R->tkb_img_url;
                list($img_type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                //path where you want to upload image
                $path = $_SERVER['DOCUMENT_ROOT'].'/tkb_img/'.\Session::get("mssv_login").'/'.$filename.'.png';

                file_put_contents($path, $data);

                //path where you want to upload image
                // $file = $_SERVER['DOCUMENT_ROOT'].'/tkb_img/'.\Session::get("mssv_login").'/'.$filename.'.png';

                // if(file_exists($_SERVER['DOCUMENT_ROOT'].'/tkb_img/'.\Session::get("mssv_login").'/'.$filename.'.png')){
                //     File::delete($_SERVER['DOCUMENT_ROOT'].'/tkb_img/'.\Session::get("mssv_login").'/'.$filename.'.png');
                // }
                
                // copy($imagedata, $file);
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
