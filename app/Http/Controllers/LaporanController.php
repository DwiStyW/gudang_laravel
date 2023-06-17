<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Riwayattrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function riwayatkeluarmasuk(){
        $riwayat=Riwayattrack::get();
        $barang=MasterBarang::get();
        return view('laporan.riwayat-keluarmasuk',compact('riwayat','barang'));
    }
    public function caririwayatkeluarmasuk(request $request){
        $start=$request->start;
        $end=$request->end;
        $kode=$request->kode;
        // $saldoawal=[];
        $master=DB::select("SELECT * from master where kode='$kode'");
        $riwayat=DB::select("SELECT * from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");
        // dd($riwayat);
        $saldoin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
        $saldoout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
        foreach ($saldoin as $in) {
            $salin=$in->salin;
        }
        foreach ($saldoout as $out) {
            $salout=$out->salout;
        }
        foreach($riwayat as $r){
            $sals = $salin - $salout;
            $sat1  = floor($sals / ($r->max1 * $r->max2));
            $sisa   = $sals - ($sat1 * $r->max1 * $r->max2);
            $sat2  = floor($sisa / $r->max2);
            $sat3  = $sisa - $sat2 * $r->max2;
        }
        // dd($saldoawal);
        return view('laporan.tampil-riwayatkeluarmasuk',compact('riwayat','kode','start','end','master','sat1','sat2','sat3','sals'));
    }
     public function laporanpergolongan(){
        return view('laporan.laporan-pergolongan');
    }
     public function laporanall(){
        return view('laporan.laporan-all');
    }
     public function laporansaldoakhir(){
        return view('laporan.laporan-saldoakhir');
    }
}