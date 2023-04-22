<?php
session_start();

require_once '../models/Usuario.php';

if  (isset($_POST['operacion'])){
    
    $usuario = new Usuario();

    if ($_POST['operacion'] == 'login'){

        $registro = $usuario->iniciarSesion($_POST['nombreusuario']);

        $_SESSION["login"] = false;
        
        //Objeto par obtener el resultado
        $resultado = [
            "status"  => false,
            "mensaje"  => ""
        ];

        if ($registro){
            //EL usuario si existe
            $claveEncriptada = $registro["claveacceso"];

            //Validar contraseña
            if (password_verify($_POST['claveIngresada'],
            $claveEncriptada)){
                $resultado["status"] = true;
                $resultado["mensaje"] = "Bienvenido al sistema";
                $_SESSION["login"] = true;
            }else{
                $resultado["mensaje"] = "error en la contraseña";
            }
        }else{
            //El usuario no existe
            $resultado["mensaje"] = "No encontramos el usuario";
        }
        //Enviamos el obeto resultado a la vista
        echo json_encode($resultado);

    }

    if ($_POST['operacion'] == 'registrar'){

        $datosForm = [
            "nombreusuario"     =>  $_POST['nombreusuario'],
            "claveacceso"       =>  $_POST['claveacceso'],
            "apellidos"         =>  $_POST['apellidos'],
            "nombres"           =>  $_POST['nombres']
        ];

        $usuario->registrarUsuario($datosForm);
    }

}

if (isset($_GET['operacion'])){
    if ($_GET['operacion'] == 'finalizar'){
        session_destroy();
        session_unset();
        header('location:..index.php');
    }
}
