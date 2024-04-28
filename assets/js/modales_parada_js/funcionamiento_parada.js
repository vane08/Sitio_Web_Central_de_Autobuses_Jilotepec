
    let nuevoModal = document.getElementById('nuevoModal_paradas');
    let editaModal = document.getElementById('editaModal_paradas');
    let eliminaModal = document.getElementById('eliminaModal_paradas');

    // Inicia seccion para focus de los modales en paradas
    nuevoModal.addEventListener('shown.bs.modal', event => {
        nuevoModal.querySelector('.modal-body #nombre_p').focus()
    })
    editaModal.addEventListener('shown.bs.modal', event => {
        editaModal.querySelector('.modal-body #nombre_p').focus()
    })
    // Termina seccion para focus de los modales en paradas

    // Inicia seccion para limpiar componentes de los modales en paradas
    nuevoModal.addEventListener('hide.bs.modal', event => {
        nuevoModal.querySelector('.modal-body #nombre_p').value = "";
    })

    editaModal.addEventListener('hide.bs.modal', event => {
        editaModal.querySelector('.modal-body #nombre_p').value = "";
    })
    // Termina seccion para limpiar componentes de los modales en paradas

    // Inicia parte de UPDATE paradas
    editaModal.addEventListener('shown.bs.modal', event => {
        let button = event.relatedTarget
        let id = button.getAttribute('data-bs-id');

        let inputId = editaModal.querySelector('.modal-body #id');
        let inputNombreParada = editaModal.querySelector('.modal-body #nombre_p');
        let inputEstatus = editaModal.querySelector('.modal-body #select_ruta-parada');

        let url = "get_parada.php";
        let formData = new FormData();
        formData.append('id_parada', id);

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputId.value = data.id_parada;
                inputNombreParada.value = data.nombre_parada;
                inputEstatus.value = data.ruta;
            }).catch(err => console.log(err))

    })
    // Termina parte de UPDATE paradas

    // Inicia parte de DELTE paradas
    eliminaModal.addEventListener('shown.bs.modal', event => {
        let button = event.relatedTarget
        let id = button.getAttribute('data-bs-id');
        eliminaModal.querySelector('.modal-footer #id').value = id
    })
    // Termina parte de DELETE paradas

