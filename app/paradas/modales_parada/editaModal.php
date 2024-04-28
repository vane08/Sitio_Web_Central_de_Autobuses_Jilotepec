<!-- Modal de insertar rutas -->
<div class="modal fade" id="editaModal_paradas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editaModal_paradas_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-light" id="editaModal_paradas_label">Editar registro de parada de bús</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="needs-validation" action="edita_p.php" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" id="id" name="id">
                 
                    <div class="mb-3">
                        <label for="nombre_p" class="form-label">Parada de bús a Editar:</label>
                        <input type="text" class="form-control" id="nombre_p" name="nombre_p" required>
                        <div class="invalid-feedback">
                            Es necesario colocar un nombre.
                        </div>
                    </div>
                    Seleccione una ruta:
                        <select name="select_ruta-parada" id="select_ruta-parada" class="form-select mb-3" aria-label="Default select example" required>
                            <option value="">Seleccionar...</option>
                        <?php
                            while ($row_select_p = $select_parada->fetch_assoc()) { ?>
                                <option value="<?php echo $row_select_p["id_ruta"]; ?>"><?=$row_select_p["Origen"].'-'. $row_select_p["Destino"]?></option>

                            <?php   } ?>


                        </select>


                    <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Editar parada de bús</button>
                    </div>
                </form>
            </div>
    
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- Este escript funciona para las validaciones de campos vacios, -->
<!-- si llegas hasta aqui, basicamente lo que hice fue ver este video: https://www.youtube.com/watch?v=hcno1fusrR8&t=344s, todo esta ahi, nada del otro mundo -->

<script>
    (function() {
        'use strict'
        // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
        var forms = document.querySelectorAll('.needs-validation')

        // Bucle sobre ellos y evitar el envío
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>