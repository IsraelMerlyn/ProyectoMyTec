<?php
ob_start();
session_start();




if(!$_SESSION["validar"]){

    header("location:login");
    //header("location:index.php?action=login");

	exit();

}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD MVC | 2020</title>
        
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="vista/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="vista/assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="vista/assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="vista/assets/css/style.css" />
        <link href="vista/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
         <script src="vista/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="vista/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
          <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>
	</head>
    <body>
        
  <div class="container box">
  <h1 class="page-header">CRUD con el patrón MVC en PHP POO y PDO </h1>


<a class="btn btn-primary pull-right" href="salir">Cerrar Sesión</a>
<!-- <a class="btn btn-primary pull-right" href="index.php?action=salir">Cerrar Sesión</a> -->

<br><br><br>

<table class="table  table-striped  table-hover" id="tabla">
<thead>
    <tr>
    <th style="width:120px; background-color: #5DACCD; color:#fff">ID</th>
        <th style="width:180px; background-color: #5DACCD; color:#fff">Usuario</th>
        <th style=" background-color: #5DACCD; color:#fff">Nombre y Apellido</th>
        <th style=" background-color: #5DACCD; color:#fff">Correo</th>
        <th style="width:120px; background-color: #5DACCD; color:#fff">Contraseña</th>            
        <th style="width:60px; background-color: #5DACCD; color:#fff"></th>
        <th style="width:60px; background-color: #5DACCD; color:#fff"></th>
    </tr>
</thead>
<tbody>
    <?php

        $vistaUsuario = new MvcControlador();
        $vistaUsuario->vistaUsuariosControlador();
        $vistaUsuario->borrarUsuarioControlador();

    ?>


</tbody>
</table> 
<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>

</body>
<script  src="vista/assets/js/datatable.js">  

</script>


</html>
<?php
ob_end_flush();
?>