<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ConfigsController extends Controller
{
    public function whatsuser(){

        session(['bruno' => 'gay']);
        dd(session('bruno'));
        return view("composers.whatsconfigcomposer");
    }
    public function whatsapi(){
        $apiConfig =$this->objConfigWhats->all();
        return view("");
    }
}
