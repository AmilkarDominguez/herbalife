@extends('layouts.webapp')
@section('title')
INFORMACIÓN
@endsection
@section('content')



<div class="row">
    <div align='center' class="col s12">
        <h5 class="red-text text-darken-4">Acerca de nosotros</h5>
    </div>
    <div id="informacion" class="col s12">
            
    </div>
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
    Institucional();
});
function Institucional() {
    $.ajax({
        url: "/api/list_institutional",
        method: 'get',
        success: function (result) {
            var code = '';
            $.each(result, function (key, value) {

            code += '<div class="card">';
            code += '<div class="card-content">';
            code += '<p class="flow-text red-text text-darken-4">MISIÓN</p>';
            code += '<p>'+value.mision+'</p>';
            code += '<p class="flow-text red-text text-darken-4">VISIÓN</p>';
            code += '<p>'+value.vision+'</p>';
            code += '<br>';
            code += '<p><b><i class="icon-map-signs"></i>Dirección: </b>'+value.direccion+'</p>';
            code += '<p><b><i class="icon-phone"></i>Teléfono: </b>'+value.telefono+'</p>';
            code += '<p><b><i class="icon-mail"></i>Correo: </b>'+value.email+'</p>';
            code += '</div>';
            code += '<div class="card-action">';
            code += '<a href="googlechrome://'+value.web+'" target="_blank"  class="flow-text red-text text-darken-4">ver más.</a>';
            code += '</div>';
            code += '</div>';


            });

            $("#informacion").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
</script>
@endsection

<!--<p><a href='twitter://user?screen_name=gajotres', target='_system'>Twitter</a></p>-->