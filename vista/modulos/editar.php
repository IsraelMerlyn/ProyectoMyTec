<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:login");

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
<h1 class="page-header">
    Modificar Registro
    <!-- <?php 
                echo $respuesta["usuario"];
                echo $cliente->id != null ? $cliente->Nombre : 'Nuevo Registro';
         ?> -->
</h1>

<ol class="breadcrumb">
  <li><a href="usuarios">Usuarios</a></li>
  <!-- <li class="active"><?php echo $cliente->id != null ? $respuesta["usuario"]: 'Nuevo Registro'; ?></li> -->
</ol>

<form id="frm-alumno" action="" method="post" enctype="multipart/form-data">

    <?php
         
         $editar = new MvcControlador();
         $editar->editarUsuarioControlador();
         $editar->actualizarUsuarioControlador();
    ?>        
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-primary">Guardar</button>
    </div>
</form>
<script  src="vista/assets/js/datatable.js">  

</script>

<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>