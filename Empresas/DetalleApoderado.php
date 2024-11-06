<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');


//session_start();
//echo "EL ID DEL SOLICITANTE ES: ".$_SESSION['ids'];
$id = $_SESSION['ids'];


?>

<!--INICIO del cont principal-->
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Detalle Solicitudes por Apoderado Legal</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php">Solicitudes de Empresas de Seguridad</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle Armas</li>
        </ol>
    </nav>
</div>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>RTN</th>
                                <th>Razón Social</th>
                                <th>Apoderado Legal</th>
                                                             
                                <th>Tipo Solicitud</th>                                
                                <th>Fecha</th>  
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($DetalleApoderado)) {
                            echo '
                                <tr>
                                    <td>'.$row['iD'].'</td>
                                    <td>'.$row['RTN'].'</td>
                                    <td>'.$row['DENOMINACION'].'</td>
                                    <td>'.$row['APODERADO_LEGAL'].'</td>
                                    <td>'.$row['TIPO_SOLICITUD'].'</td>
                                    <td>'.$row['FECHA'].'</td>
                                  
                                </tr>';
                        }
                        ?>       
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    


<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                    <label for="nombre" class="col-form-label">Departamento:</label>
                    <select name="depto" id="depto" class="form-control">
                        <?php while ($fila = mysqli_fetch_assoc($deptos)) { ?>
                            <option value="<?php echo $fila['ID']?>"><?php echo $fila['DESCRIP']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre" class="col-form-label">Municipio:</label>
                    <select name="muni" id="muni" class="form-control" disabled>
                        
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>