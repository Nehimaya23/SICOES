<?php //session_start();

$mysqli = new mysqli('localhost', 'root', '', 'sicoes');

//Comprueba la Conexion
if (mysqli_connect_errno()) {

    printf("Error al conectar con la BD %s ", $mysqli_connect_error());
    exit();
}

?>
