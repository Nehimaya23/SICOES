
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();
$solicitudes= $sicoes->solicitudes_Empresas();
?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Solicitudes de Empresas de Seguridad</h1>
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
                                <th>Solicitante</th>
                                <th>Fecha Inicio</th>                                
                                <th>Estado</th>  
                                <th>Acciones</th> <!-- Added column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($solicitudes)): ?>
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['RTN']; ?></td>
                                    <td><?php echo $row['DENOMINACION']; ?></td>
                                    <td><?php echo $row['FECHA']; ?></td>
                                    <td><?php echo $row['STATUS']; ?></td>
                                    <td>
                                        <a id="<?php echo $row['ID']; ?>" class="btn btn-dark arma_empresa" title='ARMAS'>
                                            <i class="fas fa-gun"></i> 
                                        </a>
                                        <a id="<?php echo $row['ID']; ?>" class="btn btn-secondary emple_empresa " title='EMPLEADOS'>
                                            <i class="fa-solid fa-users"></i> 
                                        </a>
                                        <a id="<?php echo $row['ID']; ?>" class="btn btn-primary vehic_empresa"  title='VEHÍCULOS'>
                                            <i class="fas fa-car"></i> 
                                        </a>
                                        <a id="<?php echo $row['ID']; ?>" class="btn btn-warning  vehic_empresa" title='DETALLE'>
                                            <i class="fa-regular fa-fil"></i> 
                                        </a>
                                        <a id="<?php echo $row['ID']; ?>" class="btn btn-danger vehic_empresa" title='EDITAR'>
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>                             
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
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPersonas">    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="depto" class="col-form-label">Departamento:</label>
                        <select name="depto" id="depto" class="form-control">
                            <?php while ($fila = mysqli_fetch_assoc($deptos)): ?>
                                <option value="<?php echo $fila['ID']; ?>"><?php echo $fila['DESCRIP']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="muni" class="col-form-label">Municipio:</label>
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