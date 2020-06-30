var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })
    
    //Cargamos los items al select Usuario
	$.post("../ajax/gastos.php?op=selectUsuario", function(r){
	            $("#idusuario").html(r);
	            $('#idusuario').selectpicker('refresh');

	});
}

//Funcion Limpiar
function limpiar() {
    $("#idgasto").val("");
    $("#idusuario").val("");
    $("#fecha").val("");
    $("#concepto").val("");
    $("#gasto").val("");
    
    //Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha').val(today);
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}


function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/gastos.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "desc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/gastos.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idgasto) {
    $.post("../ajax/gastos.php?op=mostrar", {
        idgasto: idgasto
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idusuario").val(data.idusuario);
        $('#idusuario').selectpicker('refresh');
        $("#fecha").val(data.fecha);
        $("#concepto").val(data.concepto);
        $("#gasto").val(data.gasto);
        $("#idgasto").val(data.idgasto);
    })
}
//Función para eliminar registros
function eliminar(idgasto)
{
	bootbox.confirm("¿Está Seguro de eliminar el Gasto?", function(result){
		if(result)
        {
        	$.post("../ajax/gastos.php?op=eliminar", {idgasto : idgasto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();