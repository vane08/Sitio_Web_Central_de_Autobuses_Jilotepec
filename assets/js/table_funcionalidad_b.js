
let paginaActual = 1;
getData(paginaActual);
//esta funcion sirve para mostrar datos en la tabla

document.getElementById("campo_b").addEventListener("keyup",function(){
    getData(1)
},false);
document.getElementById("num_registros_b").addEventListener("change", function(){
    getData(paginaActual)
},false);

// esta es la peticion ajax 
function getData(pagina) {
    let input = document.getElementById("campo_b").value 
    let content = document.getElementById("content_b")
    let num_registros_b = document.getElementById("num_registros_b").value


    if(pagina != null){
        paginaActual = pagina;
    }

    let url = "vista_table_b.php";
    let formaData = new FormData();
    formaData.append('campo_b', input);
    formaData.append('num_registros_b', num_registros_b);
    formaData.append('pagina', paginaActual);



    fetch(url, {
            method: "POST",
            body: formaData
        }).then(response => response.json())
        .then(data => {
            content.innerHTML = data.data
            document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro 
            + ' de ' + data.totalRegistros + ' registros'
            document.getElementById("nav-paginacion").innerHTML = data.paginacion
        }).catch(err => console.log(err))
}
