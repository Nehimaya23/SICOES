<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$fk_id_solicitud = (isset($_POST['fk_id_solicitud'])) ? $_POST['fk_id_solicitud'] : '';
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '';
$motor = (isset($_POST['motor'])) ? $_POST['motor'] : '';
$marca= (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo= (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$year = (isset($_POST['year'])) ? $_POST['year'] : '';
$tipo_vehiculo = (isset($_POST['tip_vehiculo'])) ? $_POST['tip_vehiculo'] : '';
$color = (isset($_POST['color'])) ? $_POST['color'] : '';
$cilindraje = (isset($_POST['cilindraje'])) ? $_POST['cilindraje'] : '';
$placa = (isset($_POST['placa'])) ? $_POST['placa'] : '';
$img_front = (isset($_POST['img_front'])) ? $_POST['img_front'] : '';
$img_rear = (isset($_POST['img_rear'])) ? $_POST['img_rear'] : '';
$img_left = (isset($_POST['img_left'])) ? $_POST['img_left'] : '';
$img_rigtht = (isset($_POST['img_rigtht'])) ? $_POST['img_rigtht'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO tbl_vehiculos (FK_ID_SOLICITUD,SERIE,MOTOR,MARCA,MODELO,YEAR,TIPO_VEHICULO,COLOR,CILINDRAJE,PLACA,IMG_FRONT,IMG_REAR,IMG_LEFT,IMG_RIGTHT ) VALUES('$fk_id_solicitud', '$serie', '$motor','$marca', '$modelo', '$year', '$tipo_vehiculo', '$color', '$cilindraje', '$placa', '$img_front', '$img_rear', '$img_left', '$img_rigtht') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT ID,MARCA,MODELO,COLOR,YEAR,PLACA FROM tbl_vehiculos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', pais='$pais', edad='$edad' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, pais, edad FROM personas WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
