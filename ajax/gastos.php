<?php
require_once "../modelos/Gastos.php";

$gastos=new Gastos();

$idgasto=isset($_POST["idgasto"])? limpiarCadena($_POST["idgasto"]):"";
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$concepto=isset($_POST["concepto"])? limpiarCadena($_POST["concepto"]):"";
$gasto=isset($_POST["gasto"])? limpiarCadena($_POST["gasto"]):"";


switch($_GET["op"]){
        
   case 'guardaryeditar':
		if (empty($idgasto)){
			$rspta=$gastos->insertar($idusuario,$fecha,$concepto,$gasto);
			echo $rspta ? "Gasto registrado" : "Gasto no se pudo registrar";
		}
		else {
			$rspta=$gastos->editar($idgasto,$idusuario,$fecha,$concepto,$gasto);
			echo $rspta ? "Gasto actualizado" : "Gasto no se pudo actualizar";
		}
	break;
        
   case 'eliminar':
		$rspta=$gastos->eliminar($idgasto);
 		echo $rspta ? "Gasto Eliminado" : "Gasto no se puede eliminar";
	break;
        
    case 'mostrar':
        $rspta=$gastos->mostrar($idgasto);
        //Codificar el resultado con json
        echo json_encode($rspta);
    break;
        
    case 'listar':
        $rspta=$gastos->listar();
        //vamos a declarar un array
        $data= Array();
        
        while ($reg=$rspta->fetch_object()){
 			$data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idgasto.')"> <i class="fa fa-pencil"> </i></button>'.
 					 ' <button class="btn btn-danger" onclick="eliminar('.$reg->idgasto.')"> <i class="fa fa-trash"> </i></button>',
                "1"=>$reg->Usuario,
                "2"=>$reg->fecha,
                "3"=>$reg->concepto,
                "4"=>$reg->gasto 
            );
        }
        
        $results = array(
        "sEcho"=>1, //Informacion para el datatables
            "iTotalRecords"=>count($data), //Enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //Enviamos el total de registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
    break;
        
    case "selectUsuario":
        require_once "../modelos/Usuarios.php";
        $usuario = new Usuarios();
        
        $rspta = $usuario->select();
        
        while($reg = $rspta->fetch_object())
        {
            echo '<option value='.$reg->idusuario .'>'.$reg->nombre .'</option>';
        }
    break;
}

?>