<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\mastergolongan;
use App\Models\masterjenis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $masterjenis=masterjenis::get();
        $mastergolongan=mastergolongan::get();
        $masterbarang=MasterBarang::get();
        return view('dashboard.dashboard',compact('masterjenis','mastergolongan','masterbarang'));
    }
}