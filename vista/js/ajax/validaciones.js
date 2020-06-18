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
