var table;
var id = 0;

var title_modal_data = " Agregar plan";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    SelectClients();
    ListDatatableClents();
});

// datatable catalogos

$("#btn-consultar").click(function () {
    console.log($("#client_id").val());
    if ($("#client_id").val() != null) {
        $("#table").dataTable().fnDestroy();
        ListDatatable();
    } else {
        toastr.error('Debe seleccionar un cliente antes de consultar.');
    };

});


function ListDatatableClents() {
    table = $('#table_clients').DataTable({
        dom: 'lfBrtip',
        //dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'list_clientes_ejecutions'
            
        },
        columns: [
            { data: 'name'},
            { data: 'codigo'},

            { data: 'Seleccionar',   orderable: false, searchable: false }
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


function ListDatatable(id) {
    $("#table").dataTable().fnDestroy();
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        //dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'list_ejecutions',
            data: function (obj) {
                obj.client_id = id;
            }
        },
        columns: [{
            data: 'client.codigo'
        },
        {
            data: 'client.name'
        },
        {
            data: 'fecha'
        },
        {
            data: 'verificado',
            "render": function (data, type, row) {
                if (row.verificado === 'REALIZADO') {
                    return '<center><p class="border border-success text-success"><b>REALIZADO</b></p></center>';
                } else if (row.verificado === 'PENDIENTE') {
                    return '<center><p class="border border-warning text-warning"><b>PENDIENTE</b></p></center>';
                } else if (row.verificado === 'VENCIDO') {
                    return '<center><p class="border border-danger text-danger"><b>VENCIDO</b></p></center>';
                }
            }
        },
        {
            data: 'plan.fecha_inicio'
        },
        {
            data: 'plan.fecha_inicio'
        }
        ],
        buttons: [{
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


//////////////////////////////////////////////

// METODOS NECESARIOS

function SelectClients() {
    $.ajax({
        url: "list_clients",
        method: 'get',
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label><b>Clientes:</b></label>';
            code += '<select class="form-control" name="client_id" id="client_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_client").html(code);
        },
        error: function (result) {

            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}


function SelectRoutines() {
    $.ajax({
        url: "list_routines",
        method: 'get',
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label><b>Planes disponibles:</b></label>';
            code += '<select class="form-control" name="routine_id" id="routine_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.nombre + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_routine").html(code);
        },
        error: function (result) {

            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}

//fecha de entrada
function DatePicker() {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $("#datetimepicker1").on("change.datetimepicker", function (e) {
        $('#datetimepicker2').datetimepicker('minDate', e.date);
    });
    $("#datetimepicker2").on("change.datetimepicker", function (e) {
        $('#datetimepicker1').datetimepicker('maxDate', e.date);
    });

    $('#datetimepicker3').datetimepicker({
        format: 'LT'
    });
}


function save_ejecutions(plan_id, client_id, start, end) {
    console.log('llegando');
    var startDate = new Date(start); //YYYY-MM-DD
    var endDate = new Date(end); //YYYY-MM-DD
    // console.log(start, end);
    // console.log(startDate, endDate);
    //endDate.setDate(endDate.getDate() + 1);
    var getDateArray = function (start, end) {
        var arr = new Array();
        var dt = new Date(start);
        while (dt <= end) {
            arr.push(new Date(dt));
            dt.setDate(dt.getDate() + 1);
        }
        return arr;
    }

    var dateArr = getDateArray(startDate, endDate);
    for (var i = 0; i < dateArr.length; i++) {
        // console.log(dateArr[i]);

        console.log(dateArr[i].toISOString().slice(0, 10));

        //Creando Ejecuciones

        var data = {
            'plan_id': plan_id,
            'client_id': client_id,
            'fecha': dateArr[i].toISOString().slice(0, 10),
            'verificado': 'PENDIENTE',
            'estado': 'ACTIVO'

        };

        $.ajax({
            url: "save_ejecutions",
            method: 'post',
            data: data,
            success: function (result) {
                if (result.success) {
                    //toastr.success(result.msg);
                    //console.log(result);
                } else {
                    toastr.warning(result.msg);
                }
            },
            error: function (result) {
                console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },
        });
    }
}
