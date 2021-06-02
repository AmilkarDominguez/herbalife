@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="card-title text-success">Dietas</h2>
                        </div>

                        {{-- <div class="col-sm-6 d-flex justify-content-end">
                        <button class="btn btn-outline-success" id="btn-agregar">
                            <i class="icon-plus"></i>&nbsp;Agregar
                        </button>
                    </div> --}}
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-12" id="msg-global">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table text-center">
                            <tr class="bg-primary text-white">
                                <td colspan="3"><b>VARONES ♂</b></th>
                            </tr>
                            <tr class="text-primary">
                                <th>Peso kg.</th>
                                <th>Estatura cm.</th>
                                <th>Código</th>
                            </tr>
                            <tr>
                                <th>0 a 65</th>
                                <th>0 a 160</th>
                                <th>1v</th>
                            </tr>
                            <tr>
                                <th>0 a 65</th>
                                <th>161 a 170</th>
                                <th>2v</th>
                            </tr>
                            <tr>
                                <th>0 a 65</th>
                                <th>171 ó más</th>
                                <th>3v</th>
                            </tr>
                            <tr>
                                <th>66 a 75</th>
                                <th>0 a 160</th>
                                <th>2v</th>
                            </tr>
                            <tr>
                                <th>66 a 75</th>
                                <th>161 a 170</th>
                                <th>3v</th>
                            </tr>
                            <tr>
                                <th>66 a 75</th>
                                <th>171 ó más</th>
                                <th>4v</th>
                            </tr>
                            <tr>
                                <th>76 ó más</th>
                                <th>0 a 160</th>
                                <th>3v</th>
                            </tr>
                            <tr>
                                <th>76 ó más</th>
                                <th>161 a 170</th>
                                <th>4v</th>
                            </tr>
                            <tr>
                                <th>76 ó más</th>
                                <th>171 ó más</th>
                                <th>5v</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table text-center">
                            <tr class="text-white" style="background: rgb(235, 94, 216)">
                                <td colspan="3"><b>MUJERES ♀</b></th>
                            </tr>
                            <tr style="color: rgb(235, 94, 216)">
                                <th>Peso kg.</th>
                                <th>Estatura cm.</th>
                                <th>Código</th>
                            </tr>
                            <tr>
                                <th>0 a 50</th>
                                <th>0 a 160</th>
                                <th>1m</th>
                            </tr>
                            <tr>
                                <th>0 a 50</th>
                                <th>161 a 170</th>
                                <th>2m</th>
                            </tr>
                            <tr>
                                <th>0 a 50</th>
                                <th>171 ó más</th>
                                <th>3m</th>
                            </tr>
                            <tr>
                                <th>51 a 60</th>
                                <th>0 a 160</th>
                                <th>2m</th>
                            </tr>
                            <tr>
                                <th>51 a 60</th>
                                <th>161 a 170</th>
                                <th>3m</th>
                            </tr>
                            <tr>
                                <th>51 a 60</th>
                                <th>171 ó más</th>
                                <th>4m</th>
                            </tr>
                            <tr>
                                <th>61 ó más</th>
                                <th>0 a 160</th>
                                <th>3m</th>
                            </tr>
                            <tr>
                                <th>61 ó más</th>
                                <th>161 a 170</th>
                                <th>4m</th>
                            </tr>
                            <tr>
                                <th>61 ó más</th>
                                <th>171 ó más</th>
                                <th>5m</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Código</td>
                                    <td>Nombre</td>
                                    <td>Desayuno</td>
                                    <td>Merienda_am</td>
                                    <td>Almuerzo</td>
                                    <td>Merienda_pm</td>
                                    <td>Cena</td>
                                    <td>Estado</td>
                                    <td>Editar</td>
                                    {{-- <td>Eliminar</td> --}}
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

    <div class="modal fade bd-example-modal-lg" id="modal_datos" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <label><b>Nombre:</b></label>
                                <input type="text" class="form-control" rows="4" id="nombre" name="nombre"
                                    placeholder="Nombre" required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Desayuno:</b></label>
                                <textarea type="text" class="form-control" rows="4" id="desayuno" name="desayuno"
                                    placeholder="Nombre" required></textarea>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Merienda media mañana:</b></label>
                                <textarea type="text" class="form-control" rows="4" id="merienda_am" name="merienda_am"
                                    placeholder="Nombre" required></textarea>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Almuerzo:</b></label>
                                <textarea type="text" class="form-control" rows="4" id="almuerzo" name="almuerzo"
                                    placeholder="Nombre" required></textarea>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Merienda media tarde:</b></label>
                                <textarea type="text" class="form-control" rows="4" id="merienda_pm" name="merienda_pm"
                                    placeholder="Nombre" required></textarea>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><b>Cena:</b></label>
                                <textarea type="text" class="form-control" rows="4" id="cena" name="cena"
                                    placeholder="Nombre" required></textarea>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label for="estado"><b>Estado:</b></label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_activo" name="estado"
                                        class="custom-control-input bg-danger" value="ACTIVO" checked>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar<i
                                class="icon-cancel"></i></button>
                        <button class="btn btn-success" type="submit">Aceptar<i class="icon-ok"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade bd-example-modal-lg" id="modal_eliminar" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
        var user_id = {{ Auth::user()->id }};

    </script>
    <script src="{{ URL::asset('js/scripts/dieta.js') }}"></script>
@endsection
