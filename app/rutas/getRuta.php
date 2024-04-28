<?php 
session_start();
if ($_SESSION['acceso'] == 'acceso') {
include("../config/database.php");
$id_ruta = $conectar->real_escape_string($_POST['id_ruta']);



$consulta = "SELECT id_ruta, 
L.nombre_lugar AS Origen, 
LD.nombre_lugar AS Destino
FROM Ruta AS R
JOIN Lugar AS L ON R.origen = 
L.id_lugares
JOIN Lugar AS LD ON R.destino = LD.id_lugares
WHERE R.id_ruta = $id_ruta LIMIT 1";
$resultado = $conectar ->query($consulta);
$rows = $resultado->num_rows;

$ruta = [];
if($rows > 0){
    $ruta = $resultado->fetch_array();

}
echo json_encode($ruta, JSON_UNESCAPED_UNICODE);
} else {
    header("location: ../error.php");
}
?>

