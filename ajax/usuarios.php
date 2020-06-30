<?php 
session_start(); 
require_once "../modelos/Usuarios.php";

$usuarios=new Usuarios();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
        
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);
        
		if (empty($idusuario)){
			$rspta=$usuarios->insertar($nombre,$direccion,$telefono,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "Usuario no se pudo registrar";
		}
		else {
			$rspta=$usuarios->editar($idusuario,$nombre,$direccion,$telefono,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuarios->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuarios->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;
        
	case 'mostrar':
		$rspta=$usuarios->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

case 'listar':
		$rspta=$usuarios->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->direccion,
 				"3"=>$reg->telefono,
 				"4"=>$reg->login,
 				"5"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->estado)?'<span class="label bg-primary">Activado</span>':'<span class="label bg-danger">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
    
    case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permisos();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuarios->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->permiso.'</li>';
				}
	break;
        
        case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuarios->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuarios->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['Escritorio']=1:$_SESSION['Escritorio']=0;
			in_array(2,$valores)?$_SESSION['Clientes']=1:$_SESSION['Clientes']=0;
			in_array(3,$valores)?$_SESSION['Prestamos']=1:$_SESSION['Prestamos']=0;
			in_array(4,$valores)?$_SESSION['Pagos']=1:$_SESSION['Pagos']=0;
			in_array(5,$valores)?$_SESSION['Usuarios']=1:$_SESSION['Usuarios']=0;
			in_array(6,$valores)?$_SESSION['Gastos']=1:$_SESSION['Gastos']=0;
			in_array(7,$valores)?$_SESSION['Consultas']=1:$_SESSION['Consultas']=0;

	    }
	    echo json_encode($fetch);
	break;
        
        case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al loginPrestamos
        header("Location: ../index.php");

	break;
}
?>