<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function barangmasuk(){
        $all=DB::select('SELECT tglform from riwayat group by tglform order by tglform asc');
        foreach($all as $a){
            $tgl=$a->tglform;
            $masuk=DB::select("SELECT noform from riwayat where tglform='$tgl' and keluar=0 group by noform");
            if(count($masuk)!=0){
                $tglm=strtotime($tgl)*1000;
                $jum=count($masuk);
            }else{
                $tglm=strtotime($tgl)*1000;
                $jum=0;
            }
            $datamasuk[]=[$tglm,$jum];
        }
        // dd($datamasuk);
        return $datamasuk;
    }
        public function barangkeluar(){
        $all=DB::select('SELECT tglform from riwayat group by tglform order by tglform asc');
        foreach($all as $a){
            $tgl=$a->tglform;
            $keluar=DB::select("SELECT noform from riwayat where tglform='$tgl' and masuk=0 group by noform");
            if(count($keluar)!=0){
                $tglm=strtotime($tgl)*1000;
                $jum=count($keluar);
            }else{
                $tglm=strtotime($tgl)*1000;
                $jum=0;
            }
            $datakeluar[]=[$tglm,$jum];
        }
        // dd($datamasuk);
        return $datakeluar;
    }
}