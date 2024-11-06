<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$fk_id_solicitud = $_POST['fk_id_solicitud'] ?? '';
$serie = $_POST['serie'] ?? '';
$motor = $_POST['motor'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$year = $_POST['year'] ?? '';
$tipo_vehiculo = $_POST['tipo_vehiculo'] ?? '';
$color = $_POST['color'] ?? '';
$cilindraje = $_POST['cilindraje'] ?? '';
$placa = $_POST['placa'] ?? '';
$opcion = $_POST['opcion'] ?? '';
$id = $_POST['id'] ?? null;

$img_front = '';
$img_rear = '';
$img_left = '';
$img_right = '';

$data = [];

try {
    // Obtener las imágenes como datos binarios
    if (isset($_FILES['img_front'])) {
        $img_front = file_get_contents($_FILES['img_front']['tmp_name']);
    }
    if (isset($_FILES['img_rear'])) {
        $img_rear = file_get_contents($_FILES['img_rear']['tmp_name']);
    }
    if (isset($_FILES['img_left'])) {
        $img_left = file_get_contents($_FILES['img_left']['tmp_name']);
    }
    if (isset($_FILES['img_right'])) {
        $img_right = file_get_contents($_FILES['img_right']['tmp_name']);
    }

    switch($opcion) {
        case 1: // Alta
            $consulta = "INSERT INTO tbl_vehiculos (FK_ID_SOLICITUD, SERIE, MOTOR, MARCA, MODELO, YEAR, TIPO_VEHICULO, COLOR, CILINDRAJE, PLACA, IMG_FRONT, IMG_REAR, IMG_LEFT, IMG_RIGHT) 
                         VALUES(:fk_id_solicitud, :serie, :motor, :marca, :modelo, :year, :tipo_vehiculo, :color, :cilindraje, :placa, :img_front, :img_rear, :img_left, :img_right)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([
                ':fk_id_solicitud' => $fk_id_solicitud,
                ':serie' => $serie,
                ':motor' => $motor,
                ':marca' => $marca,
                ':modelo' => $modelo,
                ':year' => $year,
                ':tipo_vehiculo' => $tipo_vehiculo,
                ':color' => $color,
                ':cilindraje' => $cilindraje,
                ':placa' => $placa,
                ':img_front' => $img_front,
                ':img_rear' => $img_rear,
                ':img_left' => $img_left,
                ':img_right' => $img_right
            ]);

            $consulta = "SELECT ID, MARCA, MODELO, COLOR, YEAR, PLACA FROM tbl_vehiculos ORDER BY ID DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        case 2: // Modificación
            $consulta = "UPDATE tbl_vehiculos SET FK_ID_SOLICITUD=:fk_id_solicitud, SERIE=:serie, MOTOR=:motor, MARCA=:marca, 
                         MODELO=:modelo, YEAR=:year, TIPO_VEHICULO=:tipo_vehiculo, COLOR=:color, CILINDRAJE=:cilindraje, PLACA=:placa, 
                         IMG_FRONT=:img_front, IMG_REAR=:img_rear, IMG_LEFT=:img_left, IMG_RIGHT=:img_right 
                         WHERE ID=:id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([
                ':fk_id_solicitud' => $fk_id_solicitud,
                ':serie' => $serie,
                ':motor' => $motor,
                ':marca' => $marca,
                ':modelo' => $modelo,
                ':year' => $year,
                ':tipo_vehiculo' => $tipo_vehiculo,
                ':color' => $color,
                ':cilindraje' => $cilindraje,
                ':placa' => $placa,
                ':img_front' => $img_front,
                ':img_rear' => $img_rear,
                ':img_left' => $img_left,
                ':img_right' => $img_right,
                ':id' => $id
            ]);

            $consulta = "SELECT ID, MARCA, MODELO, COLOR, YEAR, PLACA FROM tbl_vehiculos WHERE ID = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([':id' => $id]);
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
?>
