var table;
var id=0;

var title_modal_data = "Registrar Servicio";
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListDatatable();
    catch_parameters();
});
// datatable catalogos
function ListDatatable()
{
    table = $('#table').DataTable({
        //dom: 'lfBrtip',
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'servicio_dt'
            
        },
        columns: [
            { data: 'user.name'},
            { data: 'razon_social'},
            { data: 'servicio'},
            { data: 'Imagen',   orderable: false, searchable: false },
            { data: 'direccion'},
            { data: 'telefono'},
            { data: 'web'},
            { data: 'email'},
            { data: 'contacto'},
            { data: 'estado',
            "render": function (data, type, row) {
                    if (row.estado === 'ACTIVO') {
                        return '<center><p class="bg-success text-white"><b>ACTIVO</b></p></center>';
                    }
                    else if (row.estado === 'INACTIVO') {          
                        return '<center><p class="bg-warning text-white"><b>INACTIVO</b></p></center>';
                    }
                    else if (row.estado === 'ELIMINADO') {          
                        return '<center><p class="bg-danger text-white"><b>ELIMINADO</b></p></center>';
                    }
                }
            },
            { data: 'Editar',   orderable: false, searchable: false },
            { data: 'Eliminar',   orderable: false, searchable: false },
        ],
        buttons: [
            {
                text: '<i class="icon-eye"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Columnas',
                extend: 'colvis'
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-excel"></i>',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Excel',
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            //btn Refresh
            {
                text: '<i class="icon-arrows-cw"></i>',
                className: 'rounded btn-info m-2',
                action: function () {
                    table.ajax.reload();
                }
            }
        ],
    });
};

// guarda los datos nuevos
function Save() {
    $.ajax({
        url: "servicio",
        method: 'post',
        data: catch_parameters(),
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg);
            } else {
                toastr.warning(result.msg);
            }
            table.ajax.reload();
        },
        error: function (result) {
            console.log(result.responseJSON.message);
            toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
        },
    });
    
}



// captura los datos
function Edit(id) {
    $.ajax({
        url: "servicio/{servicio}/edit",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            show_data(result);
        },
        error: function (result) {
            toastr.error(result + ' CONTACTE A SU PROVEEDOR POR FAVOR.');

            console.log(result);
        },

    });
};

/// muestra la vista con los datos capturados
var data_old;
function show_data(obj) {
    ClearInputs();
    //console.log(obj)
    obj = JSON.parse(obj);
    id= obj.id;
    $("#razon_social").val(obj.razon_social);
    $("#servicio").val(obj.servicio);
    $("#direccion").val(obj.direccion);
    $("#telefono").val(obj.telefono);
    $("#contacto").val(obj.contacto);
    $('#image').attr('src', obj.logo);
    $('#label_image').html(obj.logo);
    $("#web").val(obj.web);
    $("#email").val(obj.email);    
    if (obj.estado == "ACTIVO") {
        $('#estado_activo').prop('checked', true);
    }
    if (obj.estado == "INACTIVO") {
        $('#estado_inactivo').prop('checked', true);
    }
    $("#title-modal").html("Editar Registro");

    data_old = catch_parameters();

    $('#modal_datos').modal('show');
};

// actualiza los datos
function Update() {
    var data_new = catch_parameters();
    if (data_old != data_new) {
        $.ajax({
            url: "servicio/{servicio}",
            method: 'put',
            data: catch_parameters(),
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
                    table.ajax.reload();        
                } else {
                    toastr.warning(result.msg);
                    table.ajax.reload();
                }
            },
            error: function (result) {
                console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },
        });

    }
}

//funcion para eliminar valor seleccionado
function Delete(id_) {
    id= id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "servicio/{servicio}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg,{"progressBar": true,"closeButton": true});                
            } else {
                toastr.warning(result.msg);
            }
            table.ajax.reload();
        },
        error: function (result) {
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
    $('#modal_eliminar').modal('hide');
});





//////////////////////////////////////////////

// METODOS NECESARIOS
// funcion para volver mayusculas
function Mayus(e) {
    e.value = e.value.toUpperCase();
}

// obtiene los datos del formulario
function catch_parameters()
{
    var data = $(".form-data").serialize();
    data += "&user_id="+user_id;
    data += "&id="+id;
    data += "&extension_image=" + extension_image;
    data +="&image=" + reader.result;
    //console.log(data);
    return data;
}

// muestra el modal
$("#btn-agregar").click(function () {
    ClearInputs();
    $("#title-modal").html(title_modal_data);
    $("#modal_datos").modal("show");
});

// metodo de bootstrap para validar campos

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('form-data');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    if (id == 0) {
                        Save();
                    } else {
                        Update();
                    }
                    $('#modal_datos').modal('hide');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/// limpi campos despues de utilizar el modal
function ClearInputs() {
    var forms = document.getElementsByClassName('form-data');
    Array.prototype.filter.call(forms, function (form) {
        form.classList.remove('was-validated');
    });
    //__Clean values of inputs
    $("#form-data")[0].reset();
    $('#image').attr('src', '');
    $('#label_image').html("Elegir archivo");
    id=0;
};




//Metodos para imagen
var reader = new FileReader();
var extension_image = "";
$("#logo").change(function (e) {
    ImgPreview(this);
    $fileName = e.target.files[0].name;
    extension_image = $fileName.replace(/^.*\./, '');
    $('#label_image').html($fileName);
    //console.log(extension_image);
});
function ImgPreview(input) {
    if (input.files && input.files[0]) {
        reader.onload = function (e) {
            //console.log(e);
            $('#image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
