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

/////////////////////////////////////////////////////////////////////////////////////////////////////
///                     DEPARTAMENTOS Y MUNICIPIOS
/////////////////////////////////////////////////////////////////////////////////////////////////////

public function deptos(){
  $this->str_trae_array="SELECT ID, DESCRIP FROM TBL_DEPTO;";
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}

public function solicitantes(){
  $this->str_trae_array="SELECT ID, RTN, DENOMINACION, FK_ID_DEPTO, TELEFONO FROM TBL_SOLICITANTES;";
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}

public function vehiculos($id){
  $this->str_trae_array="SELECT ID, SERIE, MOTOR, FK_ID_MARCA
                         FROM TBL_VEHICULOS
                         WHERE FK_ID_SOLICITUD = '$id';";
  $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
  return $this->dato1;
}

}








































/*

      /////////////////////////////////////////////////////////////////////////////////////////////////////
      ///                     FUNCIONES INICIO ADMIN RRHH
      /////////////////////////////////////////////////////////////////////////////////////////////////////
      public function traer_total_usuario(){
        $this->str_trae_array="SELECT COUNT(ID_USUARIO) AS USUARIOS FROM TBL_USUARIOS WHERE TIPO_USUARIO != 'ADMIN';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_total_empleados(){
        $this->str_trae_array="SELECT COUNT(COD_PERSONAL) AS EMPLEADOS FROM TBL_DATOS_PERSONALES;";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_total_actualizados(){
        $this->str_trae_array="SELECT COUNT(VERIFICACION) AS ACTUALIZADOS FROM TBL_USUARIOS WHERE VERIFICACION='SI';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }


      /////////////////////////////////////////////////////////////////////////////////////////////////////
      ///                     FUNCIONES FICHAS DE EMPLEADOS EN EL MENU (ADMIN RRHH)
      /////////////////////////////////////////////////////////////////////////////////////////////////////
      public function traer_tipo_usuario($usuario){
        $this->str_trae_array="SELECT TIPO_USUARIO FROM TBL_USUARIOS WHERE NOMBRE_USUARIO = '$usuario';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_personal($cod_empleado){
        $this->str_trae_array="SELECT DP.COD_PERSONAL, DP.IDENTIDAD, CONCAT(DP.NOMBRES, ' ', DP.APELLIDOS) AS NOMBRES, DP.FECHA_NAC,
                               TP.PAIS, DP.FK_DEPTO_NAC, DP.LUGAR_NACIMIENTO, TS.SEXO, TT.TRATAMIENTO, TN.NACIONALIDAD, TEC.ESTADO_CIVIL, DP.NUM_HIJOS, TGP.GRUPO_PERSONAL, AP.AREA_PERSONAL, DP.SEPULTURA
                               FROM TBL_DATOS_PERSONALES DP
                               JOIN TBL_PAISES TP ON DP.FK_COD_PAIS = TP.COD
                               JOIN TBL_TIPOS_SEXO TS ON DP.FK_COD_SEXO = TS.COD
                               JOIN TBL_TIPOS_TRATAMIENTO TT ON DP.FK_COD_TRATAMIENTO = TT.COD
                               JOIN TBL_NACIONALIDADES TN ON DP.FK_COD_NACIONALIDAD = TN.COD
                               JOIN TBL_TIPOS_ECIVIL TEC ON DP.FK_COD_ECIVIL = TEC.COD
                               JOIN TBL_GRUPOS_PERSONAL TGP ON DP.FK_COD_GPERSONAL = TGP.COD
                               JOIN TBL_AREAS_PERSONAL AP ON DP.FK_COD_APERSONAL = AP.COD
                               WHERE DP.COD_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_direcciones($cod_empleado){
        $this->str_trae_array="SELECT TD.TIPO_DIRECCION, DD.FECHA_DESDE, DD.FECHA_HASTA, DD.COLONIA,
                DD.CALLE, DD.ADIC_DIRECCION, DEPT.DEPARTAMENTO, TPAI.PAIS, DD.CONTACTO, DD.TELEFONO,
                TCO.COM_ADICIONAL, DD.NUM_COM_ADIC
                FROM TBL_DATOS_DIRECCION DD
                JOIN TBL_DATOS_PERSONALES DPER ON DD.FK_NUM_PERSON = DPER.COD_PERSONAL
                JOIN TBL_TIPO_DIRECCION TD ON DD.FK_TIPO_DIREC = TD.COD
                JOIN TBL_DEPTOS DEPT ON DD.FK_COD_DEPTO = DEPT.COD
                JOIN TBL_PAISES TPAI ON DD.FK_COD_PAIS = TPAI.COD
                JOIN TBL_TIPO_COMUN TCO ON DD.FK_COD_TCOM = TCO.COD
                WHERE DPER.COD_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_familiares($cod_empleado){
        $this->str_trae_array="SELECT CONCAT(DF.NOMBRES, ' ', DF.APELLIDOS) AS NOMBRE, TF.TIPO_FAMILIAR, TS.SEXO, DF.FECHA_NAC, TID.TIPO_IDENTIF, DF.NUMERO_IDENT, DF.BENEFICIARIO, DF.PORCENTAJE
                              FROM TBL_DATOS_FAMILIARES DF
                              JOIN TBL_TIPOS_FAMILIAR TF ON DF.FK_COD_FAMILIAR = TF.COD
                              JOIN TBL_TIPOS_SEXO TS ON DF.FK_COD_SEXO = TS.COD
                              JOIN TBL_TIPOS_IDENTIF TID ON DF.FK_COD_IDENT = TID.COD
                              WHERE DF.FK_NUM_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_identificaciones($cod_empleado){
        $this->str_trae_array="SELECT TID.TIPO_IDENTIF, DID.NUMERO, DID.FECHA_EMISION, DID.FECHA_VENCIMIENTO, TPA.PAIS
                              FROM TBL_DATOS_IDENTIF DID
                              JOIN TBL_TIPOS_IDENTIF TID ON DID.FK_TIPO_IDENT = TID.COD
                              JOIN TBL_PAISES TPA ON DID.FK_PAIS_EMISION = TPA.COD
                              WHERE DID.FK_COD_PERSONAL = '$cod_empleado'; ";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_medica($cod_empleado){
        $this->str_trae_array="SELECT TEF.ENFERMEDAD, DM.FECHA_RECONO
                              FROM TBL_DATOS_MEDICOS DM
                              JOIN TBL_TIPOS_ENFERMEDAD TEF ON DM.FK_COD_ENFERMEDAD = TEF.COD
                              WHERE DM.FK_COD_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_formacion($cod_empleado){
        $this->str_trae_array="SELECT DF.INSTITUCION, DF.FECHA_INICIO, DF.FECHA_FINAL, CONCAT(DF.DURACION, ' ',UT.UNIDAD) AS PERIODO, FP.FORMACION, NE.NIVEL_EDUCATIVO
                              FROM TBL_DATOS_FORMACION DF
                              JOIN TBL_FORMACION_PROFESIONAL FP ON DF.FK_FORMACION_PROFESIONAL = FP.COD
                              JOIN TBL_NIVEL_EDUCATIVO NE ON DF.FK_NIVEL_EDUCATIVO = NE.COD
                              JOIN TBL_UDS_TIEMPO UT ON DF.FK_UD_TIEMPO = UT.COD
                              WHERE DF.FK_COD_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_laboral($cod_empleado){
        $this->str_trae_array="SELECT DL.EMPRESA, DL.POBLACION, TR.RAMO, TA.ACTIVIDAD, DL.FECHA_INICIO, DL.FECHA_FIN
                              FROM TBL_DATOS_LABORALES DL
                              JOIN TBL_TIPOS_RAMOS TR ON DL.FK_COD_RAMO = TR.COD
                              JOIN TBL_TIPOS_ACTIVIDADES TA ON DL.FK_COD_ACT = TA.COD
                              WHERE FK_COD_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_ficha_sangre($cod_empleado){
        $this->str_trae_array="SELECT FK_COD_SANGRE
                                FROM TBL_DATOS_SANGRE
                                WHERE FK_COD_PERSONAL = '$cod_empleado';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }


      /////////////////////////////////////////////////////////////////////////////////////////////////////
      ///                     FUNCION PARA RECUPERAR EL NOMBRE EN EL HEADER
      /////////////////////////////////////////////////////////////////////////////////////////////////////
      public function traer_nombre($usuario){
        $this->str_trae_array="SELECT CONCAT (DP.NOMBRES,' ', DP.APELLIDOS) AS NOMBRE
                               FROM TBL_DATOS_PERSONALES DP
                               WHERE DP.IDENTIDAD = '$usuario';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      /////////////////////////////////////////////////////////////////////////////////////////////////////
      ///                     FUNCIONES PARA RECUPERAR DATOS PERSONALES
      /////////////////////////////////////////////////////////////////////////////////////////////////////

      public function traer_fotografia($usuario){
        $this->str_trae_array="SELECT SWERK from TBL_DATOS_PERSONALES where IDENTIDAD = '$usuario';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_datos_visualizables($usuario){
        $this->str_trae_array="SELECT CONCAT (DP.NOMBRES,' ', DP.APELLIDOS) AS NOMBRE, DP.COD_PERSONAL, DP.IDENTIDAD, TGP.GRUPO_PERSONAL, TAP.AREA_PERSONAL, TP.PAIS, TN.NACIONALIDAD
                               FROM TBL_DATOS_PERSONALES DP
                               JOIN TBL_PAISES TP ON TP.COD = DP.FK_COD_PAIS
                               JOIN TBL_NACIONALIDADES TN ON TN.COD = DP.FK_COD_NACIONALIDAD
                               JOIN TBL_GRUPOS_PERSONAL TGP ON TGP.COD = DP.FK_COD_GPERSONAL
                               JOIN TBL_AREAS_PERSONAL TAP ON TAP.COD = DP.FK_COD_APERSONAL
                               WHERE DP.IDENTIDAD = '$usuario';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_datos_editables($usuario) {
        $this->str_trae_array="SELECT TRAT.TRATAMIENTO, DP.NOMBRES, DP.APELLIDOS, DP.FECHA_NAC, DP.NUM_HIJOS, DP.SEPULTURA, SEX.SEXO, ECI.ESTADO_CIVIL,
                                      DP.FK_DEPTO_NAC, DP.FK_COD_SEXO, DP.FK_COD_TRATAMIENTO, DP.FK_COD_ECIVIL, TD.DEPARTAMENTO, DP.LUGAR_NACIMIENTO, MU.MUNICIPIO
                               FROM TBL_DATOS_PERSONALES DP
                               JOIN TBL_TIPOS_TRATAMIENTO TRAT ON DP.FK_COD_TRATAMIENTO = TRAT.COD
                               JOIN TBL_TIPOS_SEXO SEX ON DP.FK_COD_SEXO = SEX.COD
                               JOIN TBL_TIPOS_ECIVIL ECI ON DP.FK_COD_ECIVIL = ECI.COD
                               JOIN TBL_DEPTOS TD ON DP.FK_DEPTO_NAC = TD.COD
                               JOIN TBL_MUNICIPIOS MU ON DP.LUGAR_NACIMIENTO = MU.COD
                               WHERE DP.IDENTIDAD = '$usuario';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_tratamientos(){
        $this->str_trae_array="SELECT COD, TRATAMIENTO FROM TBL_TIPOS_TRATAMIENTO;";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }
      public function traer_ecivil(){
        $this->str_trae_array="SELECT COD, ESTADO_CIVIL FROM TBL_TIPOS_ECIVIL;";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }

      public function traer_cuenta($usuario){
        $this->str_trae_array="SELECT CONCAT(FK_COD_BANCO, '  ', CUENTA) AS ACCOUNT
                               FROM TBL_DATOS_BANCARIOS DB
                               JOIN TBL_DATOS_PERSONALES DP ON DP.COD_PERSONAL = DB.FK_COD_PERSONAL
                               WHERE DP.IDENTIDAD = '$usuario';";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      }
      /* TRAER TALLAS DE UNIFORME
      public function traer_ecivil(){
        $this->str_trae_array="SELECT COD, ESTADO_CIVIL FROM TBL_TIPOS_ECIVIL;";
        $this->dato1 = mysqli_query($this->mysqli,  $this->str_trae_array);
        return $this->dato1;
      } */

?>
