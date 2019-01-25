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

            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['title'] = $row['title'];
                    $data['description'] = $row['description'];

                    if(!empty($data)) {
                        DB::table('post')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }
    // =================================================================================
}
