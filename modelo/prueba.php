<?php
    require_once ("conexion.php");
    require_once ("crud.php");
    $datosControlador = array ("usuario" =>"cypbert23",
    "password" => "cd5f12be96a10a78d727be60ca3441");

    $okkk = Datos::ingresoUsuarioModelo($datosControlador,"usuarios");
    var_dump( $okkk);

    $vale = new Datos();
    $oka= $vale->ingresoUsuarioModelo($datosControlador,"usuarios");
   
     echo("<br>".$oka);

?>