<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\ModelFamilia;
use App\Exports\FamiliaExport;
use Maatwebsite\Excel\Facades\Excel;

class FamiliaControler extends Controller
{
    private $objFamilia;

    public function __construct()
    {
        $this->objFamilia = new ModelFamilia();
    }

    public function index()
    {
       $familia=$this->objFamilia->all();
       return view("familia", compact('familia'));
    }

    public function excel()
    {
        return Excel::download(new FamiliaExport, 'familias.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createFamilia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->objFamilia->create([
            'numero'=>$request->num,
            'responsavel'=>$request->nome,
            'ubs'=>$request->ubs,
            'local'=>$request->endereco,
            'qtd_membros'=>$request->qtd,
            'telefone'=>$request->tel
        ]);
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
