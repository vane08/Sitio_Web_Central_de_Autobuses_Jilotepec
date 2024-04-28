<?php
session_start();

if($_SESSION['acceso'] == 'acceso'){

    require '../config/database.php';

$columns = ['id_lugares', 'nombre_lugar'];
$table = "lugar";
$id = 'id_lugares';
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


$where = '';

if($campo != null){
    $where = "WHERE lugar.estatus = 1 AND (";

    $cont = count($columns);
    for($i = 0; $i < $cont; $i++){
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ") AND estatus =1";
}else{
    $where = "WHERE estatus = 1"; 
}

$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where 
$sLimit";

$resultado = $conectar->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conectar->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table WHERE estatus = 1";
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
        $output['data'] .= '<td class="text-center">'.$row['id_lugares'].'</td>';
        $output['data'] .= '<td class="text-center">'.$row['nombre_lugar'].'</td>';
        $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModalLugar" data-bs-id="'.$row['id_lugares'] .'">Editar</a></div></td> ';
        $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModalLugar" data-bs-id="'. $row['id_lugares'] .'">Eliminar</a></td>';
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

    }else{
        header ("location: ../error.php");
    }
?>