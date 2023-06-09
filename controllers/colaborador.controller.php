<?php

require_once '../models/Colaborador.php';

if (isset($_POST['operacion'])){

    $colaborador = new Colaborador();

    if ($_POST['operacion'] == 'registrar'){
        $datosGuardar = [
            "apellidos"     =>  $_POST['apellidos'],
            "nombres"       =>  $_POST['nombres'],
            "idcargo"       =>  $_POST['idcargo'],
            "idsede"        =>  $_POST['idsede'],
            "telefono"      =>  $_POST['telefono'],
            "direccion"     =>  $_POST['direccion'],
            "tipocontrato"  =>  $_POST['tipocontrato'],
            "cv"            =>  ''
        ];

        if (isset($_FILES['cv'])){

            $rutaDestino = '../views/pdf/documents/';
            $fechaActual = date('c');
            $nombreArchivo = sha1($fechaActual) .   ".pdf";
            $rutaDestino .= $nombreArchivo;


            if (move_uploaded_file($_FILES['cv']['tmp_name'],$rutaDestino)){
                $datosGuardar['cv'] = $nombreArchivo;
            }
        }

        $colaborador->registrarColaborador($datosGuardar);
    }


    if ($_POST['operacion'] == 'listar'){
        $data = $colaborador->listarColaborador();
         if ($data){
            $numeroFila = 1;
            $datosColaborador = '';

            $botonNulo = "<a href='#' class='btn btn-sm bt-warning' title ='No tinene CV'><i class='fa-solid fa-file-excel'></i></a>"; 
            
            foreach($data as $registro){
                
                $datosColaborador = $registro['apellidos']  . ' ' .   $registro['nombres'];

                echo"
                    <tr>
                        <td>{$numeroFila}</td>
                        <td>{$registro['apellidos']}</td>
                        <td>{$registro['nombres']}</td>
                        <td>{$registro['cargo']}</td>
                        <td>{$registro['sede']}</td>
                        <td>{$registro['telefono']}</td>
                        <td>{$registro['direccion']}</td>
                        <td>{$registro['tipocontrato']}</td>
                        <td>
                            <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-danger btn-sm eliminar'><i class='fa-solid fa-trash-can'></i></a>";
                if ($registro['cv'] == ''){
                    echo $botonNulo;
                }else{
                    echo "  <a href='../views/pdf/documents/{$registro['cv']}' target='_blank' class='btn btn-warning btn-sm'><i class='bi bi-filetype-pdf'></i></a>";
                }
                    
                echo"
                    </td>
                </tr>
                ";
            
                $numeroFila++;
            }    
        }
        
    }

    if ($_POST['operacion'] == 'obtener_cv'){

            $idcolaborador = $_POST['idcolaborador'];

            $archivoCv = $colaborador->obtenerColaborador($idcolaborador);
            
            echo $archivoCv;
    }

    if ($_POST['operacion'] == 'eliminar'){

        $idcolaborador =  $_POST['idcolaborador'];

        $registro = $colaborador->obtenerColaborador($idcolaborador);
        
        
        if ($registro['cv']) {
            $rutaArchivo = '../views/pdf/documents/' . $registro['cv'];

            if (file_exists($rutaArchivo))  {

                unlink($rutaArchivo);
            }
        }
        $colaborador->eliminarColaborador($idcolaborador);
    }

    if ($_POST['operacion'] == 'obtenerColaborador'){
        $registro = $colaborador->getColaborador($_POST['idcolaborador']);
        echo json_encode($registro);
    }

}