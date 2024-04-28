<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {
require '../config/database.php';

$id_ruta = $conectar->real_escape_string($_POST['id_ruta']);

$sql = "call SP_eliminarRuta($id_ruta);";


$mensaje = mysqli_query($conectar, $sql);

    while ($fila = mysqli_fetch_array($mensaje, MYSQLI_ASSOC)) {
        $_SESSION['msg'] = $fila['Alerta'];
        $_SESSION['color'] = $fila['color'];
        
    }

   
    
header('Location: rutas_index.php');
} else {
    header("location: ../error.php");
}
?>