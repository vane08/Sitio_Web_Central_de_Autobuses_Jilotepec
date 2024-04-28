<!-- Modal -->
<div class="modal fade" id="eliminaModalRuta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="eliminaModalRutaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h1 class="modal-title fs-5 text-light" id="eliminaModalRutaLabel"> Aviso</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el registro de esta ruta?
      </div>

      <div class="modal-footer">
        <form action="elimina_ruta.php" method="post">
        <input type="hidden" name="id_ruta" id="id_ruta">   
            <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar Ruta</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


