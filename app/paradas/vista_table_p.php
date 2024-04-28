<?php 
session_start();
if ($_SESSION['acceso'] == 'acceso') {
require '../config/database.php';

$columns = ['id_parada', 'nombre_parada'];
$table = "parada";
$id = 'id_parada';
$campo = isset($_POST['campo_p']) ? $conectar->real_escape_string($_POST['campo_p']) : null; 
$pagina = isset($_POST['pagina']) ? $conectar->real_escape_string($_POST['pagina']) : 0;

//parte del limit
$limit = isset($_POST['registros']) ? $conectar->real_escape_string($_POST['registros']) : 10;
// $pagina = isset($_POST['pagina']) ? $conectar->real_escape_string($_POST['pagina']) : 0;

if(!$pagina){
    $inicio = 0;
    $pagina = 1;

}else{
    $inicio = ($pagina -1) * $limit;
}
$sLimit = "LIMIT $inicio , $limit";


//consulta principal
$sql = "SELECT SQL_CALC_FOUND_ROWS parada.id_parada, 
parada.nombre_parada, 
L.nombre_lugar as Origen, 
LD.nombre_lugar as Destino  
from Ruta as R
join Lugar as L 
on R.origen = L.id_lugares
join Lugar as LD 
on R.destino = LD.id_lugares 
INNER JOIN parada 
ON ruta = R.id_ruta 
WHERE L.estatus = 1 AND LD.estatus = 1 AND R.estatus = 1 AND
(id_parada 
LIKE '%".$campo."%' OR nombre_parada 
LIKE '%".$campo."%' OR L.nombre_lugar 
LIKE '%".$campo."%' OR LD.nombre_lugar
LIKE '%".$campo."%') 
AND parada.estatus = 1  
$sLimit ;";
$resultado = $conectar ->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conectar->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) from Ruta as R
join Lugar as L 
on R.origen = L.id_lugares
join Lugar as LD 
on R.destino = LD.id_lugares 
INNER JOIN parada 
ON ruta = R.id_ruta 
WHERE L.estatus = 1 AND LD.estatus = 1 AND R.estatus = 1";
$resTotal = $conectar->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

// echo $sql;
// exit;
if ($num_rows > 0) {
    while($row =$resultado->fetch_assoc()){
        $output['data'] .= '<tr>';
        $output['data'] .= '<td class="text-center">'.$row['id_parada'].'</td> ';
        $output['data'] .= '<td class="text-center">'.$row['nombre_parada'].'</td> ';
        $output['data'] .= '<td  class="text-center">'.$row['Origen'].' - '.$row['Destino'].'</td> ';
        $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal_paradas" data-bs-id="'.$row['id_parada'] .'">Editar</a></div></td> ';
        $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal_paradas" data-bs-id="'. $row['id_parada'] .'">Eliminar</a></td>';
        $output['data'] .= '</tr>';
    }
}else{
    $output['data'] .='<tr>';
    $output['data'] .='<td class="text-center" colspan="7">Sin resultados</td>';
    $output['data'] .='</tr>';
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
