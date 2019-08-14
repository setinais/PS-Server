<?php


namespace App\Http\Controllers\Voyager;

class VoyagerCalendarioController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    //
    public function data(){
        return view('vendor.voyager.calendarios.datas');
    }
}