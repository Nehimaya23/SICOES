<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS
$fk_id_solicitud = $_POST['fk_id_solicitud'] ?? '';
$dni = $_POST['dni'] ?? '';
$nombres = $_POST['nombres'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$tipo_empleado = $_POST['tipo_empleado'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$opcion = $_POST['opcion'] ?? '';
$id = $_POST['id'] ?? null;

$data = []; /// Inicializa el array de datos

try {
    switch ($opcion) {
        case 1: // Alta (Insert)
            $consulta = "INSERT INTO tbl_empleados (FK_ID_SOLICITUD , DNI, NOMBRES, APELLIDOS, TELEFONO, TIPO_EMPLEADO,CARGO,FECHA) VALUES('$fk_id_solicitud', '$dni', '$nombres', '$apellidos', '$telefono', '$tipo_empleado','$cargo','$fecha')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        case 2: // Modificación (Update)
            $consulta = "UPDATE tbl_empleados SET DNI = :dni, NOMBRES = :nombres, APELLIDOS = :apellidos, TELEFONO = :telefono, 
                         TIPO_EMPLEADO = :tipo_empleado, CARGO = :cargo, FECHA = :fecha WHERE id = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute([
                ':dni' => $dni,
                ':nombres' => $nombres,
                ':apellidos' => $apellidos,
                ':telefono' => $telefono,
                ':tipo_empleado' => $tipo_empleado,
                ':cargo' => $cargo,
                ':fecha' => $fecha,
                ':id' => $id
            ]);

            // Fetch the updated record
            $consulta = "SELECT * FROM tbl_empleados WHERE id = :id";
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

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null; // Close the connection
