<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuarios
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$direccion,$telefono,$login,$clave,$imagen,$permisos)
	{
		$sql="INSERT INTO usuarios (nombre,direccion,telefono,login,clave,imagen,estado)
		VALUES ('$nombre','$direccion','$telefono','$login','$clave','$imagen','1')";
       // return ejecutarConsulta($sql);
        $idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$nombre,$direccion,$telefono,$login,$clave,$imagen,$permisos)
	{
		$sql="UPDATE usuarios SET 
        nombre='$nombre',
        direccion='$direccion',
        telefono='$telefono',
        login='$login',
        clave='$clave',
        imagen='$imagen' 
        WHERE idusuario='$idusuario'";
		
        ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuariopermiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuarios SET estado='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuarios SET estado='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuarios WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuarios";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuariopermiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT idusuario,nombre,direccion,telefono,imagen,login FROM usuarios WHERE login='$login' AND clave='$clave' AND estado='1'"; 
    	return ejecutarConsulta($sql);  
    }
    
    public function select()
	{
		$sql="SELECT * FROM usuarios WHERE estado=1 ORDER BY nombre DESC";
		return ejecutarConsulta($sql);		
	}
}

?>