<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {
include("../config/database.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas</title>
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
                <h1 class="text-center text-white">Rutas de bús</h1>
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
                if (isset($_SESSION['msg'])) { ?>
                    <div class="alert alert-<?= ($_SESSION['color']) ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['msg']);
                }

                ?>
            </article>
            <!-- termina parte de alertas, con variable de sesion que se encuentra en guarda_p, edita_p y elimina_p esto tambien esta en el video de modales -->

            <!-- esta es la parte de buscar con la tabla esto si pones atencion al segundo video pues le entenderas-->
            <article class="col-12 col-md-8 col-xl-8">
                <label for="campo">Buscar un Lugar:</label>
                <div class="input-group">
                    <input name="campo" id="campo" class="form-control mb-2 rounded border border-primary" placeholder="Escribe aquí el nombre del lugar a buscar..." aria-label="Search">
                </div>
            </article>
            <!-- aqui termina la parte de buscar con la tabla -->

            <!-- Inicia select para mostrar numero de registros VANESSA, DE ESTO NOMAS IGNORALO ESE LO PONGO YO -->
            <article class="col-12 col-md-2 col-xl-3 mr-0">
                <label>No. registros:</label>
                <select name="num_registros" id="num_registros" class="form-select border border-primary">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </article>
            <!-- Termina select para mostrar numero de registros -->

            <!-- empieza boton de agregar paradas -->
            <article class="col-12 col-md-2 col-xl-1">
                <label type="hidden" class="m-0"></label> <!-- label para ordenar el boton con sus select -->
                <div class="d-grid gap-2 d-md-flex justify-content-end  rounded  mb-1 mb-md-0 ">
                    <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#nuevoModalRuta" type="button">Agregar</button>
                </div>
            </article>
            <!-- termina boton de agregar paradas -->

            <!-- inicia parte de la tabla -->
            <article class="col-12 col-md-12">
                <table class="table table-sm table-bordered table-striped table-responsive">
                    <thead class="bg-light text-dark text-center">
                        <tr class="bg-primary text-light">
                            <th>ID</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="content">

                    </tbody>
                </table>
                <?php
                # Mostrar en seleccionar lugares
                include("../config/database.php");
                $consulta = "SELECT id_lugares,nombre_lugar 
            FROM lugar 
            WHERE estatus =1 
            ORDER BY nombre_lugar ASC";
                $lugaresOrigen = mysqli_query($conectar, $consulta);
                ?>

                <?php
                # Mostrar en seleccionar lugares
                include("../config/database.php");
                $consulta = "SELECT id_lugares,nombre_lugar 
                 FROM lugar 
                 WHERE estatus =1
                 ORDER BY nombre_lugar ASC";
                $lugaresDestino = mysqli_query($conectar, $consulta);
                ?>
            </article>
            <!-- termina parte de la tabla -->
            <article class="text-center col-12">
                <h6 id="lbl-total"></h6>
            </article>
            <article class="d-flex justify-content-center col-12">
                <div id="nav-paginacion"></div>
            </article>
        </section>
    </main>

    <?php include 'modales_rutas/nuevoModal_ruta.php'; ?>

    <?php 
    $lugaresOrigen->data_seek(0);
    $lugaresDestino->data_seek(0);

    ?>
    <?php include 'modales_rutas/editaModal_ruta.php'; ?>
    <?php include 'modales_rutas/eliminaModal_ruta.php'; ?>


    <script>
        <?php include '../../assets/js/modales_ruta_js/funcionamiento_ruta.js' ?>
    </script>

    <script>
        <?php include '../../assets/js/table_funcionalidad_r.js'; ?>
    </script>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
} else {
    header("location: ../error.php");
}
?>