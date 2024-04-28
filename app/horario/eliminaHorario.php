<?php

session_start();
if ($_SESSION['acceso'] == 'acceso') {


    include("../config/database.php"); 

    $id_horario = $conectar->real_escape_string($_POST['idHorario']);

    $consulta = "CALL SP_eliminarHorario($id_horario);";

    $alertas = mysqli_query($conectar,$consulta);
      while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
      }
      header('Location: index_horarios.php');
    } else {
      header("location: ../error.php");
   }
