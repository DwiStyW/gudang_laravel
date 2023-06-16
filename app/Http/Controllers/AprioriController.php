<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AprioriController extends Controller
{
    //
    public function index(){
        $gdform=[];
        $dataform=DB::select('SELECT noform,count(*) From riwayat where noform!="saldo_awal" and keluar!=0 group by noform');
        foreach($dataform as $t){
            $noform=$t->noform;
            $tr=DB::select("SELECT noform,kode from riwayat where noform='$noform' group by noform,kode");
            $gdform[]=$tr;
        }
        $master=DB::select('SELECT * from master');
        // dd($testing);
        // echo json_encode($tr);
        $transaksi=DB::select('SELECT noform,kode,count(*) From riwayat where noform!="saldo_awal" and keluar!=0 group by noform,kode');
        //  dd($test2);
        return view('apriori.apriori',compact('gdform','master','transaksi','dataform'));
    }
}