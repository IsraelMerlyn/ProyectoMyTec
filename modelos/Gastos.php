<?php 
//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";
    
Class Gastos
{
    //implementamos nuestro constructor
    public function __construct()
    {   
    }
    
    //implementamos un metodo para insertar registros
    public function insertar($idusuario,$fecha,$concepto,$gasto)
    {
        $sql="INSERT INTO gastos (idusuario,fecha,concepto,gasto)
		                  VALUES ('$idusuario','$fecha','$concepto','$gasto')";
		return ejecutarConsulta($sql);
    }
    
    //Implementamos el metodo para Editar Registros
    public function editar($idgasto,$idusuario,$fecha,$concepto,$gasto)
	{
		$sql="UPDATE gastos SET idusuario='$idusuario',
                                fecha='$fecha',
                                concepto='$concepto',
                                gasto='$gasto' 
                                WHERE idgasto='$idgasto'";
		return ejecutarConsulta($sql);
	}
    
    //implementamos el metodo eliminar
    public function eliminar($idgasto)
	{
		$sql="DELETE FROM gastos WHERE idgasto='$idgasto'";
		return ejecutarConsulta($sql);
	}
    
    //Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idgasto)
	{
		$sql="SELECT * FROM gastos WHERE idgasto='$idgasto'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
//mostrar lista de la tabla gastos    
    public function listar()
	{
		$sql="SELECT g.idgasto,
                    g.idusuario,
                    u.nombre as Usuario, 
                    g.fecha,
                    g.concepto,
                    g.gasto 
                    FROM gastos g INNER JOIN usuarios u 
                    ON g.idusuario=u.idusuario";
		return ejecutarConsulta($sql);		
	}

}

?>