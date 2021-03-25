@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('content')
<table>
    <tr><th>Nome</th></tr>
@foreach($paciente as $pacientes)
    <tr><td>{{$pacientes->nome}}</td></tr>
@endforeach
</table>

@stop
