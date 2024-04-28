<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {
require '../config/database.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradas</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-primary pt-3 pb-3">
    <div class="d-flex p-2 bd-highlight justify-content-between">
            <div class="border bg-light">
                <p>Aqui va el logo</p>
            </div>
            <div>
                <h1 class="text-center text-white">Paradas de bús</h1>
            </div>
            <div>
            <button type="button" class="btn btn-light"><a href="./../panel_de_control.php">Panel de Control</a>
            </div>
        </div>
    </header>
    <!-- Termina parte del encabezado -->

    <main class="container-fluid">
        <section class="row">
            <!-- inicia parte de alertas, con variable de sesion que se encuentra en guarda_p, edita_p y elimina_p -->
            <article class="col-12 col-md-12 pt-3">
                <?php
                if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
                    <div class="alert alert-<?=($_SESSION['color'])?> alert-dismissible fade show" role="alert">
                   
                        <?=($_SESSION['msg']);?>
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
                <label>Buscar una parada de bús:</label>
                <div class="input-group">
                    <input name="campo_p" id="campo_p" class="form-control mb-2 rounded border border-primary" placeholder="Escribe aquí el nombre de la parada de bús a buscar..." aria-label="Search">
                </div>
            </article>
            <!-- aqui termina la parte de buscar con la tabla -->

            <!-- Inicia select para mostrar numero de registros VANESSA, DE ESTO NOMAS IGNORALO ESE LO PONGO YO -->
            <article class="col-12 col-md-3 col-xl-3 mr-0">

                <label>Registros a Mostrar:</label>
                <select name="num_registros_p" id="num_registros_p" class="form-select border border-primary">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>

            </article>

            <!-- Termina select para mostrar numero de registros -->

            <!-- empieza boton de agregar paradas -->
            <article class="col-12 col-md-3 col-xl-1">
                <label type="hidden" class="m-0"></label> <!-- label para ordenar el boton con sus select -->
                <div class="d-grid gap-2 d-md-flex justify-content-end  rounded  mb-1 mb-md-0 ">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal_paradas" type="button">Agregar</button>
                </div>
            </article>
            <!-- termina boton de agregar paradas -->

            <!-- inicia parte de la tabla -->
            <article class="col-12 col-md-12">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="bg-light text-dark">
                        <tr class="bg-primary text-light">
                            <th class="text-center">ID</th>
                            <th class="text-center">Nombre de la parada</th>
                            <th class="text-center">Ruta</th>
                            <th class="text-center ">Editar</th>
                            <th class="text-center ">Eliminar</th>
                        </tr>
                    </thead>
                    <!-- De aqui, todo ocurre en el script de table.js, este se manda a llamar hasta abajo! -->
                    <tbody id="content_p">
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
</body>
</main>
<!-- Esta parte funciona para que muestre en el select de paradas -->
<?php
    $sqlSelectParadas = " 

    SELECT id_ruta,L.nombre_lugar as Origen, LD.nombre_lugar as Destino  from Ruta as R
    join Lugar as L on R.origen = L.id_lugares
    join Lugar as LD on R.destino = LD.id_lugares WHERE L.estatus = 1 AND LD.estatus = 1 AND R.estatus = 1

        ";
        $select_parada = $conectar->query($sqlSelectParadas);
?>
<!-- Fin de parte funciona para que muestre en el select de paradas -->

<!-- Inicia seccion de instancias a modales (INSERT, UPDATE y DROP de paradas) -->
<?php include './modales_parada/nuevoModal.php'; ?>
<?php $select_parada->data_seek(0);?>
<?php include './modales_parada/editaModal.php'; ?>
<?php include './modales_parada/eliminaModal.php'; ?>
<!-- Termina seccion de instancias a modales (INSERT, UPDATE y DROP de paradas) -->


<!-- Aqui esta el funcionamiento de JS para que se muestre la tabla -->
<script>
    <?php include '../../assets/js/modales_parada_js/funcionamiento_parada.js'; ?>
    <?php include '../../assets/js/table_funcionalidad_p.js'; ?>
</script>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php 
} else {
    header("location: ../error.php");
}

?>