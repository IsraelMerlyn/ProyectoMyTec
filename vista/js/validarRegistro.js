// VALIDAR USUARIO EXISTENTE

var usuarioExistente = false;
var emailExistente = false;

$("#usuarioRegistro").change(function() {
  var usuario = $("#usuarioRegistro").val();

  var datos = new FormData();
  datos.append("validarUsuario", usuario);

  $.ajax({
    url: "vista/modulos/ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      if (respuesta == 0) {
        console.dir(respuesta);
        $("label[for='usuarioRegistro'] span").html("<p> ¡Nombre de Usuario no Disponibleb !</p>"  
        ); 
        usuarioExistente = true;

      } else {
        console.dir(respuesta);

        $("label[for='usuarioRegistro'] span").html("<p>Nombre de usuario Disponible</p>"
        );

        usuarioExistente = false;
      }
    }
  });
});

// VALIDAR CORREO ELECTRÓNICO EXISTENTE

$("#emailRegistro").change(function() {
  var email = $("#emailRegistro").val();

  var datos = new FormData();
  datos.append("validarEmail", email);

  $.ajax({
    url: "vista/modulos/ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      if (respuesta == 0) {
        console.dir(respuesta);
        $("label[for='emailRegistro'] span").html("<p>! El correo electrónico ya existe ¡</p>");
        emailExistente = true;
    } else {
        console.dir(respuesta);

        $("label[for='emailRegistro'] span").html("");
        emailExistente = false;
      }
    }
  });
});

//$.getScript("ajax/validaciones.js");

//FUNCION           PARA        VALIDAR            REGISGTROS

//retornará un valor booleano true o false ---> si es true continua el registro  pero si es false envia e

function validarRegistro() {
  var usuario = document.querySelector("#usuarioRegistro").value;
  var nombre = document.querySelector("#nombreRegistro").value;
  var email = document.querySelector("#emailRegistro").value;
  var password = document.querySelector("#passwordRegistro").value;
  var password2 = document.querySelector("#password2Registro").value;
  var condiciones = document.querySelector("#condicionesRegistro").checked;
 

  //VALIDANDO USUARIO

  if (usuario != "") {
    var letras = usuario.length;
    var expre_reg = /^[a-zA-Z0-9]*$/;
    if (letras > 15) {
      document.querySelector("label[for='usuarioRegistro']").innerHTML +=
        "<br>Escribir menos de 15 caracteres.";
      return false;
    }
    if (!expre_reg.test(usuario)) {
      document.querySelector("label[for='usuarioRegistro']").innerHTML +=
        "<br>No escriba caracteres especiales";
      return false;
    }
    if(usuarioExistente){
      $("label[for='usuarioRegistro'] span").html("<p> ¡Nombre de Usuario no Disponibleb !</p>"  
      ); 
      return false;

    }
  }
   //VALIDANDO CONTRASEÑA

   if (password != "") {
    var letras = password.length;
    var expre_reg = /^[a-zA-Z0-9]*$/;
    if (letras < 6) {
      document.querySelector("label[for='passwordRegistro']").innerHTML +=
        "<br>Escribir mas de 6 caracteres.";
      return false;
    }
    if (!expre_reg.test(password)) {
      document.querySelector("label[for='passwordRegistro']").innerHTML +=
        "<br>Contraseña debe incluir mayúscula";
      return false;
    }
  }

     //VALIDANDO  CONFIRMACION DE CONTRASEÑA

    
     if (password != password2 ) {     
      
        document.querySelector("label[for='password2Registro']").innerHTML +=
          "<br>No coinciden las Contraseñas.";

        return false;
      

     }
   //VALIDANDO CORREO ELECTRÓNICO

   if (email != "") {
    var expre_reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        if (!expre_reg.test(email)) {
      document.querySelector("label[for='emailRegistro']").innerHTML +=
        "<br>Escriba corrrectamente el correo electrónico";
      return false;
    }
    if(emailExistente){
      $("label[for='emailRegistro'] span").html("<p>! El correo electrónico ya existe ¡</p>" ); 
      return false;

    }
  }
     //VALIDANDO TÉRMINOS Y CONDICIONES

     if (!condiciones) {

      document.querySelector("label[for='condicionesRegistro']").innerHTML +=
      "<br>Es necesario aceptar los terminos de condiciones";
      var usuario = document.querySelector("#usuarioRegistro").value=usuario;
      var nombre = document.querySelector("#nombreRegistro").value=nombre;
      var email = document.querySelector("#emailRegistro").value=email;
      var password = document.querySelector("#passwordRegistro").value=password;


        return false;
      }
    
  


  return true;
}
