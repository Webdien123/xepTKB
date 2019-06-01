<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\XepTKB;
use File;

// Lớp định nghĩa các hàm xử lý thời khóa biểu.
class TKBController extends Controller
{
    // Hàm load trang tạo TKB mới.
    public function Tao_TKB()
    {
        if (\Session::has('mssv_login')){
            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;

            // Tính stt của tkb cần tạo.
            $so_luong = XepTKB::GetSoTkb(\Session::get('mssv_login'));
            $stt = $so_luong + 1;            

            return view('taotkb', [
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc,
                'stt_tkb' => $stt
            ]);
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Hàm load trang quản lý tkb cũ.
    public function QLy_TKB()
    {
        if (\Session::has('mssv_login')){
            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;

            // Tính số tkb đã có.
            $so_luong = XepTKB::GetSoTkb(\Session::get('mssv_login'));

            // Xóa cache trình duyệt để cập nhật hình ảnh mới nhất.
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');
            
            return view('thoikhoabieu',[
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc,
                'so_luong_tkb' => $so_luong
            ]);
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Cập nhật TKB cũ.
    public function Edit_TKB($stt)
    {
        if (\Session::has('mssv_login')){
            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;          

            return view('edit_tkb', [
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc,
                'stt_tkb' => $stt
            ]);
        }
        return view('login', [
            'mssv_xac_thuc' => '',
            'ketqua_xuly' => ''
        ]);
    }

    // Lưu thời khóa biểu mới.
    public function Luu_TKB_Moi(Request $R)
    {
        try {
            // Lấy MSSV.
            $mssv = $R->mssv;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;

            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy stt cần lưu.
            $stt = $R->stt;

            $array = (array) $R->ds_hp_can_luu;

            $size = sizeof($array);

            for ($i=0; $i < $size; $i++) {
                $mahp = $array[$i]["MAHP"];
                $kihieu = $array[$i]["KIHIEU"];

                if ($i == 0 || ($i > 0 && $array[$i]["MAHP"] != $array[$i-1]["MAHP"]) ) {
                    XepTKB::InsertXepTKB($mssv, $mahp, $kihieu, $namhoc, $hocki, $stt);
                }
            }

            return "ok";
        } catch (Exception $e) {
            // return $e->getMessage();
            return "fail";
        }
    }

    // Xóa thời khóa biểu.
    public function Delete_TKB(Request $R)
    {
        try {
            // Xóa dữ liệu.
            XepTKB::Delete_XepTKB($R->mssv, $R->stt);

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;

            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Xóa ảnh thu nhỏ.
            File::delete(public_path('tkb_img/'.$R->mssv.'/'.$R->stt.'_'.$hocki.'_'.$namhoc.'.png'));

            // Đổi tên thứ tự các ảnh sau thời khóa biểu đã xóa.
            $i = $R->stt;
            while(file_exists(public_path('tkb_img/'.$R->mssv.'/'.($i + 1).'_'.$hocki.'_'.$namhoc.'.png'))) {
                File::move(
                    public_path('tkb_img/'.$R->mssv.'/'.($i + 1).'_'.$hocki.'_'.$namhoc.'.png'),
                    public_path('tkb_img/'.$R->mssv.'/'.$i.'_'.$hocki.'_'.$namhoc.'.png')
                );
                $i++;
            }
            
            return "ok";
        } catch (Exception $e) {
            // return $e->getMessage();
            return "fail";
        }
    }
}
