<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {
require '../config/database.php';

$id_usuario = $conectar->real_escape_string($_POST['id']);

$sql = "call SP_eliminarUsuarioAdmin($id_usuario);";


$mensaje = mysqli_query($conectar, $sql);

    while ($fila = mysqli_fetch_array($mensaje, MYSQLI_ASSOC)) {
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
        
    }

   
    
header('Location: index_usuarios.php');
} else {
    header("location: ../error.php");
}
?>