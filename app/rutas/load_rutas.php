<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {
require '../config/database.php';


$table = "ruta";
$id = 'id_ruta';
$campo = isset($_POST['campo']) ? $conectar->real_escape_string($_POST['campo']) : null;
$pagina = isset($_POST['pagina']) ? $conectar->real_escape_string($_POST['pagina']) : 0;    
$limit = isset($_POST['registros']) ? $conectar->real_escape_string($_POST['registros']) : 10;


if(!$pagina){
    $inicio = 0;
    $pagina = 1;

}else{
    $inicio = ($pagina -1) * $limit;

}
$sLimit = "LIMIT $inicio , $limit";


$sql = "SELECT SQL_CALC_FOUND_ROWS id_ruta, L.nombre_lugar AS Origen, LD.nombre_lugar AS Destino
FROM Ruta AS R
JOIN Lugar AS L ON R.origen = L.id_lugares
JOIN Lugar AS LD ON R.destino = LD.id_lugares
WHERE R.estatus = 1 AND L.estatus = 1 AND LD.estatus = 1 
AND
(id_ruta LIKE '%".$campo."%' OR
L.nombre_lugar LIKE '%".$campo."%' OR 
LD.nombre_lugar LIKE '%".$campo."%')  
$sLimit";

$resultado = $conectar->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conectar->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "
SELECT COUNT(id_ruta)
FROM ruta
JOIN lugar AS lugarOrigen ON ruta.origen = lugarOrigen.id_lugares 
JOIN lugar AS lugarDestino ON ruta.destino = lugarDestino.id_lugares
WHERE lugarOrigen.estatus = 1 AND lugarDestino.estatus = 1 AND ruta.estatus = 1
";
$resTotal = $conectar->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';



// $html = '';

if($num_rows > 0){
    while ($row = $resultado->fetch_assoc()){
        $output['data'] .= '<tr>';
        $output['data'] .= '<td class="text-center">'.$row['id_ruta'].'</td>';
        $output['data'] .= '<td class="text-center">'.$row['Origen'].'</td>';
        $output['data'] .= '<td class="text-center">'.$row['Destino'].'</td>';
        $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModalRuta" data-bs-id="'.$row['id_ruta'] .'">Editar</a></div></td> ';
        $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModalRuta" data-bs-id="'. $row['id_ruta'] .'">Eliminar</a></td>';
        $output['data'] .= '</tr>';      
    }
} else { 
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="4">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if($output['totalRegistros']>0){
    $totalPaginas =ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .='<nav>';
    $output['paginacion'] .='<ul class="pagination">';

    $numeroInicio = 1;
    
    if(($pagina -4 )>1){
        $numeroInicio =$pagina -4; 
    }
    $numeroFin = $numeroInicio + 9;
    if ($numeroFin > $totalPaginas) {
        $numeroFin = $totalPaginas;
    }
    for ($i=$numeroInicio; $i <=$totalPaginas ; $i++) { 
        if($pagina == $i){
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#" >'.$i.'</a></li>';

        }else{
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="getData('.$i.')">'.$i.'</a></li>';
        }
     
    }

    $output['paginacion'] .='</ul">';
    $output['paginacion'] .='</nav>';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
} else {
    header("location: ../error.php");
}
?>