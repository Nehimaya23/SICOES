<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();

//session_start();

$id = $_SESSION['ids'];
$vehiculos= $sicoes->vehiculos($id);

?>

<!--INICIO del cont principal-->
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Vehículos Blindados</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php">Vehiculos Blindados</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehículos</li>
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
                                <th>SERIE</th>
                                <th>MOTOR</th>                                
                                <th>MARCA</th>  
                              
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php    while($row = mysqli_fetch_assoc($vehiculos)){
                               echo  '
                                    <tr>
                                         <td >'.$row['ID'].'</td>
                                         <td >'.$row['SERIE'].'</td>
                                         <td >'.$row['MOTOR'].'</td>
                                         <td >'.$row['MOTOR'].'</td>
                                         <td >'.$row['FK_ID_MARCA'].'</td>';
                                         
                              echo '</tr>';
                            }?>                             
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