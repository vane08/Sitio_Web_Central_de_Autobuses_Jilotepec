<?php
session_start();
if($_SESSION['acceso'] == 'acceso'){
	require '../config/database.php';
	
	$id_parada = $_POST['id_parada'];
	
	

	$queryRuta = "SELECT parada.id_parada, parada.nombre_parada FROM parada WHERE parada.ruta = $id_parada
	AND parada.estatus = 1";
	$resultadoM = $conectar->query($queryRuta);
	
	$html= "<option selected disabled value=''>Seleccionar Parada</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_parada']."'>".$rowM['nombre_parada']."</option>";
	}
	
	echo $html;
}else{
    header ("location: ../error.php");
}

?>		