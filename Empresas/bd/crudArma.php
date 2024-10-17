<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$fk_id_solicitud = $_POST['fk_id_solicitud'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$serie = $_POST['serie'] ?? '';
$reg_balistico = $_POST['reg_balistico'] ?? '';
$tipo_arma = $_POST['tipo_arma'] ?? '';
$opcion = $_POST['opcion'] ?? '';
$id = $_POST['id'] ?? null; // Asegúrate de recibir el ID para la actualización y eliminación

$data = []; // Inicializa el array de datos

try {
    switch ($opcion) {
        case 1: //alta
            $consulta = "INSERT INTO tbl_armas (FK_ID_SOLICITUD, MARCA,MODELO,SERIE,REG_BALISTICO,TIPO_ARMA) VALUES('$fk_id_solicitud', '$marca', '$modelo','$serie', '$reg_balistico', '$tipo_arma') ";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
    
            $consulta = "SELECT FK_ID_SOLICITUD, MARCA,MODELO,SERIE,REG_BALISTICO,TIPO_ARMA FROM personas ORDER BY id DESC LIMIT 1";
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
        default:
            throw new Exception("Opción no válida");
    }
} catch (PDOException $e) {
    // Manejo de excepciones para errores de base de datos
    $data = [
        'error' => true,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    // Manejo de excepciones generales
    $data = [
        'error' => true,
        'message' => $e->getMessage()
    ];
}

// Enviar el array final en formato JSON a JS
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null; // Cerrar la conexión
