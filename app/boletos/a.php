<?php
session_start();
if($_SESSION['acceso'] == 'acceso'){
	require '../config/database.php';
	
	$sqlSelectParadas = " 
    SELECT id_ruta,L.nombre_lugar as Origen, LD.nombre_lugar as Destino  from Ruta as R
    join Lugar as L on R.origen = L.id_lugares
    join Lugar as LD on R.destino = LD.id_lugares
    ";
	$resultado=$conectar->query($sqlSelectParadas);
?>

<html>
	<head>
		<title>ComboBox Ajax, PHP y MySQL</title>
		<script language="javascript" src="./../../assets/js/jquery-3.1.1.min.js"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#boleto_ruta").change(function () {

					
					$("#boleto_ruta option:selected").each(function () {
						id_parada = $(this).val();
						$.post("getRuta.php", { id_parada: id_parada}, function(data){
							$("#boleto_parada").html(data);
						});            
					});
				})
			});
			
			
		</script>
		
	</head>
	
	<body>
		<form id="combo" name="combo" action="guarda.php" method="POST">
			<div>Ruta: 
				<select name="boleto_ruta" id="boleto_ruta">
				<option value="0">Seleccione una ruta</option>
				<?php while($row = $resultado->fetch_assoc()) { ?>
					<option value="<?php echo $row['id_ruta']; ?>"><?php echo $row['Origen'] ."-". $row['Destino']; ?></option>
				<?php } ?>
			</select></div>
			
			<br />
			
			<div>Parada de bús:<select name="boleto_parada" id="boleto_parada"></select></div>
			
			<br />
			
			

			<input type="submit" id="enviar" name="enviar" value="Guardar" />
		</form>
	</body>
</html>
<?php
    }else{
        header ("location: ../error.php");
    }
?>