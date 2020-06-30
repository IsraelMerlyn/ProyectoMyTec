var tabla;

//Funcion que se ejecuta al inicio
function init(){
    mostrarform(false);
    listar();
    
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    
    //Cargamos los items al select Cliente
	$.post("../ajax/prestamos.php?op=selectCliente", function(r){
	            $("#idcliente").append(r);
	            $('#idcliente').selectpicker('refresh');
	});
    
    //Cargamos los items al select Usuarios
    $.post("../ajax/prestamos.php?op=selectUsuario", function(r){
	            $("#usuario").append(r);
	            $('#usuario').selectpicker('refresh');
	});
}

//Funcion Limpiar
function limpiar(){
    $("#idprestamo").val("");
    $("#idcliente").val("");
    $("#usuario").val("");
    $("#fprestamo").val("");
    $("#monto").val("");
    $("#interes").val("");
    $("#saldo").val("");
    $("#formapago").val("");
    $("#fechapago").val("");
    $("#plazo").val("");
    $("#fplazo").val("");
    $("#estado").val("");
    
    //Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fprestamo').val(today);
    
}

//Mostrar Formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

function cancelarform()
{
    limpiar();
    mostrarform(false);
}


function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/prestamos.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/prestamos.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idprestamo)
{
	$.post("../ajax/prestamos.php?op=mostrar",{idprestamo : idprestamo}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcliente").val(data.cliente);
        $('#idcliente').selectpicker('refresh');
        $("#usuario").val(data.usuario);
        $('#usuario').selectpicker('refresh');
		$("#fprestamo").val(data.fecha);
		$("#monto").val(data.monto);
		$("#interes").val(data.interes);
		$("#saldo").val(data.saldo);
		$("#formapago").val(data.formapago);
        $("#fechapago").val(data.fechap);
        $("#plazo").val(data.plazo);
        $("#fplazo").val(data.fechaf);
		$("#estado").val(data.estado);
		$("#idprestamo").val(data.idprestamo);

 	});
    }
//Función para eliminar registros
function eliminar(idprestamo)
{
	bootbox.confirm("¿Está Seguro de eliminar el Prestamo?", function(result){
		if(result)
        {
        	$.post("../ajax/prestamos.php?op=eliminar", {idprestamo : idprestamo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}
init();

/*
$(document).ready(function($){
var mont;
	$('#monto').keyup(function (e) {
		mont = $(this).val();
	 //console.log(mont)	  
	})

		$('select#interes').on('change',function(){
		     var valor = $(this).val(); 
			 var subt = mont * (valor/100);
			 var total = parseFloat(subt) + parseFloat(mont);			
			 $("#saldo").val(total);		
		})

sumaDias = function(d, fecha)
{
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "-" + (Fecha.getMonth() +1) + "-" + Fecha.getFullYear());
 var sep = sFecha.indexOf('-') != -1 ? '-' : '-';
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[2]+'-'+aFecha[1]+'-'+aFecha[0];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = dia+sep+mes+sep+anno;
 return (fechaFinal);
 }

 $('select#formapago').on('change',function(){
		     var valor = $(this).val(); 
			 if(valor == 'Diario'){
			 	$('#fechapago').val(sumaDias(1));
			 }
				 if(valor == 'Semanal'){
				 	$('#fechapago').val(sumaDias(5));
				 }
					 if(valor == 'Quincenal'){
					 	$('#fechapago').val(sumaDias(15));
					 }
						 if(valor == 'Mensual'){
						 	$('#fechapago').val(sumaDias(30));
						 }
		})

  $('select#plazo').on('change',function(){
		     var valor = $(this).val(); 
			 if(valor == 'Dia'){
			 	$('#fplazo').val(sumaDias(1));
			 }
				 if(valor == 'Semana'){
				 	$('#fplazo').val(sumaDias(5));
				 }
					 if(valor == 'Quincena'){
					 	$('#fplazo').val(sumaDias(15));
					 }
						 if(valor == 'Mes'){
						 	$('#fplazo').val(sumaDias(30));
						 }
		})
})  
*/
