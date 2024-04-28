<?php

session_start();
if ($_SESSION['acceso'] == 'acceso') {


    include("../config/database.php");
    
    $hora_salida = $_POST['horasalida'];
    $hora_llegada = $_POST['horallegada'];
    $ruta= $_POST['select_ruta'];

    $consulta = "CALL SP_insertarHorario(' $hora_salida','$hora_llegada','$ruta');";

    $alertas = mysqli_query($conectar,$consulta);
      while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
      }
      $id = $conectar->insert_id; 
    header("location:index_horarios.php");  
  } else {
    header("location: ../error.php");
 }

?>

