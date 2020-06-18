<?php
    require_once ("../../controlador/controlador.php");
    require_once ("../../modelo/crud.php");

    class Ajax{

        public $validarUsuario;
        public $validarEmail;
        public function validarUsuarioAjax(){
            
            $datos = $this->validarUsuario;


            $respuesta = MvcControlador::validarUsuarioControlador($datos);
            
            echo $respuesta;
            //echo $datos;
        }
        public function validarEmailAjax(){
            
            $datos = $this->validarEmail;

            $respuesta = MvcControlador::validarEmailControlador($datos);
            
            echo $respuesta;
            //echo $datos;
        }
    }

    if(isset($_POST["validarUsuario"])){

        $a = new Ajax();
        $a->validarUsuario = $_POST["validarUsuario"];
        $a->validarUsuarioAjax();
        
    }

    if(isset($_POST["validarEmail"])){
        $correo = new Ajax();
        $correo->validarEmail = $_POST["validarEmail"];
        $correo->validarEmailAjax();

    }