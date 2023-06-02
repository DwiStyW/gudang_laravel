<?php

namespace App\Http\Controllers;

use App\Models\masterjenis;
use Exception;
use Illuminate\Http\Request;

class MasterJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterjenis=masterjenis::orderby('id','DESC')->get();
        return view('masterjenis.list-masterjenis',compact('masterjenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterjenis.add-masterjenis');
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
            'kdjenis'=>$request->kdjenis,
            'namajenis'=>$request->namajenis,
        ];
        // dd($data);
        try{
            masterjenis::insert($data);
            return redirect("/master-jenis")->with('success','Data berhasil ditambahkan!');
        }catch(Exception $e){
            return redirect("/master-jenis")->with('failed','Data gagal ditambahkan!');
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
        $find=masterjenis::where('id',$id)->get();
        return view('masterjenis.show-masterjenis',compact('find'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis=masterjenis::where('id',$id)->get();
        // dd($find);
        return view('masterjenis.edit-masterjenis',compact('jenis','id'));
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
            'kdjenis'=>$request->kdjenis,
            'namajenis'=>$request->namajenis,
        ];
        // dd($data);
        try{
            masterjenis::where('id',$id)->update($data);
            return redirect("master-jenis")->with('success','Data berhasil ditambahkan!');
        }catch(Exception $e){
            return redirect("master-jenis")->with('failed','Data gagal ditambahkan!');
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
            masterjenis::where('id',$id)->delete();
            return redirect("master-jenis")->with('success','Data berhasil dihapus!');
        }catch(Exception $e){
            return redirect("master-jenis")->with('failed','Data gagal dihapus!');
        }
    }
}