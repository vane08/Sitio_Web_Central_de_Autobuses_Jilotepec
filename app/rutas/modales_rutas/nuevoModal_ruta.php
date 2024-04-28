<!-- Modal -->
<div class="modal fade" id="nuevoModalRuta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoModalRutaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-light" id="nuevoModalRutaLabel"> Nueva Ruta</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" action="guardaRuta.php" method="post" enctype="multipart/form-data" novalidate>               
            <div class="mb-3 text-center">
                <label for="lugarOrigenRuta" class="form-label">Lugar de origen de la ruta: </label>
                <select name="lugarOrigenRuta" id="lugarOrigenRuta" class="form-control border border-primary"  required>
                   <option value="">Seleccionar...</option>
                    <?php
                     # Mostrar en seleccionar lugares
              
                     $consulta = "SELECT id_lugares,nombre_lugar 
                     FROM lugar 
                     WHERE estatus =1 
                     ORDER BY nombre_lugar ASC";
                     $lugares = mysqli_query($conectar,$consulta);
                     while ($regLugares = mysqli_fetch_array( $lugares)) {
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
                     # Mostrar en seleccionar lugares
                     include("../config/database.php");
                     $consulta = "SELECT id_lugares,nombre_lugar 
                     FROM lugar 
                     WHERE estatus =1
                     ORDER BY nombre_lugar ASC";
                     $lugares = mysqli_query($conectar,$consulta);
                     while ($regLugares = mysqli_fetch_array( $lugares)) {
                        echo " '<option value = '" .$regLugares[1] . "'>".
                        $regLugares[1] ."</option>";
                    } 
                    ?>
                </select>       
            </div>
        
            <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar Ruta</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- <div class="mb-3 text-center">
                <label for="horallegada" class="form-label">Hora de llegada: </label>
                <input type="time" id="horallegada" name="horallegada" required>
                <div class="invalid-feedback">
                  Es necesario establecer una hora.
                </div>        
            </div> -->