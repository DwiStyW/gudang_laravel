<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AprioriController extends Controller
{
    //
    public function index(){
        $gdform=[];//array untuk menampung data kode berdasarkan noform
        //$dataform untuk data noform dan jumlah kode pernoform
        $dataform=DB::select('SELECT noform,count(*) From riwayat where noform!="saldo_awal" and keluar!=0 group by noform');
        foreach($dataform as $t){
            $noform=$t->noform;
            $tr=DB::select("SELECT noform,kode from riwayat where noform='$noform' group by noform,kode");
            $gdform[]=$tr;
        }
        $master=DB::select('SELECT * from master'); //untuk data master
        //$transaksi untuk data transaksi noform dan kode
        $transaksi=DB::select('SELECT noform,kode,count(*) From riwayat where noform!="saldo_awal" and keluar!=0 group by noform,kode');
        return view('apriori.apriori',compact('gdform','master','transaksi','dataform'));
    }
}