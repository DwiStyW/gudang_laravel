<?php

namespace App\Http\Controllers;

use App\Models\mastergolongan;
use Illuminate\Http\Request;
use Exception;

class MasterGolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mastergolongan=mastergolongan::orderby('id','DESC')->get();
        return view('mastergolongan.list-mastergolongan',compact('mastergolongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mastergolongan.add-mastergolongan');
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
            'kdgol'=>$request->kdgol,
            'namagol'=>$request->namagol,
        ];
        // dd($data);
        try{
            mastergolongan::insert($data);
            return redirect("master-golongan")->with('success','Data berhasil ditambahkan!');
        }catch(Exception $e){
            return redirect("master-golongan")->with('failed','Data gagal ditambahkan!');
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
        $find=mastergolongan::where('id',$id)->get();
        return view('mastergolongan.show-mastergolongan',compact('find'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $golongan=mastergolongan::where('id',$id)->get();
        // dd($find);
        return view('mastergolongan.edit-mastergolongan',compact('golongan','id'));
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
            'kdgol'=>$request->kdgol,
            'namagol'=>$request->namagol,
        ];
        // dd($data);
        try{
            mastergolongan::where('id',$id)->update($data);
            return redirect("master-golongan")->with('success','Data berhasil diedit!');
        }catch(Exception $e){
            return redirect("master-golongan")->with('failed','Data gagal diedit!');
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
            mastergolongan::where('id',$id)->delete();
            return redirect("master-golongan")->with('success','Data berhasil dihapus!');
        }catch(Exception $e){
            return redirect("master-golongan")->with('failed','Data gagal dihapus!');
        }
    }
}
