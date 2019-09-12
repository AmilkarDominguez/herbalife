@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="card-title text-primary">Servicios</h2>
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
                                <td>Razon Social</td>                             
                                <td>Servicio</td>
                                <td>Imagen</td>
                                <td>Direccion</td>
                                <td>Telefono</td>
                                <td>Web</td>
                                <td>Email</td>
                                <td>Contacto</td>
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
                                <label><b>Razon Social:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" id="razon_social" name="razon_social" placeholder="Razon Social" required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Servicio:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" id="servicio" name="servicio" placeholder="Servicio" required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Direccion:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" id="direccion" name="direccion" placeholder="Direccion" required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Telefono:</b></label>
                                <input  type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Contacto:</b></label>
                                <input  type="text" class="form-control" onkeyup="Mayus(this);" id="contacto" name="contacto" placeholder="Contacto" required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Imagen:</b></label>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="" id="image" alt="logo" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input" id="logo" name="logo" lang="es" accept=".png, .jpg, .gif">
                                            <label id="label_image" name="label_image" class="custom-file-label rounded">Elegir archivo</label>
                                        </div>
                                    </div>
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
                                    <label><b>Email:</b></label>
                                    <input type="text" class="form-control"  id="email" name="email" placeholder="Email"
                                        required>
                                    <div class="invalid-feedback">
                                        Dato necesario.
                                    </div>
                                </div>
                            <div class="md-form mb-3" id="select_auspice"></div>                                                  
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
<script src="{{ URL::asset('js/scripts/servicio.js') }}"></script>
@endsection