<?php
/*session_start();

if (isset($_SESSION['login']) && $_SESSION['login']){
  header('Location:../');
}*/
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- ICONOS BOOTSTRAP-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">


</head>

<body>
  <header>
    <div class="container">
        <div class="row mt-3 ">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <!--inicio del Card-->
                <div class="card">
                    <div class="card-header bg-primary text-light text-center">
                        <strong>LISTAS</strong> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-start">
                              <a href="estudiantes.php" class="btn btn-outline-primary"><i class="bi bi-person-vcard">Estudiantes</i></a>  
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="colaboradores.php" class="btn btn-outline-success"><i class="bi bi-person-vcard-fill"></i>Colaboradores</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="../controllers/usuario.controller.php?operacion=finalizar" style="text-decoration: none" class="btn btn-outline-danger"><i class="bi bi-box-arrow-left">Cerrar sesión</i></a>
                    </div>
                </div>
            </div>
            <div class="col-mt-3"></div>
        </div>
    </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>