<?php

namespace App\Http\Controllers;

use App\Models\Mutabaah;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeAdminController extends Controller
{
    public function index(){

        $santri = Santri::all();
        $mutabaah = Mutabaah::all();

        $asrama = DB::select("SELECT asrama , COUNT(asrama) as `count` from santri GROUP BY asrama");
        $kelas = DB::select("SELECT kelas , COUNT(kelas) as `count` from santri GROUP BY kelas ORDER BY kelas DESC");
        $fakultas = DB::select("SELECT jenjang as `fakultas` , COUNT(kelas) as `count` from santri GROUP BY jenjang ORDER BY kelas DESC");

        $countSantri = count($santri->all());
        $countIkhwan = $santri->where('jk','=','1')->count();
        $countAkhwat = $santri->where('jk','=','2')->count();
        $countAgenda = $mutabaah->where('deleted_at','=',null)->count(); 
        $widget= [
            // "santri"=>$santri,
            "countAgenda"=>$countAgenda,
            "countSantri"=>$countSantri,
            "countAkhwat"=>$countAkhwat,
            "countIkhwan"=>$countIkhwan,
            "asrama"=>$asrama,
            "fakultas"=>$fakultas,
            "kelas"=>$kelas,
        ];
        // return $widget;
        return view('admin.dashboard.home')->with(compact('widget'));
    }
}
