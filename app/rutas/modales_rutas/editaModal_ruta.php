<!-- Modal de actualiza rutas -->
<div class="modal fade" id="editaModalRuta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editaModalRutalabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-light" id="editaModalRutalabel">Editar Ruta</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="needs-validation" action="edita_Ruta.php" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" id="idRuta" name="idRuta">

                <div class="mb-3 text-center">
                <label for="lugarOrigenRuta" class="form-label">Lugar de origen de la ruta: </label>
                <select name="lugarOrigenRuta" id="lugarOrigenRuta" class="form-control"  required>
                   <option value="">Seleccionar...</option>
                    <?php
                     while ($regLugares = mysqli_fetch_array( $lugaresOrigen)) {
                        echo " '<option value = '" .$regLugares[1] . "'>".
                        $regLugares[1] ."</option>";
                    } 
                    ?>
                </select>        
            </div>

            <div class="mb-3 text-center">
                <label for="lugarDestinoRuta" class="form-label">Lugar destino de la ruta: </label>
                <select name="lugarDestinoRuta" id="lugarDestinoRuta" class="form-control"  required>
                   <option value="">Seleccionar...</option>
                   <?php
                     while ($regLugares = mysqli_fetch_array( $lugaresDestino)) {
                        echo " '<option value = '" .$regLugares[1] . "'>".
                        $regLugares[1] ."</option>";
                    } 
                    ?>
                </select>       
            </div>


                    <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Editar Ruta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
