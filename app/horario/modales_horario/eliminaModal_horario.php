<!-- Modal eliminar horario -->
<div class="modal fade" id="eliminaModalHorario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="eliminaModalHorariolabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-light" id="eliminaModalHorariolabel"><em>Aviso<em></h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                ¿Desea eliminar el registro?, Se eliminarán los registros que esten comprometidos con este dato.
            </div>

            <div class="modal-footer">
                <form action="eliminaHorario.php" method="post">
                    <input type="hidden" name="idHorario" id="idHorario">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar Horario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>