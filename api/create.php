<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../Entity/obstruccion.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Obstruccion($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->getSingleObstruccion();
    if ($item->name != null) {
        // existe la obstruccion
        $item->incidencia++;
        if($item->updateObstruccion()){
            echo 'Obstruccion created successfully.';
        } else{
            echo 'Obstruccion could not be created.';
        }
    } else {
        $item->calle_id = $data->calle_id;
        $item->altura = $data->altura;
        $item->motivo = $data->motivo;
        $item->temporalidad = $data->temporalidad;
        $item->incidencia = $data->incidencia;
        $item->longitud = $data->longitud;
        $item->latitud = $data->latitud;
        
        if($item->createObstruccion()){
            echo 'Obstruccion created successfully.';
        } else{
            echo 'Obstruccion could not be created.';
        }
    }