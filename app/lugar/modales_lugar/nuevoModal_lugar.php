<!-- Modal agregar lugar -->
<div class="modal fade" id="nuevoModalLugar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoModalLugarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-light" id="nuevoModalLugarLabel"> Nuevo Lugar</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">
          <form class="needs-validation" action="guardarL.php" method="post" enctype="multipart/form-data" novalidate>

            <div class="row">
              <div class="col-12 col-md-12">
    
                  <label for="nombreLugar" class="form-label">Nueva Parada a Agregar:</label>
                        <input type="text" class="form-control" id="nombreLugar" name="nombreLugar" required>
                        <div class="invalid-feedback">
                            Es necesario colocar un nombre.
                        </div>
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2 mt-3">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar Lugar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Poner script de validaciones de bootstrap  -->