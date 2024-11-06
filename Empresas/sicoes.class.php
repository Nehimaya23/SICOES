<?php
class valores_sicoes  {
  		/* PROPIEDADES */
      public $id;
      public $id2;
      public $dato1;
      public $dato2;
      public $usuario;
      public $arreglo;
        /* PROPIEDADES */
  		function __construct($id_usuario) {
        $this->usuario = $id_usuario;
  			$this->mysqli = new mysqli('localhost', 'root', '', 'SICOES');
  		}
<<<<<<< Updated upstream

/////////////////////////////////////////////////////////////////////////////////////////////////////
///                     DEPARTAMENTOS Y MUNICIPIOS
/////////////////////////////////////////////////////////////////////////////////////////////////////

public function deptos(){
  $this->str_trae_array="SELECT ID, DESCRIP FROM TBL_DEPTO;";
=======
/* --------------------------------SOLICITUDES EMPRESAS------------------------------------- */
public function solicitudes_Empresas(){
  $this->str_trae_array="SELECT sol.ID, s.RTN, s.DENOMINACION, s.DIRECCION,s.UBICACION,s.TELEFONO,s.CORREO,sol.FECHA,sol.STATUS
                         FROM   tbl_solicitantes AS s
                         JOIN   tbl_solicitudes AS sol ON s.ID = sol.FK_SOLICITANTE
                         WHERE  sol.FK_TIPO_SOLICITUD > 1;";
>>>>>>> Stashed changes
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}

<<<<<<< Updated upstream
public function solicitantes(){
  $this->str_trae_array="SELECT ID, RTN, DENOMINACION, FK_ID_DEPTO, TELEFONO FROM TBL_SOLICITANTES;";
=======
/* --------------------------------SOLICITUDES VEHÍCULO BLINDADO----------------------------- */

public function solicitudes_Blindaje(){
  $this->str_trae_array="SELECT s.ID, s.RTN, s.DENOMINACION, s.DIRECCION,s.UBICACION,s.TELEFONO,s.CORREO,sol.FECHA,sol.STATUS
                         FROM   tbl_solicitantes AS s
                         JOIN   tbl_solicitudes AS sol ON s.ID = sol.FK_SOLICITANTE
                         WHERE  sol.FK_TIPO_SOLICITUD = 1;";
>>>>>>> Stashed changes
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}

<<<<<<< Updated upstream
public function vehiculos($id){
  $this->str_trae_array="SELECT ID, SERIE, MOTOR, FK_ID_MARCA
                         FROM TBL_VEHICULOS
=======
/* --------------------------------SOLICITANTES EMPRESAS------------------------------------- */
public function solicitantesEmpres(){
  $this->str_trae_array = "SELECT B.ID, B.RTN, B.DENOMINACION, B.FK_ID_DEPTO, B.TELEFONO, B.DIRECCION 
                           FROM tbl_solicitudes AS A
                           JOIN tbl_solicitantes AS B ON A.FK_SOLICITANTE = B.ID
                           WHERE A.FK_TIPO_SOLICITUD >1;";
  $this->dato1 = mysqli_query($this->mysqli, $this->str_trae_array);
  return $this->dato1;
}
/* --------------------------------SOLICITANTES VEHÍCULO BLINDADOS------------------------------------- */
public function solicitantesBlindado(){
  $this->str_trae_array = "SELECT B.ID, B.RTN, B.DENOMINACION, B.FK_ID_DEPTO, B.TELEFONO
                           FROM tbl_solicitudes AS A
                           JOIN tbl_solicitantes AS B ON A.FK_SOLICITANTE = B.ID
                           WHERE A.FK_TIPO_SOLICITUD =1;";
                    
  $this->dato1 = mysqli_query($this->mysqli, $this->str_trae_array);
  return $this->dato1;
}

public function EmpleadosDICSPS(){
  $this->str_trae_array = "SELECT ID, DNI, CONCAT(NOMBRES,' ',APELLIDOS) AS NOMBRE ,TELEFONO, CORREO
                           FROM tbl_empleados_dicsps ;";
                    
  $this->dato1 = mysqli_query($this->mysqli, $this->str_trae_array);
  return $this->dato1;
}












public function Documentacion(){
  $this->str_trae_array = "SELECT id, title, description FROM tbl_files;";
  $this->dato1 = mysqli_query($this->mysqli, $this->str_trae_array);
  return $this->dato1;
}


public function vehiculos($id){
  $this->str_trae_array="SELECT ID, MARCA,MDOELO,COLOR,YEAR,PLACA
                         FROM `tbl_vehiculos` 
>>>>>>> Stashed changes
                         WHERE FK_ID_SOLICITUD = '$id';";
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}

}


<<<<<<< Updated upstream
=======
public function armas($id){
  $this->str_trae_array="SELECT A.ID,A.MARCA,A.MODELO,A.SERIE,A.REG_BALISTICO
                         FROM tbl_armas AS A
                         WHERE A.FK_ID_SOLICITUD = '$id';";
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}


public function empre($id){
  $this->str_trae_array="SELECT A.ID, B.RTN, B.DENOMINACION, A.FECHA, A.STATUS 
                         FROM tbl_solicitudes AS A 
                         JOIN tbl_solicitantes AS B ON A.FK_SOLICITANTE = B.ID
                         WHERE A.ID = '$id';";
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}






}



>>>>>>> Stashed changes





































