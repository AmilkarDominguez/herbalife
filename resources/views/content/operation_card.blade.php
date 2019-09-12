@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="card-title text-primary">Targeta de Operaciones</h2>
                    </div>
                    
                    <div class="col-sm-6 d-flex justify-content-end">
                        <button class="btn btn-outline-success" id="btn-agregar">
                            <i class="icon-plus"></i>&nbsp;Agregar
                        </button>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-12" id="msg-global">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped ">
                        <thead>
                            <tr>
                                <td>Registrado por</td>
                                <td>Nit</td>
                                <td>Empresa</td>
                                <td>Descripcion</td>
                                <td>Fecha Registro</td>
                                <td>Fecha Vigencia</td>
                                <td>Responsable</td>
                                <td>Telefono</td>
                                <td>Email</td>
                                <td>Estado</td>
                                <td>Editar</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals-->
<!-- Modal Datos -->

<div class="modal fade bd-example-modal-lg" id="modal_datos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-data" id="form-data" novalidate>
                <div class="modal-body">
                        <div class="modal-body">
                            <div class="md-form mb-3">
                                <label><b>Nit:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" rows="4" id="nit" name="nit" placeholder="Nit" 
                                required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Empresa:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" rows="4" id="empresa" name="empresa" placeholder="Empresa" 
                                required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Descripción:</b></label>
                                <textarea type="text" class="form-control" onkeyup="Mayus(this);" id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label for="expiration-date">Fecha de Registro:</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" id="fecha_registro" name="fecha_registro" class="form-control datetimepicker-input" data-target="#datetimepicker1" required/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="md-form mb-3">
                                <label for="entry-date">Fecha de Vigencia:</label>
                                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                    <input type="text" id="fecha_vigencia" name="fecha_vigencia" class="form-control datetimepicker-input" data-target="#datetimepicker2" required/>
                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="md-form mb-3">
                                <label><b>Reponsable:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" rows="4" id="responsable" name="responsable" placeholder="Responsable" 
                                required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Telefono:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" rows="4" id="telefono" name="telefono" placeholder="Telefono" 
                                required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Email:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" rows="4" id="email" name="email" placeholder="Email" 
                                required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>                                                                              
                            <div class="md-form mb-3">
                                    <label for="estado"><b>Estado:</b></label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_activo" name="estado" class="custom-control-input bg-danger"
                                        value="ACTIVO" checked>
                                    <label class="custom-control-label" for="estado_activo">Activo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_inactivo" name="estado" class="custom-control-input"
                                        value="INACTIVO">
                                    <label class="custom-control-label" for="estado_inactivo">Inactivo</label>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                    <button class="btn btn-success" type="submit">Aceptar<i class="icon-ok"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade bd-example-modal-lg" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h2>¿Está seguro que desea eliminar el registro?</h2>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                <button class="btn btn-success" id="btn_delete">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var user_id={{ Auth::user()->id }};
</script>
<script src="{{ URL::asset('js/scripts/operation_card.js') }}"></script>
@endsection