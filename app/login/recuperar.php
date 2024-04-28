<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar contraseña</title>

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
</head>

<body class="bg-primary">
    <h2 class="text-center h1 mb-3 text-light">Recuperar contraseña</h2>
    <main class="container-fluid rounded-1 ">
        <section class="row">

            <article class="col-md-4">
            </article>

            <article class="col-md-4">

                <form action="login.php" method="POST" class="p-3 form border pt-5 bg-light rounded-2 shadow">
                    <h5>Ingresa tu correo para verificar si existe en nuestros registros:</h5>
                    <!-- <h6 class="text-center fs-2">hola</h6> -->
                    <div class="form-group">
                        <br>
                        <label for="email">Correo electrónico:</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico">
                        <!-- <input type="text" name="email" id="email" placeholder="Correo electrónico" class="form-control rounded-pill"> -->
                        <br>
                        <br>
                        <button type="submit" value="submit" class="btn btn-primary col-12 shadow">Recuperar contraseña</button>

                </form>

            </article>



        </section>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>