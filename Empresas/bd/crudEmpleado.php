<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$fk_id_solicitud = (isset($_POST['fk_id_solicitud'])) ? $_POST['fk_id_solicitud'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos= (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$telefono= (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$tipo_empleado = (isset($_POST['tipo_empleado'])) ? $_POST['tipo_empleado'] : '';
$cargo = (isset($_POST['cargo'])) ? $_POST['cargo'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO tbl_empleados (FK_ID_SOLICITUD, DNI,NOMBRES,APELLIDOS,TELEFONO,TIPO_EMPLEADO,CARGO,FECHA) VALUES('$fk_id_solicitud', '$dni', '$nombres','$apellidos', '$telefono', '$tipo_empleado', '$cargo', '$fecha') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT FK_ID_SOLICITUD, DNI,NOMBRES,APELLIDOS,TELEFONO,TIPO_EMPLEADO,CARGO,FECHA FROM tbl_empleados ORDER BY id DESC LIMIT 1";
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
