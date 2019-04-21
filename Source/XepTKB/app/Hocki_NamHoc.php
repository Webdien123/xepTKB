<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hocki_NamHoc extends Model
{
    public static function UpdateHocKi($hockimoi)
    {        
        \DB::update('update hocki set HOCKI = ?', [$hockimoi]);        
    }

    public static function UpdateNamHoc($namhocmoi)
    {        
        \DB::update('update namhoc set namhoc = ?', [$namhocmoi]);        
    }
}
