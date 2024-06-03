<?php


namespace App\Helper;

use Illuminate\Support\Facades\Auth;

Class Utils {

    public static function changeDate($date){
        $datenow =  \Carbon\Carbon::parse($date)->format('d/m/Y');

        return $datenow;
    }

}