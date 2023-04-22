<?php

require_once 'Conexxion.php';

class Usuario extends Conexion{
    private $accesoBD;

    public function __CONSTRUCT(){
        $this->accesoBD = parent::getConexion();
    }

    public function iniciarSesion($nombreUsuario =""){
        try{
            $consulta = $this->accesoBD->prepare("CALL spu_usuarios_login(?)");
            $consulta->execute(array($nombreUsuario));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function registrarUsuario($datos = []){
        try{
            $consulta = $this->accesoBD->prepare("CALL usuario_registrar(?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['nombreusuario'],
                    $datos['claveacceso'],
                    $datos['apellidos'],
                    $datos['nombre'],
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}