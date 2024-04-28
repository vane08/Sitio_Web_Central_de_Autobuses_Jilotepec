<?php

session_start();

require '../config/database.php';

if (isset($_POST['email']) && ($_POST['password'])) {
  $correo = $_POST['email'];
  $contrasenia = $_POST['password'];
  $verificacion = "CALL SP_verificar('$correo','$contrasenia')";
  $res = mysqli_query($conectar, $verificacion);
  while ($resultado = mysqli_fetch_array($res)) {
    $acceso = $resultado[0];
    $usuario = $resultado[1];
    $rol = $resultado[2];
  }
  $_SESSION['acceso'] = $acceso;
  $_SESSION['usuario'] = $usuario;
  $_SESSION['rol'] = $rol;
  if ($_SESSION['acceso'] == 'acceso') {
    header('Location: ../panel_de_control.php');
  } else {
?>
    <script>
      alert("Hubo un error al ingresar tus datos, por favor vuelve a ingresarlo..");
    </script>
<?php
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio De Sesión | RutasJilo</title>

  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
</head>

<body class="bg-primary">
  <h2 class="text-center h1 mb-3 text-light">¡Hola!, Por favor Inicia Sesión</h2>
  <main class="container-fluid rounded-1 ">
    <section class="row">

      <article class="col-md-4">
      </article>

      <article class="col-md-4">

        <form action="login.php" method="POST" class="p-3 form border pt-5 bg-light rounded-2 shadow">
          <h4 class="text-center fs-2">Inicio de sesión</h4>
          <div class="form-group">
            <br>
            <label for="email">Correo electrónico:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico">
            <!-- <input type="text" name="email" id="email" placeholder="Correo electrónico" class="form-control rounded-pill"> -->
          </div>
          <br>
          <label for="email">Contraseña:</label>
          <input type="text" class="form-control" name="password" id="password" placeholder="Contraseña">
          <!-- <input type="text" name="email" id="email" placeholder="Correo electrónico" class="form-control rounded-pill"> -->
          </div>

          <br>
          <br>
          <button type="submit" value="submit" class="btn btn-primary col-12 shadow">Continuar</button>

          <div class="d-flex justify-content-center m-2">
            <a class="text-center" href="recuperar.php">¿Olvidaste tu contraseña?</a>
          </div>
        </form>

      </article>



    </section>



    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
  </main>


  <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>-->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>