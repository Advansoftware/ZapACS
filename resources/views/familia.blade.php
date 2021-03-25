@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Familias</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table text-center display w-100"  id="tabela_familia">
            <thead>
                <tr>
                    <th>FAM</th>
                    <th>RESPONSAVEL</th>
                    <th>TEL</th>
                    <th>QTD MEMBROS</th>
                </tr>
            </thead>
            @foreach($familia as $familias)
            <tbody>
                <tr>
                    <td>{{$familias->numero}}</td>
                    <td class="text-left">{{$familias->responsavel}}</td>
                    <td class="tel">{{$familias->telefone}}</td>
                    <td>{{$familias->qtd_membros}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    $(document).ready(function() {
        $('#tabela_familia').DataTable(
            {"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
        }
    });
    $('.tel').mask('(00)9.0000-0000');
    } );
</script>
@stop
