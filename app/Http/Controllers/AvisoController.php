<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvisoController extends Controller
{
    public function index(){
        return view('aviso');
    }
}
