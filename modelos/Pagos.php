<?php
//Incluimos la concexion a la base de datos.
require "../config/Conexion.php";

Class Pago
{
    public function __contruct()
    {   
    }
    
    //Implementamos un metodo para insertar pagos.
    public function insertar($idprestamo,$usuario,$fecha,$cuota)
    {
        $sql="INSERT INTO pagos (idprestamo,usuario,fecha,cuota) 
              VALUES('$idprestamo','$usuario','$fecha','$cuota')";
        return ejecutarConsulta($sql);
    }
    
    //Implementamos un metodo para Actualizar pagos.
    public function editar($idpago,$idprestamo,$usuario,$fecha,$cuota)
    {
        $sql="UPDATE pagos SET idprestamo='$idprestamo',
                               usuario='$usuario',
                               fecha='$fecha',
                               cuota='$cuota' 
                         WHERE idpago='$idpago'";
        return ejectuarConsulta($sql);
    }
    
    //Implementamos el metodo para eliminar pagos
    public function eliminar($idpago)
    {
        $sql="DELETE FROM pagos WHERE idpago='$idpago'";
        return ejecutarConsulta($sql);
    }
    
    //Implementamos el metodo para cancelar el pago
    public function mostrar($idpago)
    {
        $sql="SELECT c.nombre AS cliente,g.usuario,g.fecha,g.cuota FROM pagos g INNER JOIN prestamos p ON g.idprestamo=p.idprestamo INNER JOIN clientes c ON p.idcliente=c.idcliente";
        return ejectuarConsultaSimpleFila($sql);
    }
    
    //Implementamos el metodo para cancelar el pago
    public function listar()
    {
        $sql="SELECT g.idpago,c.nombre AS cliente,g.usuario,g.fecha,g.cuota FROM pagos g INNER JOIN prestamos p ON g.idprestamo=p.idprestamo INNER JOIN clientes c ON p.idcliente=c.idcliente";
        return ejecutarConsulta($sql);
    }
}
?>