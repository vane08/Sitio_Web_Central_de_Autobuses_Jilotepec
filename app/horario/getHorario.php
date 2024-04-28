<?php 
session_start();
if ($_SESSION['acceso'] == 'acceso') {


    include("../config/database.php");
    $id_horario = $conectar->real_escape_string($_POST['id_horario']);

    $consulta = "SELECT horario.id_horario, horario.hora_salida, horario.hora_llegada, horario.ruta FROM  horario 	
    WHERE horario.id_horario = $id_horario LIMIT 1";
    $resultado = $conectar ->query($consulta);
    $rows = $resultado->num_rows;

    $horario = [];
    if($rows > 0){
       $horario = $resultado->fetch_array();
    }
    echo json_encode($horario, JSON_UNESCAPED_UNICODE);
} else {
    header("location: ../error.php");
 }
