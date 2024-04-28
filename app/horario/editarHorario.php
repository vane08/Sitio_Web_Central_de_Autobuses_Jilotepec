<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {



   include("../config/database.php");

   
   $id_horario = $conectar->real_escape_string($_POST['idHorario']);
   $hora_salida =  $conectar->real_escape_string($_POST['horasalida']);
   $hora_llegada =  $conectar->real_escape_string($_POST['horallegada']);
   $ruta =  $conectar->real_escape_string($_POST['select_ruta']);

  $consulta = "CALL  SP_actualizarHorario(' $id_horario','$hora_salida','$hora_llegada','$ruta');";

  $alertas = mysqli_query($conectar,$consulta);
      while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
      }
   header('Location: index_horarios.php');
} else {
   header("location: ../error.php");
}
?>
