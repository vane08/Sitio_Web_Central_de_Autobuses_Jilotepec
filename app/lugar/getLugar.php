<?php 
session_start();
if($_SESSION['acceso'] == 'acceso'){

include("../config/database.php");
$id_lugar = $conectar->real_escape_string($_POST['id_lugares']);

$consulta = "SELECT lugar.id_lugares, lugar.nombre_lugar FROM lugar WHERE lugar.id_lugares = $id_lugar LIMIT 1";
$resultado = $conectar ->query($consulta);
$rows = $resultado->num_rows;

$lugar = [];
if($rows > 0){
    $lugar = $resultado->fetch_array();

}
echo json_encode($lugar, JSON_UNESCAPED_UNICODE);

}else{
    header ("location: ../error.php");
}
?>
