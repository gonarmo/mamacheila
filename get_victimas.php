<?php
require_once './includes/Conector.php';
require_once './includes/functions.php';

$filtro ='';
$victimas = array();
$mote_id = isset($_GET['mote_id']) ? $_GET['mote_id']: 0;

if ($mote_id) {
    $filtro = 'AND mote_codigo= '.$mote_id;
}

$conexion = new Conector();
$sql = 'SELECT * FROM motes INNER JOIN victimas ON vic_mote = mote_codigo WHERE 1=1 '.$filtro;

$res = $conexion->ejecutar($sql);
while ($victima = mysqli_fetch_assoc($res)) {
    $victimaj = new stdClass();
    $victimaj -> nombre = $victima['vic_nombre'];
    array_push($victimas, $victimaj);
}
echo json_encode($victimas);