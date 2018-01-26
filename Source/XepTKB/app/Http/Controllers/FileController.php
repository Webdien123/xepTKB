<?php
// Lớp định nghĩa các hàm xử lý file ảnh thu nhỏ TKB
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function Save_TKB_Img(Request $R)
    {
        if (\Session::has('mssv_login')){
            $imagedata = base64_decode($R->imgdata);
            $filename = $R->id_tkb."_".$R->hocki."-".$R->namhoc;

            // require_once $_SERVER['DOCUMENT_ROOT'] . 'tkb_img/';

            //path where you want to upload image
            $file = $_SERVER['DOCUMENT_ROOT'] . 'tkb_img/'.$filename.'.png';
            // $imageurl  = 'http://example.com/uploads/'.$filename.'.png';
            file_put_contents($file, $imagedata);
            // echo $imageurl;
            return $file;
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }
}
