<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\MasterBarang;
use App\Models\mastergolongan;
use App\Models\masterjenis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterbarang=DB::select("SELECT master.*,golongan.kdgol as kgol,namagol,jenis.kdjenis as kjenis,namajenis from master
                            left join golongan on golongan.id=master.kdgol
                            left join jenis on jenis.id=master.kdjenis order by master.id desc");
        // dd($masterbarang);
        return view('masterbarang.list-masterbarang',compact('masterbarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $golongan=mastergolongan::get();
        $jenis=masterjenis::get();

        return view('masterbarang.add-masterbarang',compact('golongan','jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'ukuran'=>$request->ukuran,
            'sat1'=>$request->sat1,
            'max1'=>$request->max1,
            'sat2'=>$request->sat2,
            'max2'=>$request->max2,
            'sat3'=>$request->sat3,
            'kdgol'=>$request->kdgol,
            'kdjenis'=>$request->kdjenis,
            'expdate'=>$request->expdate,
            'tgl_dibuat'=>date('Y-m-d H:i:s'),
        ];
        // dd($data);
        try{
            MasterBarang::insert($data);
            return redirect("/masterbarang")->with('success','Data berhasil ditambahkan!');
        }catch(Exception $e){
            // dd($e);
            return redirect("/masterbarang")->with('failed','Data gagal ditambahkan!');
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
        $golongan=mastergolongan::get();
        $jenis=masterjenis::get();
        $barang=MasterBarang::where("id",$id)->get();
        // dd($barang);
        return view('masterbarang.edit-masterbarang',compact('golongan','jenis','barang'));
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
         $data=[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'ukuran'=>$request->ukuran,
            'sat1'=>$request->sat1,
            'max1'=>$request->max1,
            'sat2'=>$request->sat2,
            'max2'=>$request->max2,
            'sat3'=>$request->sat3,
            'kdgol'=>$request->kdgol,
            'kdjenis'=>$request->kdjenis,
            'expdate'=>$request->expdate,
        ];
        // dd($data);
        try{
            MasterBarang::where('id',$id)->update($data);
            return redirect("/masterbarang")->with('success','Data berhasil diedit!');
        }catch(Exception $e){
            dd($e);
            return redirect("/masterbarang")->with('failed','Data gagal diedit!');
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
        try{
            MasterBarang::where('id',$id)->delete();
            return redirect("/masterbarang")->with('success','Data berhasil dihapus!');
        }catch(Exception $e){
            return redirect("/masterbarang")->with('failed','Data gagal dihapus!');
        }
    }
}