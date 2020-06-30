<?php 
require_once "../modelos/Clientes.php";

$cliente=new Clientes();

$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$cedula=isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($idcliente)){
			$rspta=$cliente->insertar($cedula,$nombre,$direccion,$telefono);
			echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
		}
		else {
			$rspta=$cliente->editar($idcliente,$cedula,$nombre,$direccion,$telefono);
			echo $rspta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$cliente->desactivar($idcliente);
 		echo $rspta ? "Cliente Desactivado" : "Cliente no se puede desactivar";
	break;

	case 'activar':
		$rspta=$cliente->activar($idcliente);
 		echo $rspta ? "Cliente activado" : "Cliente no se puede activar";
	break;
        
	case 'mostrar':
		$rspta=$cliente->mostrar($idcliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cliente->listar($idcliente);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->cedula,
 				"2"=>$reg->nombre,
 			    "3"=>$reg->direccion,
 				"4"=>$reg->telefono,
                "5"=>($reg->estado)?'<span class="label bg-primary">Activado</span>':'<span class="bg-warning">Desactivado</span>');
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>