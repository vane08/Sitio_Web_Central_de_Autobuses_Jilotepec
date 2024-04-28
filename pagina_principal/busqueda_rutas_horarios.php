<?php
require '../app/config/database.php';
$ruta_id = $conectar->real_escape_string($_POST['id_ruta_select']);


$mostrarRuta = " 
SELECT r.id_ruta, lugarOrigen.nombre_lugar AS lugar_origen, lugarDestino.nombre_lugar  AS lugar_destino
FROM ruta AS r 
INNER JOIN lugar AS lugarOrigen ON r.origen=lugarOrigen.id_lugares 
INNER JOIN lugar AS lugarDestino ON r.destino=lugarDestino.id_lugares 
WHERE r.estatus = 1  AND  lugarOrigen.estatus = 1 AND lugarDestino.estatus AND  r.id_ruta= $ruta_id
    ";
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
<header class="bg-primary pt-3 pb-3">
        <!-- Inicia parte del encabezado -->
        <div class="d-flex p-2 bd-highlight justify-content-between">
            <div>
            <img src="../app/img/icon.jpg" class="img-fluid" width="100px" height="100px"/>
                <!-- <img src="img/logoManoAmiga.png" class="img-fluid" width="100px" height="100px"/> -->
            </div>
            <div>
                <h1 class="text-center text-white p-2">Rutas Disponibles</h1>
            </div>
            <div class="d-flex flex-column text-center p-2 m-2" width="30px">
            <a href="./../index.php" class="text-light  shadow rounded-2 btn bg-light"> <img src="../app/img/inicio.svg" width="50" class="align-self-center p-2"></a>
            </div>
        </div>
        <div>
        </div>
    </header>

    <main class="container-fluid">
        <section class="row">
            <article class="col-12">
                <div class="d-flex justify-content-center m-3">
                    <p class="text-center">
                      <h1>Estimado usuario<h1>
                    </p>
                </div>
            </article>

            <!-- <div class="col-2"></div> -->
            <div class="col-7  text-center pt-4">
                <fs-5 class="">Usted ha seleccionado:</fs-5>
                <?php
                $resultado = mysqli_query($conectar, $mostrarRuta);
                $row = mysqli_fetch_row($resultado);
                
                echo '<h2>' . $row[1] . '-' . $row[2] . '</h2>';
                ?>

                <?php
                $resultado = mysqli_query($conectar, $mostrarRuta);
                $row = mysqli_fetch_row($resultado);

                ?>
                <br>
                <div class="text-center">

                    <h4>Horarios Disponibles:</h4>
                    <fs-5 class="text-center">Horario de salida - Horario de llegada</fs-5>
                    <br>
                    <fs-5 class="text-center"><?php echo $row[1] . ' - ' . $row[2]; ?></fs-5>

                    <?php
                    $sql_horarios = "
                    SELECT hora_salida, hora_llegada FROM horario WHERE horario.ruta = $ruta_id AND horario.estatus = 1";
                
                    $resultSetHorarios = mysqli_query($conectar, $sql_horarios);

                    while ($rowH = mysqli_fetch_row($resultSetHorarios)) {
                    ?>
                        <div class="card">

                            <ul class="list-group list-group-flush">
                                <li class="text-center list-group-item"><?php echo $rowH[0] . ' - ' . $rowH[1] ?></li>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                      <form action="horarios-ruta.php" method="post">
                       <div class="d-grid gap-2 col-6 mx-auto m-3">
                        <input type="hidden" name="txtIdHorario" id="txtIdHorario" value="<?=$ruta_id?>" type="text">
                        <button type="submit" class="text-dark  shadow rounded-2 btn bg-light">
                          <img src="../app/img/pdf.svg" width="50" class="align-self-center p-2">Generar PDF 
                        </button>
                       </div>
                     </form> 
                </div>
            </div>

            <div class="col-5 text-center">
            <br>
            <br>
            <br>
            <br>
            <h4 >Paradas disponibles en la ruta:</h4>
            <br>
            <br>
            <br>
                <?php
                $sql = "SELECT parada.nombre_parada as parada, L.nombre_lugar as Origen, LD.nombre_lugar as Destino, precio_boleto
                        from Ruta
                        as R
                        join Lugar as L on R.origen = L.id_lugares
                        join Lugar as LD on R.destino = LD.id_lugares 
                        INNER JOIN tarifa ON R.id_ruta = tarifa.ruta
                        INNER JOIN parada ON tarifa.parada = parada.id_parada WHERE tarifa.estatus=1 AND id_ruta = $ruta_id";
                $resultSet = mysqli_query($conectar, $sql);
                while ($row = mysqli_fetch_row($resultSet)) {
                ?>
                    <div class="card text-right">

                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $row['0'] ?> </h5>
                            <h6 class="card-text">Ruta: <?php echo $row['1'] . '-' . $row['2'] ?> </h6>
                            <p class="card-text">Precio: <?php echo '$' . $row['3'] ?> </p>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                <?php
                }
                ?>
                <form action="precios-parada.php" method="post">
                <div class="d-grid gap-2 col-6 mx-auto m-3">
                <input  type="hidden" name="txtId" id="txtId" value="<?=$ruta_id?>" type="text">
                    <button type="submit" class="text-dark  shadow rounded-2 btn bg-light">
                    <img src="../app/img/pdf.svg" width="50" class="align-self-center p-2">Generar PDF 
                    </button>
                </div>
                </form> 
            </div>
            <div class="col-2"></div>

        </section>
    </main>



</body>

</html>