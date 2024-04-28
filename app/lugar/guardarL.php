<?php
session_start();
if($_SESSION['acceso'] == 'acceso'){
     include("../config/database.php");//importar paquetes de otra clase   



     $nombreLugar= $_POST['nombreLugar'];

     $consulta = "CALL SP_insertar_lugar('$nombreLugar');";

     $alertas = mysqli_query($conectar,$consulta);
      while ($fila = mysqli_fetch_array($alertas, MYSQLI_ASSOC)){
        $_SESSION['msg'] = $fila['mensaje'];
        $_SESSION['color'] = $fila['color'];
      }
      $id = $conectar->insert_id; 
    header("location:index_lugar.php");  


    }else{
        header ("location: ../error.php");
    }
?>