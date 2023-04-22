<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login']){
  header('Location:views/index.php');
}
?>
<!doctype html>
<html lang="es">

<head>
  <title>Bienvenido</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-3"></div>
      <div class="col-md-6 ">
        <!--INICIO DE CARD-->
        <div class="card">
          <div class="card-header bg-primary text-light text-center">
            <strong>inicio de Sesión</strong>
          </div>
          <div class="card-body">
            <form action="">
              <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" class="form-control form-control-sm" autfocus>
              </div>
              <div class="mb-3">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" id="clave" class="form-control form-control-sm">
              </div>
            </form>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-sm btn-success" id="iniciar-sesion">iniciar sesion:</button>
          </div>
        </div>
        <!-- FIN DE CARD-->
      </div>
      <div class="col-md-3"></div> 
    </div>
  </diiv>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>  

  <script>
    $(document).ready(function(){

      function iniciarSesion(){
        const usuario = $("#usuario").val();
        const clave = $("#clave").val();

        if (usuario !="" && clave != ""){
          $.ajax({
            url : '../controllers/usuario.controller.php',
            type : 'POST',
            data : {
              operacion     :   'login',
              nombreusuario :   usuario,
              claveIngresada:   clave
            },
            dataType :  'JSON',
            success  : function (result){
              console.log(result);
              if (result["status"]){
                window.location.href ="views/colaborador.php";
              }else{
                alert(result["mensaje"]);
              }
            }
          });
        }
      }
      $("#iniciar-sesion").click(iniciarSesion);
    })
  </script>
</body>

</html>