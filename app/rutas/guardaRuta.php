<?php

session_start();
if ($_SESSION['acceso'] == 'acceso') {
     include("../config/database.php");//importar paquetes de otra clase

     $lugarOrigen = $_POST['lugarOrigenRuta'];
     $lugarDestino = $_POST['lugarDestinoRuta'];

     $consulta = "CALL SP_insertarRuta('$lugarOrigen','$lugarDestino')";

     $alertas = mysqli_query($conectar,$consulta);
     while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
       $_SESSION['msg'] = $fila['Alerta'];
       $_SESSION['color'] = $fila['color'];
     }
     $id = $conectar->insert_id; 
   header("location:rutas_index.php"); 
  } else {
    header("location: ../error.php");
}
?>