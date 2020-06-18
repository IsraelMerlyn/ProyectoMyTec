<?php
    class Paginas{

        public function enlacesPaginasModelo($enlaces){

            if ($enlaces == "login" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir"){

                $modulo = "vista/modulos/".$enlaces.".php";
                
            }
            else if($enlaces == "index"){

                $modulo =  "vista/modulos/login.php";
            
            }
    
            else if($enlaces == "ok"){
    
                $modulo =  "vista/modulos/login.php";
            
            }
            else if($enlaces == "existe"){
    
                $modulo =  "vista/modulos/login.php";
            
            }
            else if($enlaces == "cambio"){
    
                $modulo =  "vista/modulos/usuarios.php";
            
            }
    
            else if($enlaces == "fallo"){
    
                $modulo =  "vista/modulos/login.php";
            
            }
            else if($enlaces == "fallo5intentos"){
    
                $modulo =  "vista/modulos/login.php";
            
            }
    
            else{
    
                $modulo =  "vista/modulos/login.php";
    
            }
            
            return $modulo;
            

        }
    }
?>