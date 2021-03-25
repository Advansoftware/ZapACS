<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\ModelFamilia;
use App\Models\Models\ModelPaciente;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\ConfigsController;

class DashController extends Controller
{

    private $objFamilia;
    private $objPassiente;

    public function __construct()
    {
        $this->objFamilia = new ModelFamilia();
        $this->objPaciente = new ModelPaciente();
    }

    public function index()
    {

        //dd($profile);

        $familia=$this->objFamilia->count();
        $countha=$this->objPaciente->where('ha', 1)->count();
        $countdia=$this->objPaciente->where('dia', 1)->count();
        $countgestante=$this->objPaciente->where('gestante', 1)->count();
        $countTotal=$this->objPaciente->count();
        $countidade=$this->objPaciente->select('dn',DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dn))) AS idade'))->get()->where('idade','<', 1)->count();
        $usersessao = 'session'.auth()->user()->id;
        $api = auth()->user()->api_url;
        session(['user_sessao' => $usersessao, 'api' => $api]);
        $api_url = session('api');
        $session= session('user_sessao');

        return view('index', compact('familia','countha','countdia','countTotal', 'countgestante', 'countidade','session', 'api_url'));
    }
    public function foto($sessao, $numero){
        $dados=json_decode(file_get_contents("http://localhost:3334/img?sessionName=".$sessao."&number=".$numero), true);
        return $dados['result'];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
