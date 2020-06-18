<?php
#CLASE PARA LA CONEXION AL SERVIDOR Y BASE DE DATOS
class Conexion
{

    #METODO PARA REALIZAR LA CONEXION A LA BASE DE DATOS
/*
$contraseña = "hunter2";
$usuario = "parzibyte";
$nombreBaseDeDatos = "mascotas";
# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
$rutaServidor = "127.0.0.1";
$puerto = "5432";
try {
    $base_de_datos = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
*/
    public function conectar()
    {
        $contraseña = "1408";
$usuario = "postgres";
$nombreBaseDeDatos = "aula";
# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
$rutaServidor = "127.0.0.1";
$puerto = "5433";
        $link = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
      //  $link = new PDO("mysql:host=127.0.0.1;dbname=aula", "root", "1408");
        return $link;
    }
}
    
    #PARA PROBAR LA CONEXION

    // $ok = new Conexion();
    // $ok->conectar();
    // echo "conexion con exito";
