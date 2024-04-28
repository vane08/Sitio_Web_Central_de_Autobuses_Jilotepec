let nuevoModal = document.getElementById('nuevoModalHorario');
let editaModal = document.getElementById('editarModalHorario');

nuevoModal.addEventListener('shown.bs.modal', event => {
nuevoModal.querySelector('.modal-body #horasalida').focus()
})
editaModal.addEventListener('shown.bs.modal', event => {
editaModal.querySelector('.modal-body #horasalida').focus()
})


nuevoModal.addEventListener('hide.bs.modal', event => {
nuevoModal.querySelector('.modal-body #horasalida').value = "";
})

nuevoModal.addEventListener('hide.bs.modal', event => {
nuevoModal.querySelector('.modal-body #horallegada').value = "";
})
nuevoModal.addEventListener('hide.bs.modal', event => {
nuevoModal.querySelector('.modal-body #select_ruta').value = "";
})

editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id'); //id_horario

    let inputId = editaModal.querySelector('.modal-body #idHorario');
    let inputHoraSalida = editaModal.querySelector('.modal-body #horasalida');
    let inputHoraLlegada = editaModal.querySelector('.modal-body #horallegada');
    let inputRuta = editaModal.querySelector('.modal-body #select_ruta');

    let url = "getHorario.php";
    let formData = new FormData();
    formData.append('id_horario', id);

    fetch(url, {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            inputId.value = data.id_horario;
            inputHoraSalida.value = data.hora_salida;
            inputHoraLlegada.value = data.hora_llegada;
            inputRuta.value = data.ruta;
        }).catch(err => console.log(err))

})
let eliminaModal = document.getElementById('eliminaModalHorario')

eliminaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');
    eliminaModal.querySelector('.modal-footer #idHorario').value = id
})