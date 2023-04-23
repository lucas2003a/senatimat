<?php

require_once 'Conexion.php';

class Colaborador extends Conexion{
    private $accesoBD;

    public function __CONSTRUCT(){
        $this->accesoBD = parent::getConexion();
    }

    public function registrarColaborador($datos =[]){
        try{  
            $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['apellidos'],
                    $datos['nombres'],
                    $datos['idcargo'],
                    $datos['idsede'],
                    $datos['telefono'],
                    $datos['direccion'],
                    $datos['tipocontrato'],
                    $datos['cv']
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function listarColaborador(){
        try{   
            $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_listar()");
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        }
        catch(Exception $e){
            die($e->getMessage());
        }

    }



    public function obtenerColaborador($idcolaborador = 0){
        try{
            $consulta = $this->accesoBD->prepare("CALL spu_obtener_cv(?)");
            $consulta->execute(array($idcolaborador));
            $registro = $consulta->fetch();

            return $registro;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function eliminarColaborador($idcolaborador = 0){
        try{

            $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_eliminar(?)");
            $consulta->execute(array($idcolaborador));

            return true;
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    } 

    public function getColaborador($idcolaborador = 0){
        try{
            $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_recuperar_id(?)");
            $consulta->execute(array($idcolaborador));
            
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }
}