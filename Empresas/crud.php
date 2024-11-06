<?php
include_once 'bd/conexion.php';
if (isset ($_POST['od'])) {
        $od=$_POST['od'];
switch ($od) {
<<<<<<< Updated upstream
     case 'sel_mun':
         $cod_depto = $_POST['cod_depto'];
         //EJECUTA LA CONSULTA A LA BASE DE DATOS
         $query ="SELECT ID, DESCRIP FROM TBL_MUNI WHERE FK_ID_DEPTO = '$cod_depto';";
         //echo $query;
         $ejecutar = $mysqli->query($query);
         if ($ejecutar->num_rows) {
           $a = '';
           while (($fila = mysqli_fetch_assoc($ejecutar)) != NULL) {
             $a.= '<option value="'.$fila['ID'].'">'.$fila['DESCRIP'].'</option>';
             //echo 'abner';
           }
           $row['resp'] = $a;
           $row['answ'] = 1;
           echo json_encode($row);
         } else {
           $row['answ'] = 0;
           echo json_encode($row);
         }

    break;

    case 'dveh':
        $id_solicitante = $_POST['id'];
        session_start();
        $_SESSION['ids'] = $id_solicitante;

        //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
        $row['answ'] = 1;
        $row['url'] = 'vehiculos.php';
        echo json_encode($row);
=======
      
    case 'darms':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'Armas.php';
      echo json_encode($row);

    break;
    case 'dEmple':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'Empleados.php';
      echo json_encode($row);
     break;
     case 'dveh':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'Vehiculos.php';
      echo json_encode($row);
    break;
     case 'dDet_Emp':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'DetalleApoderado.php';
      echo json_encode($row);
>>>>>>> Stashed changes

     break;
     case 'dpermiso':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'PermisoEmpresa.php';
      echo json_encode($row);

     break;
     
     case 'ddocumentacionEmp':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'DocumentacionSolicitudesEmpresa.php';
      echo json_encode($row);

     break;
     case 'dvehiculoBli':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'VehiculosBlindados.php';
      echo json_encode($row);

     break;
     case 'dpermisoEmp':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'empleadosdicsps.php';
      echo json_encode($row);

     break;
     case 'dpermisoBli':
      $id_solicitante = $_POST['id'];
      session_start();
      $_SESSION['ids'] = $id_solicitante;

      //RESPUESTA A PETICIÓN DEL CLIENTE (NAVEGADOR)
      $row['answ'] = 1;
      $row['url'] = 'PermisoBlindado.php';
      echo json_encode($row);

     break;
     

		 default:
		 # code...
		 break;
}
}
?>
