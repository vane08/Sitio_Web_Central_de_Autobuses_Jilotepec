<?php
session_start();
if($_SESSION['acceso'] == 'acceso'){
require '../config/database.php';

// $boleto_ruta = $conectar->real_escape_string($_POST['boleto_ruta']);


$id_boleto = $conectar->real_escape_string( $_POST['id_boleto']);


$sql = "
SELECT tarifa.id_tarifa, tarifa.precio_boleto, tarifa.parada, parada.nombre_parada as parada_n, tarifa.ruta, LO.nombre_lugar as Origen, LD.nombre_lugar as Destino
FROM tarifa
JOIN Ruta as R ON tarifa.ruta = R.id_ruta
JOIN Lugar as LO ON R.origen = LO.id_lugares
JOIN Lugar as LD ON R.destino = LD.id_lugares
JOIN parada ON parada.id_parada = tarifa.parada 
WHERE tarifa.id_tarifa = $id_boleto LIMIT 1";
$resultado = $conectar ->query($sql);
$rows = $resultado->num_rows;


$boleto = [];
if($rows > 0){
    $boleto = $resultado->fetch_array();
}


echo json_encode($boleto, JSON_UNESCAPED_UNICODE);
}else{
    header ("location: ../error.php");
}

 ?>