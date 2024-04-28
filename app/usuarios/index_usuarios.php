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
        <title>Administracion de usuarios</title>
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/css/all.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="./../../assets/img/icon.jpg" />
    </head>

    <body>
        <header class="bg-dark pt-3 pb-3">
        <div class="d-flex p-2 bd-highlight justify-content-between">
            <div class="border bg-light">
                <p>Aqui va el logo</p>
            </div>
            <div>
                <h1 class="text-center text-white">Administración de Usuarios</h1>
            </div>
            <div>
            <button type="button" class="btn btn-light"><a class="text-dark" href="./../panel_de_control.php">Panel de Control</a>
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
                    <label>Buscar un usuario:</label>
                    <div class="input-group">
                        <input name="campo_u" id="campo_u" class="form-control mb-2 rounded" placeholder="Escribe aquí el valor a buscar..." aria-label="Search">
                    </div>
                </article>
                <!-- aqui termina la parte de buscar con la tabla -->

                <!-- Inicia select para mostrar numero de registros VANESSA, DE ESTO NOMAS IGNORALO ESE LO PONGO YO -->
                <article class="col-12 col-md-3 col-xl-3 mr-0">

                    <label>Registros a Mostrar:</label>
                    <select name="num_registros_u" id="num_registros_u" class="form-select">
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
                        <button class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#nuevoModal_usuarios" type="button">Agregar</button>
                    </div>
                </article>
                <!-- termina boton de agregar paradas -->

                <!-- inicia parte de la tabla -->
                <article class="col-12 col-md-12">
                    <table class="table table-sm table-bordered table-striped ">
                        <thead class="bg-light text-dark">
                            <tr class="bg-dark text-light">
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre del usuario</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">correo electrónico</th>
                                <th class="text-center">Contraseña</th>
                                <th class="text-center ">Rol</th>
                                <th class="text-center ">Editar</th>
                                <th class="text-center ">Eliminar</th>
                            </tr>
                        </thead>
                        <!-- De aqui, todo ocurre en el script de table.js, este se manda a llamar hasta abajo! -->
                        <tbody id="content_u">
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
    <!-- Esta parte funciona para que muestre en el select de rol -->
    <?php
    $sqlUsuario =
        "SELECT rol.id_rol, rol.rol
    FROM rol
    WHERE rol.id_rol <> 1;
    ";
    $usuarios = $conectar->query($sqlUsuario);
    ?>
    <!-- Fin de parte funciona para que muestre en el select de paradas -->

    <!-- Inicia seccion de instancias a modales (INSERT, UPDATE y DROP de paradas) -->
    <?php include './modales_usuario/eliminaModal.php'; ?>
    <?php include './modales_usuario/nuevoModal.php'; ?>
    <?php $usuarios->data_seek(0); ?>
    <?php include './modales_usuario/editaModal.php'; ?>

    <!-- Termina seccion de instancias a modales (INSERT, UPDATE y DROP de paradas) -->


    <!-- Aqui esta el funcionamiento de JS para que se muestre la tabla -->
    <script>
        <?php include '../../assets/js/table_funcionalidad_u.js'; ?>
    </script>

    <script>
        let nuevoModal = document.getElementById('nuevoModal_usuarios');
        let eliminaModal = document.getElementById('eliminaModal_usuarios')
        let editarModal = document.getElementById('editaModal_usuarios')

        nuevoModal.addEventListener('shown.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre_usuario').focus()
        })
        editarModal.addEventListener('shown.bs.modal', event => {
            editaModal.querySelector('.modal-body #nombre_usuario').focus()
        })

        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre_usuario').value = "";
        })
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #apellido_paterno').value = "";
        })
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #apellido_materno').value = "";
        })
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #alias_user').value = "";
        })
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #correo_user').value = "";
        })
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #contrasenia_user').value = "";
        })
        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #select_rol').value = "";
        })

        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id');
            let inputId = editarModal.querySelector('.modal-body #id')
            let inputnombre_usuario = editarModal.querySelector('.modal-body #nombre_usuario')
            let inputapellido_paterno = editarModal.querySelector('.modal-body #apellido_paterno')
            let inputapellido_materno = editarModal.querySelector('.modal-body #apellido_materno')
            let inputalias_user = editarModal.querySelector('.modal-body #alias_user')
            let inputcorreo_user = editarModal.querySelector('.modal-body #correo_user')
            let inputcontrasenia_user = editarModal.querySelector('.modal-body #contrasenia_user')
            let inputselect_rol = editarModal.querySelector('.modal-body #select_rol')


            let url = "get_usuario.php"
            let formData = new FormData()

            formData.append('id_usuario', id)

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    inputId.value = data.id_usuario;
                    inputnombre_usuario.value = data.nombre_usuario
                    inputapellido_paterno.value = data.apellidoPaterno
                    inputapellido_materno.value = data.apellidoMaterno
                    inputalias_user.value = data.user
                    inputcorreo_user.value = data.correo
                    inputcontrasenia_user.value = data.contrasenia
                    inputselect_rol.value = data.rol

                }).catch(err => console.log(err))
        })

        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id');
            eliminaModal.querySelector('.modal-footer #id').value = id

        })
    </script>


    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
} else {
    header("location: ../error.php");
}

?>