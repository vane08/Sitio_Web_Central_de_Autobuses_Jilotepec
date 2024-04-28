let nuevoModal = document.getElementById('nuevoModal_boletos');
let editaModal = document.getElementById('editaModal_boletos');
let eliminaModal = document.getElementById('eliminaModal_boletos');

nuevoModal.addEventListener('hide.bs.modal', event =>{
    nuevoModal.querySelector('.modal-body #precio_boleto').value = "";
    nuevoModal.querySelector('.modal-body #boleto_ruta').value = "0";
})

editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');
    let inputId = editaModal.querySelector('.modal-body #id_boleto');
    let inputPrecio_boleto = editaModal.querySelector('.modal-body #precio_boleto');
    let inputRuta_boleto = editaModal.querySelector('.modal-body #boleto_ruta_a');
    let inputParada_ruta = editaModal.querySelector('.modal-body #boleto_parada_a');
    let inputlabel_ruta = editaModal.querySelector('.modal-body #lbl_ruta');
    let inputlbl_parada = editaModal.querySelector('.modal-body #lbl_parada');
   
    let url = "get_boleto.php"
    let formData = new FormData()
    formData.append('id_boleto', id)
    fetch(url, {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            inputId.value = data.id_tarifa
            inputPrecio_boleto.value = data.precio_boleto
            inputlabel_ruta.value = data.Origen +'-' + data.Destino
            inputlbl_parada.value = data.parada_n;
        }).catch(err => console.log(err))
})


eliminaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');
    eliminaModal.querySelector('.modal-footer #id').value = id
})