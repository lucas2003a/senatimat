<?php

require_once "Conexion.php";

class Usuario extends Conexion{

  private $accesoBD; //Conexión

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function iniciarSesion($nombreUsuario = ""){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_login(?)");
      $consulta->execute(array($nombreUsuario));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listarUsuarios(){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrarUsuario($datos = []){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_registrar(?,?,?,?)");
      $consulta->execute(
        array(
          $datos["nombreusuario"],
          $datos["claveacceso"],
          $datos["apellidos"],
          $datos["nombres"]
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }  
  
  public function eliminarUsuario($idusuario = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_eliminar(?)");
      $consulta->execute(array($idusuario));
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function getUsuario($idusuario = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_recuperar_id(?)");
      $consulta->execute(array($idusuario));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function actualizarUsuario($datos = []){
    try{
        $consulta = $this->accesoBD->prepare("CALL spu_usuarios_actualizar(?,?,?,?,?,?)");
        $consulta->execute(
          array(
            $datos["idusuario"],
            $datos["nombreusuario"],
            $datos["claveacceso"],
            $datos["apellidos"],
            $datos["nombres"],
            $datos["nivelacceso"]
            )
        );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}