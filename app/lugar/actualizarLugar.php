<?php

session_start();
if($_SESSION['acceso'] == 'acceso'){
 include("../config/database.php");

$nombre_lugar = $conectar->real_escape_string($_POST['nombreLugar']);
$id_lugar = $conectar->real_escape_string($_POST['idL']);

$consulta = "CALL  SP_actualizar_lugar('$id_lugar','$nombre_lugar');";

$alertas = mysqli_query($conectar,$consulta);
      while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
      }

header('Location: index_lugar.php');
}else{
  header ("location: ../error.php");
}
?>

