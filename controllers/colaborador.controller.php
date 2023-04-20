<?php

require_once '../models/Colaborador.php';

if ($_POST['operacion']){

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
                
                $datosColaborador = $registro['apellidos']  .   '   '   .   $registro['nombres'];

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
                            <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-danger btn-sm eliminar'><i class='fa-solid fa-trash-can'></i></a>
                            <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-info btn-sm editar'><i class='fa-solid fa-pencil'></i></a>";
                if ($registro['cv'] == ''){
                    echo $botonNulo;
                }else{
                    echo "<a href='../pdf/documents/{$registro['cv']} data-lightbox='{$registro['idcolaborador']}' data-title='{$datosColaborador}'' class='btn btn-sm btn-warning' target='_blank'><i class='fa-solid fa-file'></i></a>";
                }
                    
                echo"
                    </td>
                </tr>
                ";
            
                $numeroFila++;
            }    
        }
        
    }

    if ($_POST['operacion'] == 'obtener_cv'){} 
}