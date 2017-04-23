<?php
require_once './includes/Conector.php';
require_once './includes/functions.php';

$filtro ='';
$motes = array();
$cat_codigo = isset($_GET['categoria_id']) ? $_GET['categoria_id']: 0;
$mote_nombre = isset($_GET['mote_nombre']) ? $_GET['mote_nombre']: 0;

if ($cat_codigo) {
    $filtro = 'AND cat_codigo= '.$cat_codigo;
}
if ($mote_nombre){
    $filtro = 'AND mote_nombre like "%'.$mote_nombre.'%"';
}

$conexion = new Conector();
$sql = 'SELECT * FROM motes INNER JOIN categorias ON mote_categoria = cat_codigo WHERE 1=1 '.$filtro;
echo $sql;
$res = $conexion->ejecutar($sql);
while ($mote = mysqli_fetch_assoc($res)) {
    
    $motej = new stdClass();
    $motej -> nombre = $mote['mote_nombre'];
    $motej -> categoria = $mote['cat_nombre'];
    $motej -> class = to_css($mote['cat_nombre']);
    $motej -> id = $mote['mote_codigo'];
    array_push($motes, $motej);
}
echo json_encode($motes);