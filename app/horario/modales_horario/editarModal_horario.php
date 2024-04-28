<!-- Modal editar Horario-->
<div class="modal fade" id="editarModalHorario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarModalHorarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h1 class="modal-title fs-5 text-light" id="editarModalHorarioLabel"><em> Editar Horario</em></h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" action="editarHorario.php" method="post" enctype="multipart/form-data" novalidate>               
            <input type="hidden" id="idHorario" name="idHorario">
            <div class="mb-3 text-center">
                <label for="horasalida" class="form-label text-secondary"><em>Hora de salida: </em></label>
                <input type="time" id="horasalida" name="horasalida" class="form-control" required>
                <div class="invalid-feedback">
                  Es necesario establecer una hora.
                </div>        
            </div>	
            
            <div class="mb-3 text-center">
                <label for="horallegada" class="form-label text-secondary"><em>Hora de llegada:</em></label>
                <input type="time" id="horallegada" name="horallegada" class="form-control" required>
                <div class="invalid-feedback">
                  Es necesario establecer una hora.
                </div>        
            </div>	
        
        <div class="mb-3 text-center">
                <label for="select_ruta" class="form-label text-secondary"><em>Ruta:</em></label>
                <select name="select_ruta" id="select_ruta" class="form-control"  aria-label="Default select example" required>
                   <option value="">Seleccionar...</option>
                   <?php
                    require '../config/database.php';
                            while ($registroHorario = $select_horario->fetch_assoc()) { ?>
                            <option value="<?php echo $registroHorario["id_ruta"]; ?>"><?=$registroHorario["lugar_origen"].'-'. $registroHorario["lugar_destino"]?></option>
                        <?php   } ?>
                </select>
                <div class="invalid-feedback">
                  Debe seleccionar una ruta.
                </div>        
            </div>
        
            <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Actualizar Horario</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// script: Funciona para validar campos vacios
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