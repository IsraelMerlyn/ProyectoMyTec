<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Iniciar sesión | Regístrarse</title>
<link rel="icon" type="image/png" href="vista/images/favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!---<meta name="keywords" content="stylish Sign in and Sign up Form A Flat Responsive widget, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />--->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--online_fonts-->
	<link href="//fonts.googleapis.com/css?family=Sansita:400,400i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<!--//online_fonts-->
	<link href="vista/css/estilo.css" rel='stylesheet' type='text/css' media="all" /><!--stylesheet-->
</head>
<body>
<h1>Datos de Usuario</h1>
<div class="form-w3ls">
<!---	<div class="form-head-w3l">
		<h2>MyTec</h2>
	</div>-->
    <ul class="tab-group cl-effect-4">
        <!---<li class="tab active"><a href="#signin-agile">Entrar</a></li>--->
		    <!---<li class="tab"><a href="#signup-agile">Registrarse</a></li>--->
    </ul>
    <div class="tab-content">
        <div id="signin-agile">   
			<form action="" method="post" onsubmit="return validarIngreso()">
				
				<p><label for="usuarioIngreso">Usuario</label></p>
				<input type="text" name="usuarioIngreso" id="usuarioIngreso" placeholder="Nombre de Usuario" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Name';}" required="required">
				<p><label for="passwordIngreso">Contraseña</label></p>
				<input type="password" name="passwordIngreso" id="passwordIngreso" placeholder="Incluir Minúsculas - Mayúsculas y Números" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="required">
				
				<input type="checkbox" id="recordar" value="">
				<label for="recordar"><span></span> Recordarme</label>
				
	 <!---   <input type="submit" class="sign-in" value="Iniciar Sesión">--->
	    <input type="submit" class="sign-in" value="Iniciar Sesión">
        <hr class="my-4"><br>
		</form>
      <!---  
	  
	  <div class="card-body">
        <form class="form-signin">
        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
        </form>  
      </div>      --->
			<?php
			if(isset($_GET["action"])){

			if($_GET["action"]=="existe"){

				echo "Ya existe el Usuario";
				
			}
			}
            if(isset($_GET["action"])){

                if($_GET["action"]=="ok"){

                    echo "Registro exitoso";
                                    
                }
            }
            if(isset($_GET["action"])){

                if($_GET["action"] == "fallo"){
            
                    echo "Falló al ingresar";
                
                }
            
			}
			if(isset($_GET["action"])){

				if($_GET["action"] == "fallo5intentos"){

					echo "haz fallado 3 veces por favor, ingrese correctamente";

				}

				}

            ?>
		</div>
		<div id="signup-agile">   
			<form action="" method="post" onsubmit="return validarRegistro()">	
				
			
				
				<p><label for="usuarioRegistro">Usuario<span></span></label></p>
				<input type="text" name="usuarioRegistro" id="usuarioRegistro" minlength="3" maxlength="15" placeholder="Minimo 3 - Máximo 15 caracteres" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nombre de Usuario';}" required="required">
				<p class="header">Nombre y Apellido</p>
				<input type="text" name="nombreRegistro" id="nombreRegistro" placeholder="Nombre y Apellido" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nombre y Apellido';}" required="required">
				<p><label for="emailRegistro">Correo Electrónico<span></span></label></p>
				<input type="email" name="emailRegistro" id="emailRegistro" placeholder="Escribe correo correctamente" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="required">
				
				<p><label for="passwordRegistro">Contraseña</label></p>
				<input type="password" name="passwordRegistro" id="passwordRegistro" placeholder="Incluir mayúscula - minúscula y Número" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Contraseña';}" required="required">
				
				<p><label for="password2Registro">Confirmar Contraseña</label></p>
				<input type="password" name="password2Registro" id="password2Registro" placeholder="Incluir mayúscula - minúscula y Número" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Contraseña';}" required="required">


				<input type="checkbox" id="condicionesRegistro" name="condicionesRegistro">
				<label for="condicionesRegistro"><span></span><a href="#" >Aceptar términos y condiciones</a></label>

				
				<input type="submit" class="register" value="Registrarse">
			</form>
		</div> 
    </div><!-- tab-content -->
</div> <!-- /form -->	  

<?php

    #INSTANCIAMOS LA CLASE MvcControlador

    $registro = new MvcControlador();
    $registro->registroUsuarioControlador();

    $ingreso = new MvcControlador();
    $ingreso->ingresoUsuarioControlador();

	
	
	

?>