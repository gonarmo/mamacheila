<?php
include './includes/Conector.php';
include './includes/functions.php';
$conexion = new Conector();
$sql = 'SELECT * FROM motes INNER JOIN categorias ON mote_categoria = cat_codigo';
$res = $conexion->ejecutar($sql); //todos los motes

$sql = 'SELECT * FROM categorias';
$res_cat = $conexion->ejecutar($sql);
$select_categorias = '';
while ($categoria = mysqli_fetch_assoc($res_cat)) {
    $select_categorias .= '<option value="' . $categoria['cat_codigo'] . '"> ' . $categoria['cat_nombre'] . '</option>';
}
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="js/functions.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="content">
            <div class="filters">
                <div class="buscador">
                    <input type="text" id="buscador" placeholder="Buscar..." >
                </div>
                <div class="categorias">
                    <p>Categorías</p>
                    <select id="categoria" onchange="busqueda()">
                        <option value="0">Todas</option>
                        <?php echo $select_categorias; ?>  
                    </select>
                </div>
                <div class="add" onclick="habilitar_nuevo()">+</div>
            </div>
            <div id="motes" class="motes">
                <?php
                while ($mote = mysqli_fetch_assoc($res)) {
                    echo '<div class="mote ' . to_css($mote['cat_nombre']) . '" title="Categoría: ' .
                    $mote['cat_nombre'] . '" data-to="' . $mote['mote_codigo'] .
                    '" >' . $mote['mote_nombre'] . '</div>';
                }
                ?>               
            </div>
            <div class="victimas" id="victimas">
                <small>Ningún mote seleccionado.</small>
            </div>
        </div>
        <div id="bloqueador">
            <div id="modal">
                <div class="campo">
                    <span>Nombre</span>
                    <input type="text" id="nombre_nuevo" class="">
                </div>
                <div class="campo">
                    <span>Categoría</span>
                    <select  id="categoria_nuevo">
                        <?php echo $select_categorias; ?>  
                    </select>
                </div>
                <div class="campo">
                    <span class="add new" onclick="crea_nuevo()">Nombre</span>
                </div>
            </div>
        </div>
    </body>
</html>