<!-- Modal de insertar rutas -->
<div class="modal fade" id="nuevoModal_boletos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoModal_boletos_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="nuevoModal_boletos_label">Inserción de boletos de bús</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="needs-validation" action="guarda_b.php" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" class="form-control" id="id" placeholder="ID">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-8 m-2"></div>

                            <div class="col-12 col-md-6">
                                <label for="ruta_boleto">Ruta:</label>
                                <select name="boleto_ruta" id="boleto_ruta" class="form-select" required>
                                    <option selected disabled value=''>Seleccione una ruta</option>
                                    <?php
                                    while ($row_select_p = $select_parada->fetch_assoc()) { ?>
                                        <option value="<?php echo $row_select_p["id_ruta"]; ?>"><?= $row_select_p["Origen"] . '-' . $row_select_p["Destino"] ?></option>
                                    <?php   } ?>
                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    Elige una ruta.
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="ruta_boleto">Parada:</label>
                                <select name="boleto_parada" id="boleto_parada" class="form-select" required>
                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    Elige una parada.
                                </div>
                            </div>
                            <!-- Esta parte es del input para ingresar el precio de boleto: -->
                            <div class="col-12 col-md-5 mt-3">
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
                                <!-- Aqui termina -->
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end justify-content-end mb-2 mt-3">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Registrar boleto de bús</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>

<!-- Esta parte funciona para que se muestre el segundo select a partir de el valor seleccionado del segundo -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    <?php include('../../assets/js/validacion_campos.js'); ?>
</script>