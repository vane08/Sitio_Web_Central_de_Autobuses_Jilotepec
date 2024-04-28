<!-- Modal de actualiza rutas -->
<div class="modal fade" id="editaModalLugar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editaModalLugarlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-light" id="editaModalLugarlabel">Editar Lugar</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="needs-validation" action="actualizarLugar.php" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" id="idL" name="idL">
                 
                    <div class="mb-3">
                        <label for="nombreLugar" class="form-label">Nombre de lugar a editar:</label>
                        <input type="text" class="form-control" id="nombreLugar" name="nombreLugar" required>
                    </div>


                    <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Editar Lugar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
