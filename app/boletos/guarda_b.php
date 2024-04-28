<?php 
session_start();
if($_SESSION['acceso'] == 'acceso'){
require '../config/database.php';

$precio = $conectar->real_escape_string( $_POST['precio_boleto']);
$select_ruta = $conectar->real_escape_string( $_POST['boleto_ruta']);
$select_parada = $conectar->real_escape_string($_POST['boleto_parada']);

$sql = "CALL SP_insertar_tarifa($precio, $select_ruta, $select_parada)";

$mensaje = mysqli_query($conectar, $sql);
    while ($fila = mysqli_fetch_array($mensaje, MYSQLI_ASSOC)) {
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];   
    }
    $id = $conectar->insert_id;

header('Location: index_boletos.php');

}else{
    header ("location: ../error.php");
}
?>