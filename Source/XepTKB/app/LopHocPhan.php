<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Lớp định nghĩa các hàm tham tác trên dữ liệu bảng 'lophocphan'.
class LopHocPhan extends Model
{
    protected $table = 'lop_hoc_phan';

    public static function vn_to_str($str){
        $unicode = array(
         
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
         
        'd'=>'đ',
         
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
         
        'i'=>'í|ì|ỉ|ĩ|ị',
         
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
         
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
         
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
         
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
         
        'D'=>'Đ',
         
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
         
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
         
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
         
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
         
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
         
        );
         
        foreach($unicode as $nonUnicode=>$uni){
         
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
         
        }
        $str = str_replace(' ','_',$str);
         
        return $str;
         
    }

    // Truy xuất lớp HP theo mã HP hoặc tên HP.
    public static function GetLopHP($ma_hp)
    {        
        $hocphan = \DB::table('lop_hoc_phan')
            ->distinct()->select('MAHP','TENHP')
            ->where('MAHP', '=', $ma_hp)
            ->orWhere('TENHP', 'like', "%$ma_hp%")
            ->get();
        return $hocphan;
    }

    // Truy xuất thời gian học của học phần.
    public static function GetTimeHP($ma_hp, $kihieu)
    {
        $hocphan = \DB::select('SELECT MAHP, THU, TIETBD, SOTIET, TENHP, PHONG FROM `lop_hoc_phan` WHERE MAHP = ? AND KIHIEU = ?', [$ma_hp, $kihieu]);
        return $hocphan;
    }

    // Truy xuất học kì hiện tại.
    public static function GetHKI()
    {
        $hocki = \DB::select('SELECT * FROM `hocki` WHERE 1 LIMIT 1');
        return $hocki;
    }

    // Truy xuất năm học hiện tại.
    public static function GetNAMHOC()
    {
        $namhoc = \DB::select('SELECT * FROM `namhoc` WHERE 1 LIMIT 1');
        return $namhoc;
    }

    // Truy xuất lịch họp cố vấn học tập.
    public static function GetLichCoVan($malop)
    {
        $lich_cv = \DB::select('SELECT * FROM `lop_hoc_phan` WHERE MALOP = ?', [$malop]);
        return $lich_cv;
    }
}
