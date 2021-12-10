@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="card-title text-primary">Clientes</h2>
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
                                <td>Foto</td>
                                <td>Nombre completo</td>
                                <td>Código</td>                                
                                <td>Dirección</td>
                                <td>Correo</td>
                                <td>Estatura</td>
                                <td>Peso</td>
                                <td>Fecha Nacimiento</td>
                                <td>Género</td>
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
                                <label><b>Foto:</b></label>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="" id="image" alt="logo" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input" id="foto" name="foto" lang="es" accept=".png, .jpg, .gif">
                                            <label id="label_image" name="label_image" class="custom-file-label rounded">Elegir archivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Nombre completo:</b></label>
                                <input pattern="[a-zA-Z\s]*"  type="text" class="form-control"  rows="4" id="name" name="name" placeholder="Nombre completo" required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Contraseña:</b></label>
                                <input  type="password" class="form-control"  rows="4" id="password" name="password" placeholder="Contraseña" required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Correo:</b></label>
                                <input  type="email" class="form-control"  rows="4" id="email" name="email" placeholder="Correo" required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Dirección:</b></label>
                                <input  type="text" class="form-control"  rows="4" id="direccion" name="direccion" placeholder="Dirección" required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Estatura (cm):</b></label>
                                <input  type="number" class="form-control"  min="1" max="250" rows="4" id="estatura" name="estatura" placeholder="Estatura" required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Peso (Kl):</b></label>
                                <input  type="number" class="form-control"   min="1" max="200" rows="4" id="peso" name="peso" placeholder="Peso" required> 
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label for="expiration-date">Fecha de Nacimiento:</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control datetimepicker-input" data-target="#datetimepicker1" required/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="icon-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Género:</b></label>
                                <select class="form-control" name="sexo" id="sexo" required>
                                    <option selected="MUJER">MUJER</option>
                                    <option value="HOMBRE">HOMBRE</option>
                                </select>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>                                                                              
                            <div class="md-form mb-3">
                                    <label for="state"><b>Estado:</b></label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_activo" name="state" class="custom-control-input bg-danger"
                                        value="ACTIVO" checked>
                                    <label class="custom-control-label" for="estado_activo">Activo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_inactivo" name="state" class="custom-control-input"
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
<script src="{{ URL::asset('js/scripts/cliente.js') }}"></script>
@endsection