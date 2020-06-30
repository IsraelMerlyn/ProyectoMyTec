<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function comprasfecha($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT DATE(i.fecha_hora) as fecha,
		u.nombre as usuario,
		p.nombre as proveedor,
		i.tipo_comprobante,
		i.serie_comprobante,
		i.num_comprobante,
		i.total_compra,
		i.impuesto,
		i.estado 
		FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario 
		WHERE DATE(i.fecha_hora)>='$fecha_inicio' AND DATE(i.fecha_hora)<='$fecha_fin'";
		return ejecutarConsulta($sql);		
	}

	public function ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente)
	{
		$sql="SELECT DATE(v.fecha_hora) as fecha,u.nombre as usuario, p.nombre as cliente,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin' AND v.idcliente='$idcliente'";
		return ejecutarConsulta($sql);		
	}

	public function totalmontohoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as total_montos FROM prestamos WHERE DATE(fprestamo)=curdate()";
		return ejecutarConsulta($sql);
	}
    public function totalpagoshoy()
	{
		$sql="SELECT IFNULL(SUM(cuota),0) as total_pagos FROM pagos WHERE DATE(fecha)=curdate()";
		return ejecutarConsulta($sql);
	}
    
	public function totalgastohoy()
	{
		$sql="SELECT IFNULL(SUM(gasto),0) as total_gasto FROM gastos WHERE DATE(fecha)=curdate()";
		return ejecutarConsulta($sql);
	}

	/*public function comprasultimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra) as total FROM ingreso GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function ventasultimos_12meses()
	{
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,SUM(total_venta) as total FROM venta GROUP by MONTH(fecha_hora) ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}*/
}

?>