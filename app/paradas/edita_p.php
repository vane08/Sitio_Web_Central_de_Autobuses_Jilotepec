<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {
require '../config/database.php';
$nombre_parada = $conectar->real_escape_string($_POST['nombre_p']);
$id_parada = $conectar->real_escape_string($_POST['id']);
$ruta = $conectar->real_escape_string($_POST['select_ruta-parada']);


$sql = "CALL SP_actualizar_parada($id_parada, '$nombre_parada',$ruta);";



$mensaje = mysqli_query($conectar, $sql);

    while ($fila = mysqli_fetch_array($mensaje, MYSQLI_ASSOC)) {
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
        
    }

   
    
header('Location: index_paradas.php');
} else {
    header("location: ../error.php");
}
