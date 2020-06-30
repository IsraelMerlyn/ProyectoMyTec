<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';

if ($_SESSION['Prestamos']==1)
{
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                     <h2 class="box-title">Prestamos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h2>
                </header>
                <div class="main-box-body clearfix" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="tbllistado">
                            <thead>
                                <tr>
                                   <th>Opciones</th>
                                    <th>Clientes</th>
                                    <th>Usuarios</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Interes</th>
                                    <th>Saldo</th>
                                    <th>Pagos</th>
                                    <th>Fechas</th>
                                    <th>Plazo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
                </div>
                
                   <div class="main-box-body clearfix" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                           <div class="form-group col-md-6 col-sm-9 col-xs-12">
                            <label>Cliente</label>
                            <input type="hidden" name="idprestamo" id="idprestamo">
                            <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required></select>                           
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                           <label>Usuarios</label>
                            <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" required></select> 
                            <input type="hidden" class="form-control" name="fprestamo" id="fprestamo" required>
                        </div>                          
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Monto</label>
                            <input type="number" name="monto" id="monto" class="form-control" placeholder="Monto" required>
                            <input type="hidden"  id="valor" >
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Interes</label>
                            <select class="form-control select-picker" name="interes" id="interes" required>
                              <option value="20">20 %</option>
                              <option value="15">15 %</option>
                              <option value="13">13 %</option>
                              <option value="10">10 %</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Saldo</label>
                            <input type="number" name="saldo" id="saldo" class="form-control" placeholder="Saldo" required >
                        </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Forma Pago</label>
                            <select class="form-control select-picker" name="formapago" id="formapago" required>
                              <option value="Diario">Diario</option>
                              <option value="Semanal">Semanal</option>
                              <option value="Quincenal">Quincenal</option>
                              <option value="Mensual">Mensual</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha pago:</label>
                            <input type="date" class="form-control" name="fechapago" id="fechapago" required >

                          </div>
                        </div>
                         <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Plazo</label>
                            <select class="form-control select-picker" name="plazo" id="plazo" required>
                              <option value="Dia">Dia</option>
                              <option value="Semana">Semana</option>
                              <option value="Quincena">Quincena</option>
                              <option value="Mes">Mes</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha Cancelacion</label>
                            <input type="date" class="form-control" name="fplazo" id="fplazo" required >
                          </div>
                         </div>
                        <div class="form-group col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script>
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
				 	$('#fechapago').val(sumaDias(7));
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
				 	$('#fplazo').val(sumaDias(7));
				 }
					 if(valor == 'Quincena'){
					 	$('#fplazo').val(sumaDias(15));
					 }
						 if(valor == 'Mes'){
						 	$('#fplazo').val(sumaDias(30));
						 }
		})
})
</script>
<script type="text/javascript" src="scripts/prestamos.js"></script>
<!--<script type="text/javascript" src="scripts/prestamos.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>-->

<?php 
}
ob_end_flush();
?>

