var tabla;

//Funcion que se ejecuta al inicio
        function init() {
            mostrarform(false);
            listar();

            $("#formulario").on("submit", function (e) {
                guardaryeditar(e);
            });
            
                    //Cargamos los items al select Cliente
            $.post("../ajax/pagos.php?op=selectPrestamo", function(r){
                        $("#idprestamo").append(r);
                        $('#idprestamo').selectpicker('refresh');
            });
        }

        //Funcion Limpiar
        function limpiar() {
            $("#idpago").val("");
            $("#idprestamo").val("");
            $("#usuario").val("");
            $("#fecha").val("");
            $("#cuota").val("");

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
                    url: '../ajax/pagos.php?op=listar',
                    type: "get",
                    dataType: "json",
                    error: function (e) {
                        console.log(e.responseText);
                    }
                },
                "bDestroy": true,
                "iDisplayLength": 10, //Paginación
                "order": [
                    [3, "desc"]
                ] //Ordenar (columna,orden)
            }).DataTable();
        }

        function guardaryeditar(e) {
            e.preventDefault(); //No se activará la acción predeterminada del evento
            $("#btnGuardar").prop("disabled", true);
            var formData = new FormData($("#formulario")[0]);

            $.ajax({
                url: "../ajax/pagos.php?op=guardaryeditar",
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

        function mostrar(idpago) {
            $.post("../ajax/pagos.php?op=mostrar", {idpago: idpago}, 
                function (data, status) 
                 {
                data = JSON.parse(data);
                mostrarform(true);

                $("#idprestamo").val(data.idprestamo);
                $('#idprestamo').selectpicker('refresh');
                $("#usuario").val(data.usuario);
                $("#fecha").val(data.fecha);
                $("#cuota").val(data.cuota);
                $("#idpago").val(data.idpago);
            })
        }
        
       //Función para eliminar registros
function eliminar(idpago)
{
	bootbox.confirm("¿Está Seguro de eliminar el Pago?", function(result){
		if(result)
        {
        	$.post("../ajax/pagos.php?op=eliminar", {idpago : idpago}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}
init();