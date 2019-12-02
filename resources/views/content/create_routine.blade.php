@extends('layouts.app')
@section('content')

<div class="row" style="padding-bottom: 10px;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-success"><b>Crear Plan</b></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-success">Productos disponibles</h2>
                <div class="table-responsive">
                    <table id="tableProducts" class="table">
                        <thead>
                            <tr>
                                <td>Foto</td>
                                <td>Nombre</td>
                                <td>Presentación</td>
                                <!-- <td>Precio</td> -->
                                <td>Agregar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-success shadow">
            <div class="card-body">
                <h3 class="card-title text-success"><i class="icon-list-alt"></i><b>Detalle del plan</b></h3>

                <input type="text" id="nombre_plan" class="form-control border-success" value="Nombre sin especificar" />

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table-basket" class="table">
                                <thead>
                                    <tr>
                                        <td>Producto</td>
                                        <!-- <td>Precio</td> -->
                                        <td>Dosis</td>
                                        <td>Quitar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <a id="btn_save_sale" class="btn btn-success text-white btn-lg btn-block" onclick="SaveRoutine();">
                            <h2>
                                <i class="icon-floppy"></i> Registrar Plan
                            </h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal_sale_susscess-->
<div class="modal fade bd-example-modal-lg" id="modal_sale_susscess" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Registro exitoso</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                ¡Plan registrado correctamente!
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="location.reload();">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var user_id = {{Auth::user()->id}};
</script>
<script src="{{ URL::asset('js/scripts/crear_rutina.js') }}"></script>
@endsection