<!-- Modal de actualizar boleto -->
<div class="modal fade" id="editaModal_boletos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editaModal_boletos_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5 text-light" id="editaModal_boletos_label">Actualización de boletos de bús</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="needs-validation" action="edita_b.php" method="post" novalidate>
                    <input type="hidden" name="id_boleto" id="id_boleto" placeholder="ID">

                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12 col-md-6">
                                <label for="lbl_ruta">Ruta a editar:</label>
                                <input id="lbl_ruta" class="text-center bg-white form-control form-control-sm text-dark border border-success" type="text" disabled readonly>

                                <label for="ruta_boleto_act">Nueva Ruta:</label>
                                <select name="boleto_ruta_a" id="boleto_ruta_a" class="form-select" required>
                                    <option selected disabled value="">Elige una ruta</option>
                                    <?php
                                    while ($row_select_p = $select_parada->fetch_assoc()) { ?>
                                        <option value="<?php echo $row_select_p["id_ruta"]; ?>"><?= $row_select_p["Origen"] . '-' . $row_select_p["Destino"] ?></option>
                                    <?php } ?>
                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    Elige una ruta.
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="lbl_parada">Parada a editar:</label>
                                <input id="lbl_parada" class="text-center bg-white form-control form-control-sm text-dark border border-success" type="text" disabled readonly>
                                <label for="ruta_boleto_act">Parada:</label>
                                <select name="boleto_parada_a" id="boleto_parada_a" class="form-select" required>

                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    Elige una parada.
                                </div>
                            </div>

                            <!-- Esta parte es del input para ingresar el precio de boleto: -->
                            <div class="col-12 col-md-6 pb-2">

                                <label for="precio_boleto">Precio del boleto:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input id="precio_boleto" name="precio_boleto" type="number" class="form-control" placeholder="Digite el precio del boleto..." required>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa una cantidad.
                                    </div>
                                </div>
                            </div>
                            <!-- Aqui termina input para ingresar precio de boleto-->

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2 mt-3">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning">Actualizar boleto de bús</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<!-- Este escript funciona para las validaciones de campos vacios, -->
<!-- si llegas hasta aqui, basicamente lo que hice fue ver este video: https://www.youtube.com/watch?v=hcno1fusrR8&t=344s, todo esta ahi, nada del otro mundo -->
<script>
    <?php include('../../assets/js/validacion_campos.js'); ?>
</script>