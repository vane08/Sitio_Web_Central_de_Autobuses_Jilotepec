<?php
session_start();
if ($_SESSION['acceso'] == 'acceso') {


    require '../config/database.php';

    $columns = ['id_horario', 'horaSalida', 'horaLlegada', 'Origen', 'Destino'];
    $table = "horario";
    $id = 'id_horario';
    $pagina = isset($_POST['pagina']) ? $conectar->real_escape_string($_POST['pagina']) : 0;
    $campo = isset($_POST['campo']) ? $conectar->real_escape_string($_POST['campo']) : null;

    //parte del limit
    $limit = isset($_POST['registros']) ? $conectar->real_escape_string($_POST['registros']) : 10;
    // $pagina = isset($_POST['pagina']) ? $conectar->real_escape_string($_POST['pagina']) : 0;
    // echo $limit;
    // exit;


    if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $limit;
    }
    $sLimit = "LIMIT $inicio , $limit";




    $sql = 'SELECT SQL_CALC_FOUND_ROWS horario.id_horario, 
TIME_FORMAT(horario.hora_salida, "%h : %i %p") AS horaSalida,
TIME_FORMAT( horario.hora_llegada, "%h : %i %p") AS horaLLegada, 
L.nombre_lugar AS Origen, 
LD.nombre_lugar AS Destino 
FROM horario
INNER JOIN ruta AS R ON horario.ruta=R.id_ruta
JOIN Lugar AS L ON R.origen = L.id_lugares
JOIN Lugar AS LD ON R.destino = LD.id_lugares
WHERE horario.estatus = 1 AND R.estatus = 1 AND L.estatus = 1 AND LD.estatus = 1 AND 
(
id_horario LIKE "%' . $campo . '%" OR
TIME_FORMAT(horario.hora_salida, "%h : %i %p") LIKE "%' . $campo . '%" OR
TIME_FORMAT( horario.hora_llegada, "%h : %i %p") LIKE "%' . $campo . '%" OR 
L.nombre_lugar LIKE "%' . $campo . '%" OR
LD.nombre_lugar LIKE "%' . $campo . '%"
)' . $sLimit;

    $resultado = $conectar->query($sql);
    $num_rows = $resultado->num_rows;


    /* Consulta para total de registro filtrados */
    $sqlFiltro = "SELECT FOUND_ROWS()";
    $resFiltro = $conectar->query($sqlFiltro);
    $row_filtro = $resFiltro->fetch_array();
    $totalFiltro = $row_filtro[0];

    /* Consulta para total de registro filtrados */
    $sqlTotal = "SELECT count($id) FROM horario
INNER JOIN ruta AS R ON horario.ruta=R.id_ruta
JOIN Lugar AS L ON R.origen = L.id_lugares
JOIN Lugar AS LD ON R.destino = LD.id_lugares
WHERE horario.estatus = 1 AND R.estatus = 1 AND L.estatus = 1 AND LD.estatus = 1";
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
            $output['data'] .= '<td>' . $row['id_horario'] . '</td>';
            $output['data'] .= '<td>' . $row['horaSalida'] . '</td>';
            $output['data'] .= '<td>' . $row['horaLLegada'] . '</td>';
            $output['data'] .= '<td>' . $row['Origen'] . '-' . $row['Destino'] . '</td>';

            $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarModalHorario" data-bs-id="' . $row['id_horario'] . '">Editar</a></div></td> ';
            $output['data'] .= '<td><div class="text-center"><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModalHorario" data-bs-id="' . $row['id_horario'] . '">Eliminar</a></td>';
            $output['data'] .= '</tr>';
        }
    } else {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td colspan="7">Sin resultados</td>';
        $output['data'] .= '</tr>';
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
