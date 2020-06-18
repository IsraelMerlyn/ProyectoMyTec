<?php

    class MvcControlador{

        public function pagina(){
            
            include "vista/principal.php";
        }
        // ====================================================================
        # METODO PARA DIRECCIONAR PAGINAS MEDIANTE MVC

        public function enlacesPaginasControlador(){

            if(isset($_GET['action'])){
                
                $enlace = $_GET['action'];
            }

            else{

                $enlace = "index";

            }
            
            $respuesta = Paginas::enlacesPaginasModelo($enlace);

            include $respuesta;
        }
        // ====================================================================
        # METODO PARA REGISTRO DE USUARIOS

        public function registroUsuarioControlador(){
            

            if(isset($_POST["usuarioRegistro"])){

               # preg_match realiza una comparacion con expresion regulares
               if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["usuarioRegistro"]) &&
               preg_match('/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/',$_POST["nombreRegistro"])&&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["emailRegistro"])&&
               preg_match('/^[a-zA-Z0-9]+$/',$_POST["passwordRegistro"])){
                
               #incriptamos la contraseña ingresada por input
              // $encriptar = hash('sha512',$_POST["passwordRegistro"]);
               //$encriptar=password_hash($_POST["passwordRegistro"],PASSWORD_DEFAULT);


               
                $datosControlador = array(  "usuario" => $_POST["usuarioRegistro"],
                                            "nombre" => $_POST["nombreRegistro"],
                                            "email" => $_POST["emailRegistro"],
                                            "password" =>$_POST["passwordRegistro"]);

               // $nombreUsuario = array("usuario" => $_POST["usuarioRegistro"]);

                $consultaUsuario = Datos::registroUsuarioExisteModelo($datosControlador,"usuarios");
                //var_dump("resultado --> ",$consultaUsuario);

                if($consultaUsuario == "noExiste"){

                    $respuesta = Datos::registroUsuarioModelo($datosControlador,"usuarios");

                    if($respuesta == "success"){
                        header("location:ok");
                    //header("location:index.php?action=ok");
                    //header("location:index.php?action=ok#signup-agile");
    
                    }else{
                    header("location:index.php");
                    }

                }else{
                    header("location:existe");
                   // header("location:index.php?action=existe");
                }

                }         

            

        }

    }
        // ====================================================================
        #METODO PARA INGRESAR AL SISTEMA POR LOGIN 

        public function ingresoUsuarioControlador(){
            try {
                if(isset($_POST["usuarioIngreso"])){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioIngreso"])&&
                    preg_match('/^[a-zA-Z0-9]+$/',$_POST["passwordIngreso"])){
    
                    #incriptamos la contraseña ingresada por input
                   // $encriptar = hash('sha512',$_POST["passwordIngreso"]);
                   //$encriptar=password_hash($_POST["passwordIngreso"],PASSWORD_DEFAULT);

    
                        
                        $datosControlador = array(  "usuario" => $_POST["usuarioIngreso"],
                                                     "password" => $_POST["passwordIngreso"]);
                                                     
                        $respuesta = Datos::ingresoUsuarioModelo($datosControlador,"usuarios");

                        $intentos = $respuesta["falla"];
                        $nombreUsuario = $_POST["usuarioIngreso"];
                        $limiteFalla =3;
                        if($intentos < $limiteFalla){

                       
    
                        if($respuesta["usuario"]==$_POST["usuarioIngreso"] && $respuesta["password"]==$_POST["passwordIngreso"]){
                        //var_dump($respuesta);
                        session_start();
    
                        $_SESSION["validar"] = true;

                        $intentos=0;

                        $controlarIntentos = array("usuarioActual"=>$nombreUsuario,"actualizarIntentos"=>$intentos);
                            
                        $respuestaFallas = Datos::intentosUsuarioModelo($controlarIntentos,"usuarios");
                        
                        header("location:usuarios");
    
                        //header("location:index.php?action=usuarios");
    
                        }else{
                            ++$intentos;

                            $controlarIntentos = array("usuarioActual"=>$nombreUsuario,"actualizarIntentos"=>$intentos);
                            
                            $respuestaFallas = Datos::intentosUsuarioModelo($controlarIntentos,"usuarios");
                             
                        header("location:fallo");
                        //header("location:index.php?action=fallo");
                        }
                    }else{
                        $intentos=0;

                        $controlarIntentos = array("usuarioActual"=>$nombreUsuario,"actualizarIntentos"=>$intentos);
                            
                        $respuestaFallas = Datos::intentosUsuarioModelo($controlarIntentos,"usuarios");
                             
                        header("location:fallo5intentos");
                        //header("location:index.php?action=fallo5intentos");

                    }
                    }
    
    
                }
            }
            catch( PDOException $Exception ) {
                // Note The Typecast To An Integer!
                throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
            }

 

        }

        // ====================================================================

        #METODO PARA LISTAR USUARIOS EN TABLA

        public function vistaUsuariosControlador(){

            $respuesta = Datos::vistaUsuariosModelo("usuarios");

            foreach($respuesta as $row => $item){
                
                echo    '<tr>
                                <td>'.$item["id"].'</td>
                                <td>'.$item["usuario"].'</td>
                                <td>'.$item["nombre"].'</td>
                                <td>'.$item["email"].'</td>
                                <td>'.$item["password"].'</td>
                                <td><a class="btn btn-warning" href="index.php?action=editar&id='.$item["id"].'">Editar</a></td>

                                <td>
                                <a class="btn btn-danger" onclick="javascript:return confirm("¿Seguro de eliminar este registro?");" href="index.php?action=usuarios&idBorrar='.$item["id"].'">Borrar</a>
                                </td>
                        

                           
                        
                        </tr>';
            }
        }

        
	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioControlador(){

		$datosControlador = $_GET["id"];
		$respuesta = Datos::editarUsuarioModelo($datosControlador, "usuarios");

        echo'<input type="hidden" value="'.$respuesta["id"].'"class="form-control" name="idEditar">
            <div class="form-group">
            <label>Usuario</label>
            <input type="text" value="'.$respuesta["usuario"].'"class="form-control" maxlength="15" minlength="3" name="usuarioEditar" required>
            </div>
            <div class="form-group">
            <label>Nombre y Apellido</label>
            <input type="text" value="'.$respuesta["nombre"].'"class="form-control" name="nombreEditar" required>
            </div>
            <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" value="'.$respuesta["email"].'"class="form-control" name="emailEditar" required>
            </div>
            <div class="form-group">
            <label>Contraseña</label>
            <input type="text" value="'.$respuesta["password"].'"class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="passwordEditar" required>
            </div>';

            // <input type="submit" value="Actualizar">';
            

   }

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioControlador(){
     
		if(isset($_POST["usuarioEditar"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"]) &&
            preg_match('/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/', $_POST["nombreEditar"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])&&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"])){

            
            //$encriptar = crypt($_POST["passwordEditar"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            #incriptamos la contraseña ingresada por input

			$datosControlador = array( "id"=>$_POST["idEditar"],
                                      "usuario"=>$_POST["usuarioEditar"],
                                      "nombre"=>$_POST["nombreEditar"],
                                      "email"=>$_POST["emailEditar"],
                                      "password"=>$_POST["passwordEditar"]);
			
			$respuesta = Datos::actualizarUsuarioModelo($datosControlador, "usuarios");

			if($respuesta == "success"){

                header("location:cambio");
               // header("location:index.php?action=cambio");

			}

			else{

				echo "error";
            }
			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioControlador(){

		if(isset($_GET["idBorrar"])){

			$datosControlador = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarUsuarioModelo($datosControlador, "usuarios");

			if($respuesta == "success"){
                header("location:usuarios");
                //header("location:index.php?action=usuarios");
			
			}

		}

    }

    #VALIDAR USUARIO EXISTENTE
	#------------------------------------
	public function  validarUsuarioControlador($validarUsuario){

        $datosControlador = $validarUsuario;

        $respuesta =Datos::validarUsuarioModelo($datosControlador,"usuarios");
        //verificamos si trae caracteres
        if(!empty($respuesta["usuario"])){
            //si trae caracteres
            echo 0;
        }else{
            //no hay coincidencias
            echo 1;
        }


    
    }
        #VALIDAR CORREO ELECTRÓNICO EXISTENTE
	#------------------------------------
	public function  validarEmailControlador($validarEmail){

        $datosControlador = $validarEmail;

        $respuesta =Datos::validarEmailModelo($datosControlador,"usuarios");
        //verificamos si trae caracteres
        if(!empty($respuesta["email"])){
            //si trae caracteres
            echo 0;
        }else{
            //no hay coincidencias
            echo 1;
        }


    
    }



        
    }

?>