let paginaActual = 1;
getData(paginaActual)

document.getElementById("campo").addEventListener("keyup", function() {
    getData(1)
}, false)

document.getElementById("num_registros").addEventListener("change", function() {
    getData(paginaActual)
}, false)

function getData(pagina) {
    let input = document.getElementById("campo").value
    let num_registros = document.getElementById("num_registros").value
    let content = document.getElementById("content")


    if (pagina != null) {
        paginaActual = pagina;
    }

    let url = "load_rutas.php";
    let formaData = new FormData()

    formaData.append('campo', input)
    formaData.append('registros', num_registros)
    formaData.append('pagina', pagina)

    fetch(url, {
            method: 'POST',
            body: formaData
        }).then(response => response.json())
        .then(data => {
            content.innerHTML = data.data
            document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                ' de ' + data.totalRegistros + ' registros';
            document.getElementById("nav-paginacion").innerHTML = data.paginacion;

        }).catch(err => console.log(err))
}
