<?php
require('conexion.php');
if (isset ($_POST['od'])) {
        $od=$_POST['od'];
switch ($od) {
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

     break;


		 default:
		 # code...
		 break;
}
}
?>
