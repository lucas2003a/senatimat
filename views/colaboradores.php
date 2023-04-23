<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
  header('Location:../index.php');
}
?>
<!doctype html>
<html lang="es">

<head>
  <title>Colaboradores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Iconos de Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <!--ÌCONOS FONTAWESOME-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Lightbox CSS -->
  <link rel="stylesheet" href="../dist/lightbox2/src/css/lightbox.css">

</head>

<body>
  
  <!-- Modal trigger button -->


  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="table-responsibe">
          <table class="table table-striped table-sm" id="tabla-colaboradores">
            <thead>
              <h1>Tabla de colaboradores</h1>
              <tr>
                <th>#</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Cargo</th>
                <th>Sede</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Tipo contrato</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <footer>
              <div class="row">
                <div class="col-md-4">
                  <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modal-colaborador">
                    <i class="bi bi-person-vcard-fill">Registro colaboradores</i></button>
                </div>
                <div class="col-md-4">
                  <a href="estudiantes.php" class="btn btn-outline-success"><i class="bi bi-person-vcard">Estudiantes</i></a>
                </div>
                <div class="col-md-4"> 
                  <a href="../controllers/usuario.controller.php?operacion=finalizar" stye="text-decoration: none" class="btn btn-outline-danger"><i class="bi bi-box-arrow-left">Cerrar sesión</i></a>
                </div>
              </div> 
            </footer>
          </table>
        </div>    
      </div>    
    </div>        
  </div>
  
  <!-- Modal Body -->
  <div class="modal fade" id="modal-colaborador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro de colaboradores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="" autocomplete="off" id="formulario-colaboradores" enctype="multipart/form-data">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="cargo" class="form-label">Cargo:</label>
                <select name="cargo" id="cargo" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control form-control-sm" id="telefono">
              </div>
              <div class="mb-3 col-md-6">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control form-control-sm" id="direccion">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="tipocontrato" class="form-label">Tipo contrato:</label>
                <select name="escuela" id="tipocontrato" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="C">Completo</option>
                  <option value="P">Parcial</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="cv" class="form-label">Curriculum Vitae:</label>
                <input type="file" id="cv" accept=".pdf" class="form-control form-control-sm">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>Cerrar</button>
          <button type="button" class="btn btn-outline-succes btn-sm" id="guardar-colaborador"><i class="fa-solid fa-floppy-disk"></i>Guadar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Lightbox JS -->
  <script src="../dist/lightbox2/src/js/lightbox.js"></script>

  <script>
    $(document).ready(function (){
      
      let datosNuevos = true;
      let idcolaboradoractualizar = -1;

      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#sede").html(result);
          }
        });
      }

      function obtenerCargos(){
        $.ajax({
          url: '../controllers/cargo.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function (result){
            $("#cargo").html(result);
          }
        });
      }

      function registrarColaborador(){
        //Enviaremos los datos dentro de un OBJETO
        var formData = new FormData();

        formData.append("operacion", "registrar");
        formData.append("apellidos", $("#apellidos").val());
        formData.append("nombres", $("#nombres").val());
        formData.append("idcargo", $("#cargo").val());
        formData.append("idsede", $("#sede").val());
        formData.append("telefono", $("#telefono").val());
        formData.append("direccion", $("#direccion").val());
        formData.append("tipocontrato", $("#tipocontrato").val());
        formData.append("cv", $("#cv")[0].files[0]);

        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(){
            $("#formulario-colaboradores")[0].reset();
            $("#modal-colaborador").modal("hide");
            Swal.fire({
              position: 'midle-center',
              icon: 'success',
              title: 'Accion exitosa',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }

      function preguntarRegistro(){
        Swal.fire({
          icon: 'question',
          title: 'Colaboradores',
          text: '¿Está seguro de registrar al colaborador?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#3498DB',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando acción del usuario
          if (result.isConfirmed){
            registrarColaborador();
          }
        });
      }
       $("#guardar-colaborador").click(preguntarRegistro);

      function mostrarColaboradores(){
        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-colaboradores tbody").html(result);
          }
        });
      }

    
      //Al cambiar una escuela, se actualizará las carreras

      //eliminar
      $("#tabla-colaboradores tbody").on("click",".eliminar",function(){
        const idcolaboradorEliminar = $(this).data("idcolaborador");
        Swal.fire({
          title: '¿Estás seguro de eliminarlo?',
          text: "El cambio no será reversible!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, si quiero!',
          cancelButtonText:'No, no quiero'
        }).then((result) => {
          if (result.isConfirmed) {
          $.ajax({
            url :'../controllers/colaborador.controller.php', 
            type :'POST',
            data : {
              operacion    :'eliminar',
              idcolaborador: idcolaboradorEliminar
            },
            success : function(result){
              if (result == ""){
                mostrarColaboradores();
              }
            }
          });
        }
      });
    }); 
      //Predeterminamos un control dentro del modal
      $("#modal-colaborador").on("shown.bs.modal", event => {
        $("#apellidos").focus();

        obtenerSedes();
        obtenerCargos();
      });

      //Funciones de carga automática
      mostrarColaboradores();

    });
  </script>

</body>

</html>