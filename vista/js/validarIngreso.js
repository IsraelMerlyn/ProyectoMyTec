//FUNCION           PARA        VALIDAR            REGISGTROS

//retornará un valor booleano true o false ---> si es true continua el registro  pero si es false envia e

function validarIngreso() {
    var usuario = document.querySelector("#usuarioIngreso").value;
    var password = document.querySelector("#passwordIngreso").value;
     var recordar = document.querySelector("#recordar").checked;

     //VALIDANDO USUARIO
  
    if (usuario != "") {
      var letras = usuario.length;
      var expre_reg = /^[a-zA-Z0-9]*$/;

      if (!expre_reg.test(usuario)) {
        document.querySelector("label[for='usuarioIngreso']").innerHTML +=
          "<br>No escriba caracteres especiales";
        return false;
      }
    }
     //VALIDANDO CONTRASEÑA
  
     if (password != "") {
      var letras = password.length;
      var expre_reg = /^[a-zA-Z0-9]*$/;
      if (letras < 6) {
        document.querySelector("label[for='passwordIngreso']").innerHTML +=
          "<br>Escribir mas de 6 caracteres.";
        return false;
      }
      if (!expre_reg.test(password)) {
        document.querySelector("label[for='passwordIngreso']").innerHTML +=
          "<br>Contraseña debe incluir mayúscula";
        return false;
      }
    }
  
    
  
 
       //VALIDANDO RECORDAR CONTRASEÑA
  
    //    if (!recordar) {
  
    //     document.querySelector("label[for='recordar']").innerHTML +=
    //     "<br>Es necesario aceptar los terminos de condiciones";
    //     var usuario = document.querySelector("#usuarioRegistro").value=usuario;
    //     var nombre = document.querySelector("#nombreRegistro").value=nombre;
    //     var email = document.querySelector("#emailRegistro").value=email;
    //     var password = document.querySelector("#passwordRegistro").value=password;
  
  
    //       return false;
    //     }
      
    
  
  
    return true;
  }
  