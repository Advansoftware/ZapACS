@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Contatos</h1>
@stop

@section('content')

<div class="card card-solid">
    <div class="card-body pb-0">
        <div class="row justify-content-end">
            <div class="col-md-1 mx-5">
            <button id="sync" class="btn btn-app bg-info">
                <span class="badge bg-danger">{{count($contatos)}}</span>
                <i class="fas fa-sync-alt"></i>Sincronizar
            </button>
            </div>
        </div>
        <hr>
      <div class="row d-flex align-items-stretch">
@foreach($contatos as $contato)

<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
    <div class="card bg-light">
        <div id="id{{$contato['tel']}}" class="ribbon-wrapper remover">
            <div id="colorid{{$contato['tel']}}" class="ribbon"><span id="{{$contato['tel']}}" class="texto"></span></div>
        </div>
        @php
            $bairro=$contato->find($contato->id)->relBairro;
        @endphp
      <div class="card-header text-muted border-bottom-0">
        {{$bairro->nome}}
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b>{{$contato['nome']}}</b></h2>
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Endereço: {{$contato['endereco']}} </li>
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefone #: <div id="numero">+<a alt="Ligar" title="Ligar" href="tel:+{{$contato['tel']}}">{{$contato['tel']}}</a></div></li>
            </ul>
          </div>
          <div class="col-5 text-center">
            <img id='avatar' src="{{$contato['avatar']}}" alt="user-avatar" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <a href="#" class="btn btn-sm bg-teal">
            <i class="fas fa-comments"></i>
          </a>
          <a href="{{url("contatos/$contato->id")}}" class="btn btn-sm btn-primary">
            <i class="fas fa-user"></i> Ver Perfil
          </a>
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">

        <ul class="pagination justify-content-center m-0">
            {{$contatos->links()}}
        </ul>

      </nav>
    </div>
    </div>
    <!-- /.card-footer -->

@stop

@section('js')
<script>

    function notify(){

        $.getJSON("{{url("contatos/notify")}}", function(data) {
            $.each(data, function (key, item) {
                $("#"+item.user).text(item.qtd);
                if((item.notify=="0")){
                    $("#id"+item.user).fadeOut();
                }
                else{
                    $("#id"+item.user).fadeIn();
                    $("#colorid"+item.user).addClass('bg-danger');
                }
            });
        });
    }

$(document).ready(function() {
    notify();
window.setInterval(function() {
    if (status == 0 || status == 1) {
        notify();
    }
}, 5000);
});
$("#sync").click(function(){
    Swal.fire({
    icon: 'info',
  title: 'Sincronizando',
  text: 'Aguarde...',
  showConfirmButton: false,
  timerProgressBar: true,
    didOpen: () => {
    Swal.showLoading()
  }
});
    var settings = {
    "url": "{{url("sincronizar")}}",
    "method": "GET",
    "timeout": 0,
  };
  $.ajax(settings).done(function (response) {

      console.log();
      Swal.fire({title: 'Sincronização Concluida',
      'html': "Foram Adicionados <b>"+response+'</b> Novos Contatos',
      showConfirmButton: true,
      icon: 'success',
      willClose:true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.reload();
        }
        })
    });
});


</script>
@stop
