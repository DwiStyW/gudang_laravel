<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Riwayattrack;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayatmasuk=DB::select('SELECT riwayattrack.*,nama,max1,max2,sat1,sat2,sat3 from riwayattrack left join master on riwayattrack.kode=master.kode where keluar=0 order by id DESC');
        // $riwayatmasuk=DB::table('riwayattrack')
        // ->leftJoin('master','master.kode','=','riwayattrack.kode')
        // ->where('keluar',0)
        // ->orderBy('riwayattrack.id','DESC')
        // ->select('riwayattrack.*','nama','max1','max2','sat1','sat2','sat3')
        // ->paginate(10);
        // dd($riwayatmasuk);
        return view('barangmasuk.list-barangmasuk',compact('riwayatmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang=MasterBarang::get();
        return view('barangmasuk.add-barangmasuk',compact('barang'));
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
        $nopallet='nopallet'.$index;
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
                'nopallet'=>$request->$nopallet,
                'masuk'=>$jumlah,
                'keluar'=>0,
                'cat'=>$request->$catatan,
                'statpallet'=>'NONE',
                'ket'=>'input',
                'saldo'=>'0',
                'tanggal'=>$request->tgl,
            ];
        }
        // dd($data);
        try{
            Riwayattrack::insert($data);
            return redirect("/barang-masuk")->with('success','Data berhasil ditambahkan!');
        }catch(Exception $e){
            dd($e);
            return redirect("/barang-masuk")->with('failed','Data gagal ditambahkan!');
        }
        // dd($data);
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
        $riwayatmasuk=Riwayattrack::leftjoin('master','master.kode','=','riwayattrack.kode')
        ->where('riwayattrack.id',$id)
        ->select('riwayattrack.*','max1','max2','sat1','sat2','sat3')
        ->get();
        $barang=MasterBarang::get();
        // dd($riwayatmasuk);
        return view('barangmasuk.edit-barangmasuk',compact('riwayatmasuk','barang'));
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
                'nopallet'=>$request->nopallet,
                'masuk'=>$jumlah,
                'keluar'=>'0',
                'cat'=>$request->catatan,
                'statpallet'=>'NONE',
                'ket'=>'input',
                'saldo'=>'0',
                'tanggal'=>$request->tgl,
                // 'updated_at'=>date('')
            ];
        // dd($id);
        try{
            Riwayattrack::where('id',$id)->update($data);
            return redirect("/barang-masuk")->with('success','Data berhasil diedit!');
        }catch(Exception $e){
            dd($e);
            return redirect("/barang-masuk")->with('failed','Data gagal diedit!');
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
    }
}