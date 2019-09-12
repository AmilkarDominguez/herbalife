@extends('layouts.webapp')
@section('title')
SERVICIOS
@endsection
@section('content')

<div class="row">
    <div align='center' class="col s12">
        <h5 class="red-text text-darken-4">Nuestros servicios</h5>
    </div>
    <div class="col s12" id="servicios"></div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn red-darken-4" onclick="location.reload();">
        <i class="icon-ccw"></i>
    </a>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListarServicios();
});
function ListarServicios() {
    $.ajax({
        url: "/api/list_servicios",
        method: 'get',
        success: function (result) {
            var code = '';
            $.each(result, function (key, value) {
                code += '<div class="card">';
                code += '<div class="card-image">';
                code += '<img src="'+value.logo+'">';
                code += '</div>';
                code += '<div class="card-content">';
                code += '<p class="flow-text red-text text-darken-4">'+value.servicio+'</p>';
                code += '<p>'+value.razon_social+'</p>';
                code += '<p><b>Dirección: </b>'+value.direccion+'</p>';
                code += '<p><b>Teléfono: </b>'+value.telefono+'</p>';            
                code += '<p><b>Email: </b>'+value.email+'</p>';
                code += '</div>';
                code += '<div class="card-action">';
                code += '<a href="googlechrome://'+value.web+'" target="_blank"  class="flow-text red-text text-darken-4">ver más.</a>';
                code += '</div>';
                code += '</div>';
            });

            $("#servicios").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
</script>
@endsection

<!--<p><a href='twitter://user?screen_name=gajotres', target='_system'>Twitter</a></p>-->