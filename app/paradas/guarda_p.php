<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {

require '../config/database.php';
$nombre_parada = $conectar->real_escape_string($_POST['nombre_p']);
$id_ruta = $conectar->real_escape_string($_POST['select_ruta-parada']);
$sql = "CALL SP_insertar_parada('$nombre_parada',$id_ruta);";

$mensaje = mysqli_query($conectar, $sql);

    while ($fila = mysqli_fetch_array($mensaje, MYSQLI_ASSOC)) {
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
        
    }

    $id = $conectar->insert_id;





header('Location: index_paradas.php');
} else {
    header("location: ../error.php");
}
