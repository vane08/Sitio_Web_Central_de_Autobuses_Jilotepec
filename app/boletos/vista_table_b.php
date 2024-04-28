<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {

    require '../config/database.php';



    $table = "tarifa";
    $id = 'id_tarifa';
    $campo = isset($_POST['campo_b']) ? $conectar->real_escape_string($_POST['campo_b']) : null;

    //parte del limit
    $limit = isset($_POST['num_registros_b']) ? $conectar->real_escape_string($_POST['num_registros_b']) : 10;
    $pagina = isset($_POST['pagina']) ? $conectar->real_escape_string($_POST['pagina']) : 0;

    if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $limit;
    }

    $sLimit = "LIMIT $inicio, $limit";
    //consulta principal
    $sql = "SELECT SQL_CALC_FOUND_ROWS 
tarifa.id_tarifa,
parada.nombre_parada, 
lugarOrigen.nombre_lugar AS lugar_origen, 
lugarDestino.nombre_lugar AS lugar_destino,
tarifa.precio_boleto
FROM tarifa
INNER JOIN parada ON tarifa.parada=parada.id_parada
INNER JOIN ruta AS r ON parada.ruta = r.id_ruta
INNER JOIN lugar AS lugarOrigen ON r.origen=lugarOrigen.id_lugares 
INNER JOIN lugar AS lugarDestino ON r.destino=lugarDestino.id_lugares
WHERE tarifa.estatus = 1 AND parada.estatus = 1 AND r.estatus = 1 
AND  lugarOrigen.estatus = 1 AND lugarDestino.estatus = 1 AND
(id_tarifa LIKE '%" . $campo . "%' 
OR precio_boleto LIKE '%" . $campo . "%'
OR lugarOrigen.nombre_lugar LIKE '%" . $campo . "%'
OR lugarDestino.nombre_lugar LIKE '%" . $campo . "%'
OR nombre_parada LIKE '%" . $campo . "%'
) AND tarifa.estatus = 1
$sLimit;";


    $resultado = $conectar->query($sql);
    $num_rows = $resultado->num_rows;


    /* Consulta para total de registro filtrados */
    $sqlFiltro = "SELECT FOUND_ROWS()";
    $resFiltro = $conectar->query($sqlFiltro);
    $row_filtro = $resFiltro->fetch_array();
    $totalFiltro = $row_filtro[0];

    /* Consulta para total de registro filtrados */
    //aqui tal vez hay qua hcerle modificaciones porque no me muestra todos, hay que ver que onda
    $sqlTotal = "SELECT count($id)
FROM tarifa
INNER JOIN parada ON tarifa.parada=parada.id_parada
INNER JOIN ruta AS r ON parada.ruta = r.id_ruta
INNER JOIN lugar AS lugarOrigen ON r.origen=lugarOrigen.id_lugares 
INNER JOIN lugar AS lugarDestino ON r.destino=lugarDestino.id_lugares
WHERE tarifa.estatus = 1 AND parada.estatus = 1 AND r.estatus = 1 
AND  lugarOrigen.estatus = 1 AND lugarDestino.estatus = 1";
    $resTotal = $conectar->query($sqlTotal);
    $row_total = $resTotal->fetch_array();
    $totalRegistros = $row_total[0];

    /* Mostrado resultados */
    $output = [];
    $output['totalRegistros'] = $totalRegistros;
    $output['totalFiltro'] = $totalFiltro;
    $output['data'] = '';
    $output['paginacion'] = '';


    if ($num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $output['data'] .= '<tr>';
            $output['data']  .= '<td class="text-center">' . $row['id_tarifa'] . '</td> ';
            $output['data']  .= '<td  class="text-center">' . $row['nombre_parada'] . '</td> ';
            $output['data']  .= '<td  class="text-center">' . $row['lugar_origen'] . ' - ' . $row['lugar_destino'] . '</td> ';
            $output['data']  .= '<td  class="text-center">$' . $row['precio_boleto'] . '</td> ';


            $output['data']  .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal_boletos" data-bs-id="' . $row['id_tarifa'] . '">Editar</a></id=div></td> ';
            $output['data']  .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal_boletos" data-bs-id="' . $row['id_tarifa'] . '">Eliminar</a></td>';
            $output['data']  .= '</tr>';
        }
    } else {
        $output['data'] .= '<tr>';
        $output['data']  .= '<td class="text-center" colspan="7">Sin resultados</td>';
        $output['data']  .= '</tr>';
    }


    if ($output['totalRegistros'] > 0) {
        $totalPaginas = ceil($output['totalRegistros'] / $limit);

        $output['paginacion'] .= '<nav>';
        $output['paginacion'] .= '<ul class="pagination">';

        $numeroInicio = 1;

        if (($pagina - 4) > 1) {
            $numeroInicio = $pagina - 4;
        }
        $numeroFin = $numeroInicio + 9;
        if ($numeroFin > $totalPaginas) {
            $numeroFin = $totalPaginas;
        }
        for ($i = $numeroInicio; $i <= $totalPaginas; $i++) {
            if ($pagina == $i) {
                $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#" >' . $i . '</a></li>';
            } else {
                $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="getData(' . $i . ')">' . $i . '</a></li>';
            }
        }

        $output['paginacion'] .= '</ul">';
        $output['paginacion'] .= '</nav>';
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} else {
    header("location: ../error.php");
}
