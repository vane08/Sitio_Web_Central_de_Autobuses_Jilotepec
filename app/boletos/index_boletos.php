<?php
session_start();
if($_SESSION['acceso'] == 'acceso'){

require '../config/database.php';
    $sqlSelectParadas = " 
        SELECT id_ruta,L.nombre_lugar as Origen, LD.nombre_lugar as Destino  from Ruta as R
        join Lugar as L on R.origen = L.id_lugares
        join Lugar as LD on R.destino = LD.id_lugares WHERE R.estatus = 1 AND L.estatus = 1 AND LD.estatus = 1 
        ";
    $select_parada = $conectar->query($sqlSelectParadas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifas de bús</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/all.min.css" rel="stylesheet">
    <script language="javascript" src="./../../assets/js/jquery-3.1.1.min.js"></script>

	<!-- Funcionamiento para ambos selects dentro de la ventana modal de agregar boletos-->
		<script language="javascript">
			$(document).ready(function(){
				$("#boleto_ruta").change(function () {

					
					$("#boleto_ruta option:selected").each(function () {
						id_parada = $(this).val();
						$.post("getParada.php", { id_parada: id_parada}, function(data){
							$("#boleto_parada").html(data);
						});            
					});
				})
			});
			
		</script>

        <script language="javascript">
			$(document).ready(function(){
				$("#boleto_ruta_a").change(function () {

					$("#boleto_ruta_a option:selected").each(function () {
						id_parada = $(this).val();
						$.post("getParada_a.php", { id_parada: id_parada}, function(data){
							$("#boleto_parada_a").html(data);
						});            
					});
				})
			});
			
		</script>
</head>

<body>
    <header class="bg-primary pt-3 pb-3">
        <!-- Inicia parte del encabezado -->
        <div class="d-flex p-2 bd-highlight justify-content-between">
            <div class="border bg-light">
                <p>Aqui va el logo</p>
            </div>
            <div>
                <h1 class="text-center text-white">Tarifas de bús</h1>
            </div>
            <div>
                
                <button type="button" class="btn btn-light"><a href="./../panel_de_control.php">Panel de Control</a>
               </button>
            </div>
        </div>
    </header>
    <!-- Termina parte del encabezado -->

    <main class="container-fluid">
        <section class="row">
            <!-- inicia boton de volver a panel de control -->
            <article class="col-1 col-md-1 bg-danger">
                <!-- <p>Aqui va img hacia panel de control</p> -->
                <!-- <img src="./../img/home.png" width='50' height='50' class="img-fluid" alt="Panel de Control" title="Panel de Control">
                <p class="text-start"><a href="./../panel.php" class="link-secondary">Panel de Control</a></p> -->
            </article>
            <!-- termina boton de volver a panel de control -->

            <!-- inicia parte de alertas, con variable de sesion que se encuentra en guarda_p, edita_p y elimina_p -->
            <article class="col-12 col-md-12 pt-3">
                <?php
                if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
                    <div class="alert alert-<?= ($_SESSION['color']) ?> alert-dismissible fade show" role="alert">

                        <?= ($_SESSION['msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['msg']);
                    unset($_SESSION['color']);
                }

                ?>
            </article>
            <!-- termina parte de alertas, con variable de sesion que se encuentra en guarda_p, edita_p y elimina_p esto tambien esta en el video de modales -->

            <!-- esta es la parte de buscar con la tabla esto si pones atencion al segundo video pues le entenderas-->
            <article class="col-12 col-md-6 col-xl-8">
                <label>Buscar un boleto de bús:</label>
                <div class="input-group">
                    <input name="campo_b" id="campo_b" class="form-control mb-2 rounded border border-primary" placeholder="Escribe aquí el nombre o cualquier valor de boleto de bús a buscar..." aria-label="Search">
                </div>
            </article>
            <!-- aqui termina la parte de buscar con la tabla -->

            <!-- Inicia select para mostrar numero de registros VANESSA, DE ESTO NOMAS IGNORALO ESE LO PONGO YO -->
            <article class="col-12 col-md-3 col-xl-3 mr-0">
                <label>Registros a Mostrar:</label>
                <select name="num_registros_b" id="num_registros_b" class="form-select border border-primary">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>

            </article>
            <!-- Termina select para mostrar numero de registros -->

            <!-- empieza boton de agregar paradas -->
            <article class="col-12 col-md-3 col-xl-1">
                <label type="hidden" class="col-md-1"></label> <!-- label para ordenar el boton con sus select -->
                <div class="d-grid gap-2 d-md-flex justify-content-end rounded  mb-1 mb-md-0 ">
                    <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#nuevoModal_boletos" type="button">Agregar</button>
                </div>
            </article>
            <!-- termina boton de agregar paradas -->
            <!-- inicia parte de la tabla -->
            <article class="col-12 col-md-12">
                <table class="table table-sm table-bordered table-striped table-responsive">
                    <thead class="bg-light text-dark">
                        <tr class="bg-primary text-light">
                            <th class="text-center">ID</th>
                            <th class="text-center ">Parada de bús</th>
                            <th class="text-center ">Ruta</th>
                            <th class="text-center">Precio Boleto</th>
                            <th class="text-center ">Editar</th>
                            <th class="text-center ">Eliminar</th>
                        </tr>
                    </thead>
                    <!-- De aqui, todo ocurre en el script de table.js, este se manda a llamar hasta abajo! -->
                    <tbody id="content_b">
                    </tbody>
                </table>
            </article>
            <!-- termina parte de la tabla -->
            <article class="text-center col-12">
                <h6 id="lbl-total"></h6>
            </article>
            <article class="d-flex justify-content-center col-12">
                <div id="nav-paginacion"></div>
            </article>
        </section>
        <!-- consulta para mostrar en el conmbox -->

        <?php include './modales_boleto/nuevoModal.php'; ?>
        <?php $select_parada->data_seek(0); ?>
        <?php include './modales_boleto/editaModal.php'; ?>
        <?php include './modales_boleto/eliminaModal.php'; ?>

        <script>
          <?php include '../../assets/js/modales_boleto_js/funcionamiento_boletos.js' ?>
        </script>

        <!-- Aqui esta el funcionamiento de JS para que se muestre la tabla -->
        <script>
            <?php include '../../assets/js/table_funcionalidad_b.js'; ?>
        </script>
</body>
</html>
<?php
    }else{
        header ("location: ../error.php");
    }
?>