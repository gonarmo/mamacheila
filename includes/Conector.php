<?php

class Conector {
    var $conexion;
    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "motes";
        $this->conexion= new mysqli($servername, $username, $password, $dbname);
        $this->conexion->set_charset('utf8');
    }

    function ejecutar( $sql) {
        return mysqli_query($this->conexion, $sql);
    }
    function cerrar(){
        mysqli_close($this->conexion);
    }
}
