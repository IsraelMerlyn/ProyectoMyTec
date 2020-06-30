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

if ($_SESSION['Escritorio']==1)
{
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2 class="box-title">Escritorio</h2>
                </header>
                <div class="row">
                    <div class="main-box-body clearfix" >
                    <div class="col-sm-4">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">Prestamos del Dia</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-4">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">Pagos del Dia</h4>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-4">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">Gastos del Dia</h4>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="main-box-body clearfix" >
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
        <script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>

