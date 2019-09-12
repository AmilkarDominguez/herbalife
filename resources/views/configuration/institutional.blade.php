@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="card-title text-danger">Instituciones</h2>
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
                                <td>Misión</td>
                                <td>Visión</td>
                                <td>Dirección</td>
                                <td>Teléfono</td>
                                <td>Web</td>
                                <td>Correo Electrónico</td>
                                <td>Contácto</td>
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
                                <label><b>Misión:</b></label>
                                <textarea  type="text" class="form-control"  rows="4" id="mision" name="mision" placeholder="Misión" required></textarea>  
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                    <label><b>Visión:</b></label>
                                    <textarea  type="text" class="form-control"  rows="4" id="vision" name="vision" placeholder="Visión" required></textarea>  
                                    <div class="invalid-feedback">
                                        Dato necesario.
                                    </div>
                                </div>
                            <div class="md-form mb-3">
                                <label><b>Dirección:</b></label>
                                <input type="text" class="form-control"  id="direccion" name="direccion" placeholder="Dirección"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Teléfono:</b></label>
                                <input type="text" class="form-control"  id="telefono" name="telefono" placeholder="Teléfono"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Web:</b></label>
                                <input type="text" class="form-control"  id="web" name="web" placeholder="Web"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Correo Electrónico:</b></label>
                                <input tyoe="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Contácto:</b></label>
                                <input type="text" class="form-control"  id="contacto" name="contacto" placeholder="Contácto"
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
<script src="{{ URL::asset('js/scripts/institucional.js') }}"></script>
@endsection