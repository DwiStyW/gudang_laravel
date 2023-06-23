<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\mastergolongan;
use App\Models\Riwayattrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function riwayatkeluarmasuk(){
        $barang=MasterBarang::get();
        return view('laporan.riwayat-keluarmasuk',compact('barang'));
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
        $allin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");
        $allout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");

        foreach ($allin as $m) {
            $totalM = $m->salin;
        }
        foreach ($allout as $k) {
            $totalK = $k->salout;
        }
        // dd($saldoin);
        return view('laporan.tampil-riwayatkeluarmasuk',compact('riwayat','kode','start','end','master','sat1','sat2','sat3','sals','totalM','totalK'));
    }

    public function laporanpergolongan(){
        $golongan=mastergolongan::get();
        return view('laporan.laporan-pergolongan',compact('golongan'));
    }
    public function caripergol(request $request){
        $start=$request->start;
        $end=$request->end;
        $idgol=$request->kode;

        $golongan=DB::select("SELECT * from golongan where id='$idgol'");
        $masterkode=DB::select("SELECT * from master where kdgol='$idgol'");
        foreach($masterkode as $mk){
            $kode=$mk->kode;
            $saldoin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
            $saldoout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
            foreach ($saldoin as $in) {
                $salin=$in->salin;
            }
            foreach ($saldoout as $out) {
                $salout=$out->salout;
            }
            $saldo = $salin - $salout;
            //konvert 3 satuan
            $ts1  = floor($saldo / ($mk->max1 * $mk->max2));
            $its  = $saldo - ($ts1 * $mk->max1 * $mk->max2);
            $ts2  = floor($its / $mk->max2);
            $ts3  = $its - $ts2 * $mk->max2;

            $allin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");
            $allout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");

            foreach ($allin as $m) {
                $totalM = $m->salin;
            }
            $tas1  = floor($totalM / ($mk->max1 * $mk->max2));
            $itas  = $totalM - ($tas1 * $mk->max1 * $mk->max2);
            $tas2  = floor($itas / $mk->max2);
            $tas3  = $itas - $tas2 * $mk->max2;

            foreach ($allout as $k) {
                $totalK = $k->salout;
            }
            $sat1  = floor($totalK / ($mk->max1 * $mk->max2));
            $sis  = $totalK - ($sat1 * $mk->max1 * $mk->max2);
            $sat2  = floor($sis / $mk->max2);
            $sat3  = $sis - $sat2 * $mk->max2;

            $akhirr = $saldo + $totalM - $totalK;

            $st1  = floor($akhirr / ($mk->max1 * $mk->max2));
            $ss  = $akhirr - ($st1 * $mk->max1 * $mk->max2);
            $st2  = floor($ss / $mk->max2);
            $st3  = $ss - $st2 * $mk->max2;

            $data[]=[
                'kode'=>$kode,
                'nama'=>$mk->nama,
                'saldoawal1'=>$ts1,
                'saldoawal2'=>$ts2,
                'saldoawal3'=>$ts3,
                'salmasuk1'=>$tas1,
                'salmasuk2'=>$tas2,
                'salmasuk3'=>$tas3,
                'salkeluar1'=>$sat1,
                'salkeluar2'=>$sat2,
                'salkeluar3'=>$sat3,
                'saldoakhir1'=>$st1,
                'saldoakhir2'=>$st2,
                'saldoakhir3'=>$st3,
            ];

        }
        // dd($data);
        return view('laporan.tampil-laporan-pergolongan',compact('start','end','golongan','data'));
    }

    public function laporanall(){
        return view('laporan.laporan-all');
    }
    public function cariall(request $request){
        $start=$request->start;
        $end=$request->end;

        $masterkode=DB::select("SELECT * from master order by kode ASC");
        foreach($masterkode as $mk){
            $kode=$mk->kode;
            $saldoin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
            $saldoout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
            foreach ($saldoin as $in) {
                $salin=$in->salin;
            }
            foreach ($saldoout as $out) {
                $salout=$out->salout;
            }
            $saldo = $salin - $salout;
            //konvert 3 satuan
            $ts1  = floor($saldo / ($mk->max1 * $mk->max2));
            $its  = $saldo - ($ts1 * $mk->max1 * $mk->max2);
            $ts2  = floor($its / $mk->max2);
            $ts3  = $its - $ts2 * $mk->max2;

            $allin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");
            $allout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");

            foreach ($allin as $m) {
                $totalM = $m->salin;
            }
            $tas1  = floor($totalM / ($mk->max1 * $mk->max2));
            $itas  = $totalM - ($tas1 * $mk->max1 * $mk->max2);
            $tas2  = floor($itas / $mk->max2);
            $tas3  = $itas - $tas2 * $mk->max2;

            foreach ($allout as $k) {
                $totalK = $k->salout;
            }
            $sat1  = floor($totalK / ($mk->max1 * $mk->max2));
            $sis  = $totalK - ($sat1 * $mk->max1 * $mk->max2);
            $sat2  = floor($sis / $mk->max2);
            $sat3  = $sis - $sat2 * $mk->max2;

            $akhirr = $saldo + $totalM - $totalK;

            $st1  = floor($akhirr / ($mk->max1 * $mk->max2));
            $ss  = $akhirr - ($st1 * $mk->max1 * $mk->max2);
            $st2  = floor($ss / $mk->max2);
            $st3  = $ss - $st2 * $mk->max2;

            $datasaldoawal[]=[
                'urai'=>'Slado Awal',
                'saldoawal1'=>$ts1,
                'saldoawal2'=>$ts2,
                'saldoawal3'=>$ts3,
            ];
            $datamasuk[]=[
                'urai'=>'Masuk',
                'salmasuk1'=>$tas1,
                'salmasuk2'=>$tas2,
                'salmasuk3'=>$tas3,
            ];
            $datakeluar[]=[
                'urai'=>'Keluar',
                'salkeluar1'=>$sat1,
                'salkeluar2'=>$sat2,
                'salkeluar3'=>$sat3,
            ];
            $datasaldoakhir[]=[
                'urai'=>'Saldo Akhir',
                'saldoakhir1'=>$st1,
                'saldoakhir2'=>$st2,
                'saldoakhir3'=>$st3,
            ];
            $data[]=[
                'kode'=>$kode,
                'nama'=>$mk->nama,
                'saldoawal'=>$datasaldoawal,
                'masuk'=>$datamasuk,
                'keluar'=>$datakeluar,
                'saldoakhir'=>$datasaldoakhir,
            ];
        }
        dd($data);
    }

    public function laporansaldoakhir(){
        return view('laporan.laporan-saldoakhir');
    }
    public function carisaldoakhir(request $request){
        $start=$request->start;
        $end=$request->end;

        $masterkode=DB::select("SELECT * from master order by kdgol ASC, nama ASC");
        foreach($masterkode as $mk){
            $kode=$mk->kode;
            $saldoin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
            $saldoout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '0001-01-01' and '$start'");
            foreach ($saldoin as $in) {
                $salin=$in->salin;
            }
            foreach ($saldoout as $out) {
                $salout=$out->salout;
            }
            $allin=DB::select("SELECT sum(masuk) as salin from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");
            $allout=DB::select("SELECT sum(keluar) as salout from riwayat join master on riwayat.kode=master.kode where riwayat.kode='$kode' and tglform between '$start' and '$end'");

            foreach ($allin as $m) {
                $totalM = $m->salin;
            }
            foreach ($allout as $k) {
                $totalK = $k->salout;
            }
            $saldo = $salin - $salout;
            $akhirr = $saldo + $totalM - $totalK;

            $st1  = floor($akhirr / ($mk->max1 * $mk->max2));
            $ss  = $akhirr - ($st1 * $mk->max1 * $mk->max2);
            $st2  = floor($ss / $mk->max2);
            $st3  = $ss - $st2 * $mk->max2;

            $data[]=[
                'kode'=>$kode,
                'nama'=>$mk->nama,
                'saldoakhir1'=>$st1,
                'saldoakhir2'=>$st2,
                'saldoakhir3'=>$st3,
            ];
        }
        return view('laporan.tampil-laporan-saldoakhir',compact('start','end','data'));
    }
}