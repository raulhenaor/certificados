<?php

$host = 'localhost';
$username = 'root';
$passwd = '';
$dbname = 'servilog';

/*$conexion = new mysqli($host, $username, $passwd, $dbname);

if ($conexion->connect_errno){
    echo 'Fallo a conectar a la bd' . $conexion->connect_error ;
} else {
    echo 'Conecion OK';    
}*/

$con = mysqli_connect($host, $username, $passwd, $dbname);

if (mysqli_connect_errno($con)) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8");