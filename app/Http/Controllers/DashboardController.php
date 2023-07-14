<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\mastergolongan;
use App\Models\masterjenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $masterjenis=masterjenis::get();
        $mastergolongan=mastergolongan::get();
        $masterbarang=MasterBarang::get();
        $master=DB::select('SELECT * from master');
        $datatrkeluar=[];
        $datatrmasuk=[];
        foreach($master as $m){
            $kode=$m->kode;
            $nama=$m->nama;
            $transaksikeluar=DB::select("SELECT noform,kode,count(*) From riwayat where kode='$kode' and noform!='saldo_awal' and keluar!=0 group by noform,kode");
            $datatrkeluar[]=[
                'name'=>$nama,
                'y'=>count($transaksikeluar)
            ];

            $transaksimasuk=DB::select("SELECT noform,kode,count(*) From riwayat where kode='$kode' and noform!='saldo_awal' and masuk!=0 group by noform,kode");
            $datatrmasuk[]=[
                'kode'=>$kode,
                'totaltransmasuk'=>count($transaksimasuk)
            ];
        }
        // dd($data);
        return view('dashboard.dashboard',compact('masterjenis','mastergolongan','masterbarang','datatrkeluar','datatrmasuk'));
    }
}