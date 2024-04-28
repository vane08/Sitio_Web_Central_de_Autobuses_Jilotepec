<?php
session_start();
if($_SESSION['acceso'] == 'acceso'){


 include("../config/database.php"); 

$id_lugar = $conectar->real_escape_string($_POST['id_lugares']);

$consulta = "CALL SP_eliminar_lugar($id_lugar);";

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
