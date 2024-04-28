<?php
  session_start();
  require 'config/database.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  </head>
  <body>
    <?php
    require 'login/header.php';
    if(isset($_SESSION['usuario'])){
      echo '
      <h4 class="col-12 text-center"> Bienvenido(a) '.$_SESSION['usuario'].'.<br>
      Accediste con éxito, ó puedes 
      <a href="login/logout.php">
        Cerrar sesión.
        
      </a></h4>
      <br>
      <br>
      <section class="col-10 p-4 bg-primary shadow rounded-2 d-flex flex-row flex-wrap justify-content-center container">
      <div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
        <img src="img/geo-fill.svg" width="100" class="align-self-center p-2">
        <a href="lugar/index_lugar.php" class="text-light btn btn-primary">LUGARES</a>
      </div>

      <div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
      <img src="img/sign-merge-left-fill.svg" width="100" class="align-self-center p-2">
      <a href="rutas/rutas_index.php" class="text-light btn btn-primary">RUTAS</a>
      </div>

    <div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
      <img src="img/geo-alt-fill.svg" width="100" class="align-self-center p-2">
      <a href="paradas/index_paradas.php" class="text-light btn btn-primary">PARADAS</a>
    </div>

      <div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
            <img src="img/ticket-fill.svg" width="100" class="align-self-center p-2">
            <a href="boletos/index_boletos.php" class="text-light btn btn-primary">TARIFA</a>
      </div>
     
      <div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
            <img src="img/clock-fill.svg" width="100" class="align-self-center p-2">
            <a href="horario/index_horarios.php" class="text-light btn btn-primary">HORARIOS</a>
      </div>

      
      <div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
      <img src="img/person-circle.svg" width="100" class="align-self-center p-2">
      <a href="#" class="text-light btn btn-primary">VISTA DE <br> USUARIOS</a>
      </div>';
      #<a href="login/signup.php">Registrate</a>
      if($_SESSION["rol"]=="1"){
      echo '<div class="d-flex flex-column text-center shadow rounded-2 p-4 bg-light m-2" width="100px">
            <img src="img/people-fill.svg" width="100" class="align-self-center p-2">
            <a href="usuarios/index_usuarios.php" class="text-light btn btn-primary">USUARIOS</a>
            </div>
          
      </section>';
      }
    }else{
      echo '
      <main class="col-12 text-center">
        <h2 class="text-center">Inicia sesión</h2>
        <a href="login/login.php">Iniciar sesión</a>
      </main>';
    }
    ?>
  </body>
</html>
