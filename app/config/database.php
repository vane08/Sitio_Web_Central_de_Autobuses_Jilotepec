<?php 

$server = "localhost:3309";
$user = "root";
$password = "12345";
$dataBase = "bd_central";

$conectar = mysqli_connect(
                $server,
                $user,
                $password,
                $dataBase) 
                OR DIE
                ("PROBLEMAS AL ENCONTRAR EL SERVIDOR");



?>