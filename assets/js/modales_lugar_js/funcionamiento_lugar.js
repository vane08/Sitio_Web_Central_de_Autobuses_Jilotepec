let editaModal = document.getElementById('editaModalLugar');

editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id'); //id_lugares

    let inputId = editaModal.querySelector('.modal-body #idL').value = id
    let inputNombreLugar = editaModal.querySelector('.modal-body #nombreLugar');

    let url = "getLugar.php";
    let formData = new FormData();
    formData.append('id_lugares', id);

    fetch(url, {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            inputId.value = data.id_lugares;
            inputNombreLugar.value = data.nombre_lugar;
        }).catch(err => console.log(err))

})

let eliminaModal = document.getElementById('eliminaModalLugar')

eliminaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');
    eliminaModal.querySelector('.modal-footer #id_lugares').value = id
})