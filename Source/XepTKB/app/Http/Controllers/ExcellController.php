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
            return view('importExport');
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
