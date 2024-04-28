<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {

     include("../config/database.php");//importar paquetes de otra clase
     $idR = $_POST['idRuta'];
     $lugarOrigen = $_POST['lugarOrigenRuta'];
     $lugarDestino = $_POST['lugarDestinoRuta'];

     $consulta = "CALL SP_actualizarRuta('$idR','$lugarOrigen','$lugarDestino')";

     $alertas = mysqli_query($conectar,$consulta);
     while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
       $_SESSION['msg'] = $fila['Alerta'];
       $_SESSION['color'] = $fila['color'];
     }
   header("location:rutas_index.php"); 
  } else {
    header("location: ../error.php");
}
?>