<?php
include './includes/Conector.php';
include './includes/functions.php';

$nombre = isset($_POST['nombre_nuevo']) ? $_POST['nombre_nuevo'] : '';
$categoria = isset($_POST['categoria_nuevo']) ? $_POST['categoria_nuevo'] : '';
$output = new stdClass();
$output -> state = 0;
$output -> mensaje = 'Emm buenas tardes, no se ha guardado.';
$output -> clase = 'error';

$conexion = new Conector();
$sql = 'INSERT INTO motes (mote_nombre,mote_categoria) VALUES ("' . $nombre . '",' . $categoria . ')';
if ($conexion->ejecutar($sql)) {
    $output -> state = 1;
    $output -> mensaje = 'Chupitruski, guardado.';
    $output -> clase = 'exito';
} 
echo json_encode($output);