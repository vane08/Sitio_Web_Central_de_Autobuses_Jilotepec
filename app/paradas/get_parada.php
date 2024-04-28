<?php 
session_start();
if ($_SESSION['acceso'] == 'acceso') {

require '../config/database.php';
$id_parada = $conectar->real_escape_string($_POST['id_parada']);

$sql = "SELECT parada.id_parada, parada.nombre_parada, parada.ruta FROM parada WHERE parada.id_parada = $id_parada LIMIT 1";
$resultado = $conectar ->query($sql);
$rows = $resultado->num_rows;

$parada = [];
if($rows > 0){
    $parada = $resultado->fetch_array();

}
echo json_encode($parada, JSON_UNESCAPED_UNICODE);

// header('Location: index_paradas.php');

} else {
    header("location: ../error.php");
}
