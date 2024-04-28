<?php 
session_start();
if($_SESSION['acceso'] == 'acceso'){

require '../config/database.php';
$id_boleto = $conectar->real_escape_string($_POST['id_boleto']);
$select_parada = $conectar->real_escape_string( $_POST['boleto_ruta_a']);
$select_ruta = $conectar->real_escape_string( $_POST['boleto_parada_a']);
$precio_boleto = $conectar->real_escape_string( $_POST['precio_boleto']);

echo "id boleto: $id_boleto select parada: $select_parada 
select ruta: $select_ruta precio del boleto: $$precio_boleto";

$sql = "CALL SP_actualizar_tarifa($id_boleto,$precio_boleto, $select_parada, $select_ruta)";


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