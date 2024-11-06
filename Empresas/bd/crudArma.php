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
        case 1: // alta
            $consulta = "INSERT INTO tbl_armas (FK_ID_SOLICITUD, MARCA, MODELO, SERIE, REG_BALISTICO, TIPO_ARMA) VALUES('$fk_id_solicitud', '$marca', '$modelo', '$serie', '$reg_balistico', '$tipo_arma')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
    
            $consulta = "SELECT FK_ID_SOLICITUD, MARCA, MODELO, SERIE, REG_BALISTICO, TIPO_ARMA FROM tbl_armas ORDER BY ID DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        
            case 2: // modificación
                $consulta = "UPDATE tbl_armas SET MARCA=:marca, MODELO=:modelo, SERIE=:serie, REG_BALISTICO=:reg_balistico, TIPO_ARMA=:tipo_arma WHERE ID=:id";		
                $resultado = $conexion->prepare($consulta);
                $resultado->bindParam(':marca', $marca);
                $resultado->bindParam(':modelo', $modelo);
                $resultado->bindParam(':serie', $serie);
                $resultado->bindParam(':reg_balistico', $reg_balistico);
                $resultado->bindParam(':tipo_arma', $tipo_arma);
                $resultado->bindParam(':id', $id);
                $resultado->execute();        
                
                $consulta = "SELECT FK_ID_SOLICITUD, MARCA, MODELO, SERIE, REG_BALISTICO, TIPO_ARMA FROM tbl_armas WHERE ID=:id";
                $resultado = $conexion->prepare($consulta);
                $resultado->bindParam(':id', $id);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;  
                
        default:
            throw new Exception("Opción no válida");
    }
} catch (PDOException $e) {
    $data = [
        'error' => true,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    $data = [
        'error' => true,
        'message' => $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
