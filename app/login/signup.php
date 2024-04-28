<?php
session_start();

require '../config/database.php';

if (isset($_POST['usuario']) && ($_POST['apellido1']) && ($_POST['apellido2']) && ($_POST['email']) && ($_POST['contrasena']) == ($_POST['contrasenav'])) {
  $usuario = $_POST['usuario'];
  $apellido1 = $_POST['apellido1'];
  $apellido2 = $_POST['apellido2'];
  $email = $_POST['email'];
  $contrasena = $_POST['contrasena'];
  $verificacion = "CALL SP_insertar_usuario('$usuario','$apellido1','$apellido2','$email','$contrasena');";
  $res = mysqli_query($conectar,$verificacion);
  ?>
  <script>
  alert("Inserción hecha correctamente, ahora puede iniciar sesión en esa cuenta.");
  </script>
  <?php
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body class="bg-primary">

    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <article class="column col-12 fs-4">
    <div class="d-flex justify-content-center">
        <form action="signup.php" method="POST" class="p-3 form border pt-5 bg-light rounded-4 shadow d-flex flex-column m-4 col-3 col-md-3 col-sm-12">
        <h1 class="m-2">Registrarse</h1>
        <span class="m-2">o <a href="login.php">Iniciar sesión.</a></span>
        <input name="usuario" type="text" placeholder="Ingresa tu usuario" class="rounded-pill border-info m-2 fs-6 p-2">
        <input name="apellido1" type="text" placeholder="Ingresa tu apellido paterno" class="rounded-pill border-info m-2 fs-6 p-2">
        <input name="apellido2" type="text" placeholder="Ingresa tu apellido materno" class="rounded-pill border-info m-2 fs-6 p-2">
        <input name="email" type="text" placeholder="Ingresa tu email" class="rounded-pill border-info m-2 fs-6 p-2">
        <input name="contrasena" type="password" placeholder="Ingresa tu contraseña" class="rounded-pill border-info m-2 fs-6 p-2">
        <input name="contrasenav" type="password" placeholder="Vuelve a ingresar tu contraseña" class="rounded-pill border-info m-2 fs-6 p-2">
        <input type="submit" value="Registrar" class="rounded-pill btn btn-primary m-2 fs-6 p-2">
        </form>
    </div>
    </article>
  </body>
</html>