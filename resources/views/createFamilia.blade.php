@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Criar Familia</h1>
@stop
@section('content')

    <div class="card">
        <img class="card-img-top img-responsive w-25 m-auto" src="https://image.freepik.com/vetores-gratis/ilustracao-em-vetor-familia-feliz-isolada_97632-337.jpg" alt="">
            <hr />
        <div class="card-body">
            <form method="POST" action="{{URL('/familia/store')}}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="num">Numero FAM: </label>
                            <input type="number"
                            class="form-control"  name="num" min="1" id="num" aria-describedby="num" placeholder="Digite o Numero">
                            <small id="num" class="form-text text-muted">Numero da familia</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="text"
                            class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Digite o Nome">
                            <small id="nome" class="form-text text-muted">Nome do Responsavel</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tel">Telefone: </label>
                            <input type="tel"
                            class="form-control" name="tel" id="tel" aria-describedby="tel" placeholder="Digite o Telefone">
                            <small id="tel" class="form-text text-muted">Telefone Responsavel</small>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ubs">Numero UBS: </label>
                            <input type="number"
                            class="form-control"  name="ubs" min="1" id="ubs" aria-describedby="ubs" placeholder="Digite o Numero">
                            <small id="ubs" class="form-text text-muted">Numero da UBS</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="endereco">Endereço: </label>
                            <input type="text"
                            class="form-control" name="endereco" id="endereco" aria-describedby="endereco" placeholder="Digite o Endereço">
                            <small id="endereco" class="form-text text-muted">Endereço do Responsavel</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="qtd">QTD de Membros: </label>
                            <input type="number"
                            class="form-control"  name="qtd" min="1" id="qtd" aria-describedby="qtd" placeholder="Digite a Quantidade">
                            <small id="qtd" class="form-text text-muted">Numero de Membros na Familia</small>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <input name="" id="" class="btn btn-primary" type="submit" value="Cadastrar">
                    </div>
                </div>
            </form>
        </div>

    </div>

@stop
