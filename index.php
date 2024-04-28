<?php
require './app/config/database.php';
$sqlSelectParadas = " 
SELECT r.id_ruta, lugarOrigen.nombre_lugar AS Origen, lugarDestino.nombre_lugar  AS Destino
FROM ruta AS r 
INNER JOIN lugar AS lugarOrigen ON r.origen=lugarOrigen.id_lugares 
INNER JOIN lugar AS lugarDestino ON r.destino=lugarDestino.id_lugares 
WHERE   r.estatus = 1  AND  lugarOrigen.estatus = 1 AND lugarDestino.estatus
    ";
$select_parada = $conectar->query($sqlSelectParadas);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-primary pt-3 pb-3">
        <!-- Inicia parte del encabezado -->
        <div></div>
        <div class="d-flex p-2 justify-content-between">
            <div>
            <img src="./app/img/icon.jpg" class="img-fluid" width="100px" height="100px"/>
            </div>
            <div>
                <h1 class="text-center text-white p-3">Servicios Urbanos y Suburbanos de Jilotepec</h1>
            </div>
            <div class="d-flex flex-column text-center p-2" width="30px">
            <a href="./app/login/login.php" class="text-light shadow rounded-2 btn bg-light"> <img src="./app/img/inicio-sesion.svg" width="50" class="align-self-center p-2"></a>
            </div>
            <div></div>
        </div>
    </header>

    <main class="container-fluid">
        <section class="row">

            <article class="col-12 ">
                <div class="d-flex justify-content-center m-3">
                </div>
            </article>

            <article class="col-12">
                <div class="d-flex justify-content-center m-3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3750.3339635462394!2d-99.53323102586106!3d19.952452723876124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2363dae5eb55b%3A0x56c5e85b61e4ed39!2sBase%20Mano%20Amiga!5e0!3m2!1ses-419!2smx!4v1686546189508!5m2!1ses-419!2smx" width="600px" height="500px" style="border:0;" allowfullscreen="" class="img-fluid" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </article>

            <article class="col-12">
                <div class="d-flex justify-content-center m-3">
                    <p class="text-center">
                      <h1>Bienvenido estimado usuario<h1>
                    </p>
                </div>
                <div class="d-flex justify-content-center m-3">
                   
                    <h5 class="text-center">Elija una ruta para obtener más información
                        sobre nuestros servicios<h5>
                </div>
            </article>

            <article class="col-2"></article>

            <article class="col-8">
                <form action="./pagina_principal/busqueda_rutas_horarios.php" method="post">
                        <div class="input-group">
                            <select name="id_ruta_select" id="id_ruta_select" class="form-select" required>
                                <option selected disabled value=''>Seleccione una ruta</option>
                                <?php
                                while ($row_select_p = $select_parada->fetch_assoc()) { ?>
                                    <option value="<?php echo $row_select_p["id_ruta"]; ?>"><?= $row_select_p["Origen"] . '-' . $row_select_p["Destino"] ?></option>
                                <?php   } ?>

                            </select>
                            <button type="submit" class="btn btn-primary">Buscar resultados</button>
                        </div>
                </form>
            </article>

            <article class="col-2"></article>

            <article class="col-12">
                <div class="d-flex justify-content-center m-3">
                 <div id="carouselExampleDark" class="carousel carousel-dark slide">
                 <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                 </div>
                 <div class="carousel-inner">
                 <div class="carousel-item active" data-bs-interval="10000">
                    <img src="./app/img/ManoAmiga6.jpeg" class="img-fluid rounded" alt="...">
                 <div class="carousel-caption d-none d-md-block">
                 </div>
                 </div>
                 <div class="carousel-item" data-bs-interval="2000">
                    <img src="./app/img/ManoAmiga7.jpeg" class="img-fluid rounded" alt="...">
                 <div class="carousel-caption d-none d-md-block">
                 </div>
                 </div>
                 <div class="carousel-item">
                   <img src="./app/img/ManoAmiga8.jpeg" class="img-fluid rounded" alt="...">
                 <div class="carousel-caption d-none d-md-block">
                 </div>
                 </div>
                 </div>
                 <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
                 </button>
                 <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Next</span>
                </button>
               </div>
             </div>
            </article>
        </section>
    </body>
</main>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>

</html>