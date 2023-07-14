<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Riwayat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $riwayatkeluar=DB::select('SELECT riwayat.*,nama,max1,max2,sat1,sat2,sat3 from riwayat join master on riwayat.kode=master.kode where masuk=0 order by riwayat.id DESC');
        return view('barangkeluar.list-barangkeluar',compact('riwayatkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang=MasterBarang::get();
        return view('barangkeluar.add-barangkeluar',compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $length=$request->indexloop;
        for($i=0;$i<$length;$i++){
        $index=$i+1;
        $kode='kode'.$index;
        $nobatch='nobatch'.$index;
        $sat1='sat1kode'.$index;
        $sat2='sat2kode'.$index;
        $sat3='sat3kode'.$index;
        $catatan='catatan'.$index;

        $Dkode=$request->$kode;
        $Dsat1=$request->$sat1;
        $Dsat2=$request->$sat2;
        $Dsat3=$request->$sat3;
        $master=DB::select("SELECT * from master where kode='$Dkode'");
        foreach($master as $m){
            $max1=$m->max1;
            $max2=$m->max2;
        }
        $sats1 = $Dsat1 * $max1 * $max2;
        $sats2 = $Dsat2 * $max2;
        $jumlah = $sats1 + $sats2 + $Dsat3;
            $data[]=[
                'tglform'=>$request->tanggal,
                'noform'=>$request->noform,
                'kode'=>$request->$kode,
                'nobatch'=>$request->$nobatch,
                'masuk'=>0,
                'keluar'=>$jumlah,
                'cat'=>$request->$catatan,
                'ket'=>'input',
                'saldo'=>'0',
                'tanggal'=>$request->tgl,
            ];
        }
        // dd($data);
         try{
            Riwayat::insert($data);
            return redirect("/barang-keluar")->with('success','Data berhasil ditambahkan!');
        }catch(Exception $e){
            dd($e);
            return redirect("/barang-keluar")->with('failed','Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $riwayatkeluar=Riwayat::join('master','master.kode','=','riwayat.kode')
        ->where('riwayat.id',$id)
        ->select('riwayat.*','max1','max2','sat1','sat2','sat3')
        ->get();
        $barang=MasterBarang::get();
        // dd($riwayatmasuk);
        return view('barangkeluar.edit-barangkeluar',compact('riwayatkeluar','barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Dkode=$request->kode;
        $Dsat1=$request->sat1;
        $Dsat2=$request->sat2;
        $Dsat3=$request->sat3;
        $master=DB::select("SELECT * from master where kode='$Dkode'");
        foreach($master as $m){
            $max1=$m->max1;
            $max2=$m->max2;
        }
        $sats1 = $Dsat1 * $max1 * $max2;
        $sats2 = $Dsat2 * $max2;
        $jumlah = $sats1 + $sats2 + $Dsat3;
        $data=[
                'tglform'=>$request->tanggal,
                'noform'=>$request->noform,
                'kode'=>$request->kode,
                'nobatch'=>$request->nobatch,
                'masuk'=>0,
                'keluar'=>$jumlah,
                'cat'=>$request->catatan,
                'ket'=>'input',
                'saldo'=>'0',
                'tanggal'=>$request->tgl,
                // 'updated_at'=>date('')
            ];
        // dd($id);
        try{
            Riwayat::where('id',$id)->update($data);
            return redirect("/barang-keluar")->with('success','Data berhasil diedit!');
        }catch(Exception $e){
            dd($e);
            return redirect("/barang-keluar")->with('failed','Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            Riwayat::where('id',$id)->delete();
            return redirect("/barang-keluar")->with('success','Data berhasil dihapus!');
        }catch(Exception $e){
            return redirect("/barang-keluar")->with('failed','Data gagal dihapus!');
        }
    }
}