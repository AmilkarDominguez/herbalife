@extends('layouts.webapp')
@section('title')
Productos
@endsection
@section('content')

<div class="row">
    <div align='center' class="col s12">
        <h5 class="green-text text-darken-4">Nuestros productos</h5>
    </div>
    <div class="col s12" id="Productos"></div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn green-darken-4" onclick="location.reload();">
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
    ListarProductos();
});
function ListarProductos() {
    $.ajax({
        url: "/api/list_productos",
        method: 'get',
        success: function (result) {
            var code = '';
            $.each(result, function (key, value) {
                code += '<div class="card">';
                code += '<div class="card-image">';
                code += '<img src="'+value.foto+'">';
                code += '</div>';
                code += '<div class="card-content">';
                code += '<p class="flow-text green-text text-darken-4">'+value.nombre+'</p>';
                code += '<p>'+value.type.nombre+'</p>';
                code += '<p><b>Presentación: </b>'+value.presentacion+'</p>';
                code += '<p><b>Precio: </b>'+value.precio+'</p>';            
                code += '</div>';
                code += '<div class="card-action">';
                //code += '<a href="googlechrome://'+value.web+'" target="_blank"  class="flow-text green-text text-darken-4">ver más.</a>';
                code += '</div>';
                code += '</div>';
            });

            $("#Productos").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
</script>
@endsection

<!--<p><a href='twitter://user?screen_name=gajotres', target='_system'>Twitter</a></p>-->