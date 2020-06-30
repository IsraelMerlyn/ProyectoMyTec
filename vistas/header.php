<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>

<!-- Mirrored from www.ravijaiswal.com/Afro-v.1.1/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Mar 2017 03:12:20 GMT -->
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Prestamos</title>

<link rel="stylesheet" type="text/css" href="../public/css/bootstrap/bootstrap.min.css"/>
 
<script src="../public/js/demo-rtl.js"></script>
 
 
    <link rel="stylesheet" type="text/css" href="../public/css/libs/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/libs/nanoscroller.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/compiled/theme_styles.css"/>
    <link rel="stylesheet" href="../public/css/libs/daterangepicker.css" type="text/css"/>
    <link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
<!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
  <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
  <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
  
</head>
<body>
<div id="theme-wrapper">
<header class="navbar" id="header-navbar">

<div class="container">
<a href="concepto.php" id="logo" class="navbar-brand">

</a>
<div class="clearfix">
<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="fa fa-bars"></span>
</button>
<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
<ul class="nav navbar-nav pull-left">
<li>
<a class="btn" id="make-small-nav"><i class="fa fa-bars"></i></a>
</li>
</ul>
</div>

<div class="nav-no-collapse pull-right" id="header-nav">
<ul class="nav navbar-nav pull-left">
<li class="dropdown profile-dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" alt=""/>
<span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span> <b class="caret"></b>
</a>
<ul class="dropdown-menu">
<li><a href="../ajax/usuarios.php?op=mostrar"><i class="fa fa-user"></i>Perfil</a></li>
<li><a href="../ajax/usuarios.php?op=salir"><i class="fa fa-power-off"></i>Salir</a></li>
</ul>
</li>
</ul>
</div>
</div>
</div>
</header>

<div id="page-wrapper" class="container">
<div class="row">
<div id="nav-col">
<section id="col-left" class="col-left-nano">
<div id="col-left-inner" class="col-left-nano-content">
<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
<img alt="" src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>"/>
<div class="user-box">
<span class="name"><?php echo $_SESSION['nombre']; ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu">
<li><a href="#"><i class="fa fa-user"></i>Perfil</a></li>
<li><a href="../ajax/usuario.php?op=salir"><i class="fa fa-power-off"></i>Salir</a></li>
</ul>
</span>
<span class="status">
<i class="fa fa-circle"></i> En Linea
</span>
</div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
<ul class="nav nav-pills nav-stacked">
       
       <?php 
            if ($_SESSION['Escritorio']==1)
            {
              echo '<li>
        <a href="concepto.php">
        <i class="fa fa-dashboard"></i>
        <span>Escritorio</span>
        </a>
        </li>';
            }
            ?>
        
         <?php 
            if ($_SESSION['Clientes']==1)
            {
              echo '<li>
<a href="clientes.php">
<i class="fa fa-users"></i>
<span>Clientes</span>
</a>
</li>';
            }
            ?>
        
    <?php 
            if ($_SESSION['Prestamos']==1)
            {/*
              echo '<li>
<a href="prestamos.php">
<i class="fa fa-money"></i>
<span>Prestamos</span>

</a>
</li>';*/
            }
            ?>
                <?php 
            if ($_SESSION['Pagos']==1)
            {/*
              echo '<li>
<a href="pagos.php">
<i class="fa fa-star"></i>
<span>Pagos</span>

</a>
</li>';*/
            }
            ?>
                <?php 
            if ($_SESSION['Usuarios']==1)
            {
              echo '<li>
<a href="usuarios.php">
<i class="fa fa-user"></i>
<span>Usuarios</span>
</a>
</li>';
            }
            ?>
                <?php 
            if ($_SESSION['Gastos']==1)
            {/*
              echo '<li>
<a href="gastos.php">
<i class="fa fa-bullhorn"></i>
<span>Gastos</span>
</a>
</li>';*/
            }
            ?>
                <?php 
            if ($_SESSION['Consultas']==1)
            {/*
              echo '<li>
<a href="#" class="dropdown-toggle">
<i class="fa fa-bar-chart-o"></i>
<span>Consultas</span>
<i class="fa fa-angle-right drop-icon"></i>
</a>
<ul class="submenu">
<li>
<a href="#">
Consulta de Prestamos
</a>
</li>
<li>
<a href="#">
Consulta de Pagos
</a>
</li>
<li>
<a href="#">
Consulta diarias
</a>
</li>
</ul>
</li>';*/
            }
            ?>
</ul>
</div>
</div>
</section>
<div id="nav-col-submenu"></div>
</div>
<!-- Inicio Wrapper -->
<div id="content-wrapper">
<div class="row">
<div class="col-lg-12">
<!-- Fin header PHP -->
