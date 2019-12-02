var table;
var id = 0;

var title_modal_data = " Agregar Rutina";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //catch_parameters();
    //ListDatatable();
    //dateEntry();
    ListDatatableProducts();
});

// datatable catalogos
function ListDatatableProducts() {
    table = $('#tableProducts').DataTable({
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'dt_products'

        },
        columns: [
            {
                data: 'Imagen',
                orderable: false,
                searchable: false
            },
            {
                data: 'nombre'
            },
            {
                data: 'presentacion'
            },
            // {
            //     data: 'precio'
            // },
            {
                data: 'Shop',
                orderable: false,
                searchable: false
            },
        ]
    });
};


///////////////////////
//For basket
//////////////////////
var Basket = [];
var row_index = 1;
var total = 0;
var total_d = 0;
var id_client = 0;



function AddBasket(id, nombre, precio,dosis) {
    //console.log(dosis);
    var index = Basket.findIndex(item => item.id === id);
    if (index == -1) {
        var product = {
            "id": id,
            "nombre": nombre,
            "precio": precio,
            "dosis": dosis
        };
        Basket.push(product);
        var code = '<tr id="tr' + row_index + '">';
        code += '<td>' + product.nombre + '</td>';
        // code += '<td>' + product.precio + '</td>';
        code += '<td><input id="dosis' + row_index + '" type="text" onchange="dosisChange(' + row_index + ',' + product.id + ',\'' + product.nombre + '\');" class="form-control" value="Sin especificar"></td>';
        code += '<td><a class="btn btn-xs btn-danger text-white" onclick="RemoveBasket(' + row_index + ',' + product.id + ')"><i class="icon-cart-arrow-down"></i></a></td>';
        code += '</tr>'
        $('#table-basket').append(code);
        row_index++;
        //ShowTotal();
        //console.log(Basket);
    } else {
        toastr.warning('El producto ya se encuentra agregado.');
    }
}


function dosisChange(row_index, id, nombre) {
    var idinput = "#dosis" + row_index;
    var index = Basket.findIndex(item => item.id === id);
    var val_imput = $(idinput).val();
    Basket[index].dosis = val_imput;
    //console.log(Basket);
    //console.log(Basket);
}


function RemoveBasket(row_i, id) {
    $("#tr" + row_i).remove();
    var index = Basket.findIndex(item => item.id === id)
    Basket.splice(index, 1);
    //ShowTotal();

    //console.log(Basket);
}



function ShowTotal() {
    total = 0;
    total_d = 0;
    for (let index = 0; index < Basket.length; index++) {
        total += Basket[index].subtotal;
    }
    total = total.toFixed(2);
    total_d = total - (total * $('#select_discount').val());
    total_d = total_d.toFixed(2);
    $('#total_c').html(total_d);
    $('#total_s').html(total);
}



function SaveRoutine() {
    if (Basket.length == 0) {
        toastr.warning("Debe seleccionar almenos un producto antes de registrar el plan.");
    }
    else{
        var d = new Date();
        var currenDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
        var data = {
            'fecha': currenDate.toString(),
            'nombre': $('#nombre_plan').val(),
            'user_id': user_id,
            'estado': 'ACTIVO',
        };
        console.log(data);
        $.ajax({
            url: "rutinas",
            method: 'post',
            data: data,
            success: function (result) {
                if (result.success) {
                    SaveDetails(result.routine_id);
                    //toastr.success(result.msg);
                    //console.log("ID VENTA REGISTRADA "+result.routine_id);

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

function SaveDetails(routine_id) {

    for (let index = 0; index < Basket.length; index++) {
        var data = {
            'routine_id':routine_id,
            'product_id':Basket[index].id,
            'user_id': user_id,
            'dosis':Basket[index].dosis,
            'estado': 'ACTIVO'
        };
        //console.log(data);
        $.ajax({
            url: "save_detail",
            method: 'post',
            data: data,
            success: function (result) {
                if (result.success) {
                    console.log("registros de detalles guardados correctamente..");
                    //
                    //toastr.success(result.msg);

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
    SuccessSale()
    //location.reload();
}

function SuccessSale() {
    $("#btn_save_sale").hide();
    $("#btn_save_sale").addClass("disabled");
    $("#modal_sale_susscess").modal("show");
}