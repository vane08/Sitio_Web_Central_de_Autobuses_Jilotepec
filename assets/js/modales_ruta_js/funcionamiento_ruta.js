       
let editaModal = document.getElementById('editaModalRuta');
let nuevoModal = document.getElementById('nuevoModalRuta');
let eliminaModal = document.getElementById('eliminaModalRuta');

nuevoModal.addEventListener('shown.bs.modal', event => {
    nuevoModal.querySelector('.modal-body #lugarOrigenRuta').focus()
})

editaModal.addEventListener('shown.bs.modal', event => {
    editaModal.querySelector('.modal-body #lugarOrigenRuta').focus()
})

nuevoModal.addEventListener('hide.bs.modal', event => {
    nuevoModal.querySelector('.modal-body #lugarOrigenRuta').value = "";
})

nuevoModal.addEventListener('hide.bs.modal', event => {
    nuevoModal.querySelector('.modal-body #lugarDestinoRuta').value = "";
})

editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');

    let inputId = editaModal.querySelector('.modal-body #idRuta');
    let inputlugarOrigenRuta = editaModal.querySelector('.modal-body #lugarOrigenRuta');
    let inputlugarDestinoRuta = editaModal.querySelector('.modal-body #lugarDestinoRuta');

    let url = "getRuta.php";
    let formData = new FormData();
    formData.append('id_ruta', id);

    fetch(url, {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {

            inputId.value = data.id_ruta;
            inputlugarOrigenRuta.value = data.Origen;
            inputlugarDestinoRuta.value = data.Destino;
        }).catch(err => console.log(err))

})


eliminaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');
    eliminaModal.querySelector('.modal-footer #id_ruta').value = id
})