// Este funciona con el segundo video que te mande 

let paginaActual_p = 1;
getData(paginaActual_p)

document.getElementById("campo_p").addEventListener("keyup",function(){
    getData(1)
},false)

document.getElementById("num_registros_p").addEventListener("change", function(){
    getData(paginaActual_p)
},false)

function getData(pagina) {
    let input = document.getElementById("campo_p").value
    let num_registros_p = document.getElementById("num_registros_p").value
    let content = document.getElementById("content_p")

    if (pagina != null) {
        paginaActual_p = pagina;
    }

    let url = "vista_table_p.php";
    let formaData = new FormData();

    formaData.append('campo_p', input)
    formaData.append('registros', num_registros_p)
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
