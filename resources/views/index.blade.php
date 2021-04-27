@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_top_nav_right')
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
    </li>
@endsection
@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="info-box bg-gradient-primary">
            <span class="info-box-icon"><i class="fas fa-house-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">FAMILIAS</span>
              <span class="info-box-number">{{$familia}}</span>
            </div>
          </div>
    </div>
    <div class="col-md-3">
        <div class="info-box bg-gradient-warning text-dark">
            <span class="info-box-icon"><i class="fas fa-prescription-bottle"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">DIABETICOS</span>
              <span class="info-box-number">{{$countdia}}</span>
              <div class="progress">
                <div class="progress-bar" style="width:  @if($countha>0) {{(100 * $countdia)/$countTotal}}@endif%"></div>
              </div>
              <span class="progress-description">
                @if($countha>0){{(100 * $countdia)/$countTotal}}@endif%
              </span>
            </div>
          </div>
    </div>
    <div class="col-md-3">
        <div class="info-box bg-gradient-danger">
            <span class="info-box-icon"><i class="fas fa-thermometer-full"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">HIPERTENSOS</span>
              <span class="info-box-number">{{$countha}}</span>
              <div class="progress">
                <div class="progress-bar" style="width: @if($countha>0) {{(100 * $countha)/$countTotal}}@endif %"></div>
                @if($countha>0) {{(100 * $countha)/$countTotal}}@endif
              </div>
              <span class="progress-description">
                @if($countha>0) {{(100 * $countha)/$countTotal}}@endif%
              </span>
            </div>
          </div>
    </div>

    @include('templates.cardwhats')

</div>
<hr>
<div class="row ">
    <div class="col-md-4">
        @include('templates.celinfos')
    </div>
    <div class="col-md-3">
        @include('templates.cardinfos')
    </div>
    <div class="col-md-5">
        <canvas id="chart_pessoas"></canvas>
    </div>
</div>
<hr>


@stop

@section('js')
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="{{ asset('vendor/js.js') }}"></script>
<script>
var cont=0;
function carregando(status){
    const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
switch (status){
    case 1:
        Toast.fire({
        icon: 'info',
        title: 'Carregando Dispositivo'
        });
    break;
    case 2:
        Toast.fire({
        icon: 'success',
        title: 'Carga Completa'
        });
    break;
    case 3:
        Toast.fire({
        icon: 'error',
        title: 'Conecte o Carrregador'
        });
    break;
    case 4:
        Toast.fire({
        icon: 'warning',
        title: 'Carregador Desconectado'
        });
    break;
}
}

$(document).ready(function() {
getDevice("{{$session}}");
inicia("{{$api_url}}", "{{$session}}");
window.setInterval(function() {
    if (status == 0 || status == 1) {
        inicia("{{$api_url}}", "{{$session}}");
    }
}, 5000);
window.setInterval(function() {
            getDevice("{{$session}}");
            console.log("rodou");
            }, 10000);
});
var ctx = document.getElementById('chart_pessoas').getContext('2d');
var chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['PESSOAS COM DIA', 'PESSOAS COM HA'],
        datasets: [{
            label: 'My First dataset',
            data: [ {{$countdia}}, {{$countha}} ],
            backgroundColor:["rgb(255, 205, 86)","rgb(255, 99, 132)"]
        }],

    },
    options: {}
});

function getDevice(sessao){
var settings = {
"url": "{{$api_url}}/device?sessionName="+sessao,
"method": "GET",
"timeout": 0,
};
$.ajax(settings).done(function (response) {
    $.each(response, function (key, item) {
            var user = item.wid.user;
            var nome = item.pushname;
            var bateria= parseInt(item.battery);
            var marca = item.phone.device_manufacturer;
            var modelo = item.phone.device_model;
            var status_carregador = item.plugged;
            var plataforma = item.platform;
            var version_so = item.phone.os_version;

            profile_cel(sessao, user);

            $("#bateria").text(bateria+"%");
            $("#bateria_progress").css( "width", bateria+"%");
            $("#cel_marca").text(marca);
            $("#cel_model").text(modelo);
            $("#cel_so").text(plataforma+" "+version_so);
            $("#cel_profile").text(nome);


            if(bateria==100){
                carregando(2);
                if(status_carregador){
                    $("#bateria_progress").html("<i class='fas fa-battery-full'></i>");
                }
                else{
                    $("#bateria_progress").removeClass("bg-danger").addClass("bg-lime");
                    $("#bateria_progress").removeClass("bg-green").addClass("bg-lime");
                    $("#bateria_progress").removeClass("bg-warning").addClass("bg-lime");
                }
            }

            else if(bateria > 59 && bateria <= 99){
                $("#bateria_progress").removeClass("bg-warning").addClass("bg-green");
                if(status_carregador){
                    $("#bateria_progress").html("<i class='fas fa-battery-three-quarters'></i>");
                    $("#bateria_progress").removeClass("bg-danger").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-green").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-warning").addClass("bg-primary");
                }
            }
            else if(bateria > 39  && bateria < 60){
                $("#bateria_progress").removeClass("bg-warning").addClass("bg-green");
                if(status_carregador){
                    $("#bateria_progress").html("<i class='fas fa-battery-half'></i>");
                    $("#bateria_progress").removeClass("bg-danger").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-green").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-warning").addClass("bg-primary");
                }
            }
            else if(bateria < 40 && bateria > 20){
                $("#bateria_progress").removeClass("bg-danger").addClass("bg-warning");
                $("#bateria_progress").removeClass("bg-green").addClass("bg-warning");
                if(status_carregador){
                    $("#bateria_progress").html("<i class='fas fa-battery-quarter'></i>");
                    $("#bateria_progress").removeClass("bg-danger").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-green").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-warning").addClass("bg-primary");
                }
            }
           else {
            $("#bateria_progress").removeClass("bg-green").addClass("bg-danger");
                $("#bateria_progress").removeClass("bg-warning").addClass("bg-danger");
                if(status_carregador){
                    $("#bateria_progress").html("<i class='fas fa-battery-empty'></i>");
                    $("#bateria_progress").removeClass("bg-danger").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-green").addClass("bg-primary");
                    $("#bateria_progress").removeClass("bg-warning").addClass("bg-primary");
                }
            }


            if(status_carregador&&cont<1){
                carregando(1);
                $("#status_beteria_text").text("Carregando");
                $("#bateria_progress").html("<ion-icon name='battery-charging-outline' size='large'></ion-icon>");
                $("#bateria_progress").removeClass("bg-danger").addClass("bg-primary");
                $("#bateria_progress").removeClass("bg-green").addClass("bg-primary");
                $("#bateria_progress").removeClass("bg-warning").addClass("bg-primary");
                cont++;
            }
            else if(!status_carregador&&cont==0){
                $("#status_beteria_text").text("bateria");
                $("#bateria_progress").html("");
                if(bateria < 20){
                    carregando(3);
                }
            }
            else if(!status_carregador&&cont>0){
                carregando(4);
                $("#status_beteria_text").text("bateria");
                $("#bateria_progress").html("");
                cont=0;
            }
            else{

            }



    });
});
}
function profile_cel(sessoes, number) {
var settings = {
    "url": "{{$api_url}}/img?sessionName="+sessoes+"&number="+ number,
    "method": "GET",
    "timeout": 0,
  };
  $.ajax(settings).done(function (response) {
      $("#imagem_profile_cel").attr('src', response.result);
    });
}


</script>
@stop
