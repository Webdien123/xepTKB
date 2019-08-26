<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Post;
use DB;
use Session;
use Excel;


// Class xử lý nhập xuất excell, 
class ExcellController extends Controller
{
	// =================================================================================
	// EXAMPLE CODE
	// =================================================================================

    // Lấy view xuất nhập excell.
    public function importExport()
    {
        // dd(\Session::get('mssv_login'));
        if (\Session::get('mssv_login') == "admin"){

            // ========================================
            // Phần kiểm tra dữ liệu học kì mới tự động
            // Lấy học kì hiện tại.
            $hocki = \DB::select('select * from hocki', [1]);
            $hocki = $hocki[0]->HOCKI;

            // Lấy năm học hiện tại.
            $namhoc = \DB::select('select * from namhoc', [1]);
            $namhoc = $namhoc[0]->NAMHOC;
            $namhoc_1 =  (int)substr($namhoc, 0, 2);
            $namhoc_2 =  (int)substr($namhoc, 3, 2);

            if (($hocki + 1) > 3) {
                $hocki = 1;
                $namhoc_1++;
                $namhoc_2++;
            }
            else{
                $hocki++;
            }

            $url = "https://dkmh2.ctu.edu.vn/tracuu/DANHSACHHOCPHANMOHK".$hocki."_".$namhoc_1 . "_" . $namhoc_2.".XLS";
            // ============================================================

            return view('importExport', [
                'link_file' => $url,
                'hki_hientai' => $hocki,
                'namhoc_hientai' => $namhoc
            ]);
        }
        else{
            return redirect('/');
        }
    }

    public function downloadExcel($type)
    {
        $data = Post::get()->toArray();
        return Excel::create('laravelcode', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    
    // Xử lý import lớp học phần.
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            ini_set('max_execution_time', 900);
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['MAHP'] = $row['ma_hp'];
                    $data['TENHP'] = $row['ten_hoc_phan'];
                    $data['KIHIEU'] = $row['ky_hieu'];
                    $data['THU'] = $row['thu'];
                    $data['TIETBD'] = $row['tiet_bd'];
                    $data['SOTIET'] = $row['so_tiet'];
                    $data['PHONG'] = $row['phong'];
                    $data['SISO'] = $row['si_so'];                    
                    $data['TINCHI'] = $row['tin_chi'];
                    $data['MALOP'] = $row['lop'];
                    $data['TUANHOC'] = $row['tuan_hoc'];

                    if(!empty($data)) {
                        \DB::table('lop_hoc_phan')->insert($data);
                    }
                }
            });
        }

        ini_set('max_execution_time', 30);
        DD("IMPORT THÀNH CÔNG");

        return back();
    }
    // =================================================================================
}
