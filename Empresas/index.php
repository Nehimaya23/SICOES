
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();
$solicitudes= $sicoes->solicitudes_Empresas();
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!--INICIO del cont principal-->
<div class="container">
    <h1>Solicitudes de Empresas de Seguridad</h1>
    <div class="container">
        <div class="row">
            
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
    <!-- Gun Icon (Weapons) -->
    <a id="<?php echo $row['ID']; ?>" class="btn btn-dark arma_empresa" title='ARMAS'>
        <i class="fas fa-users"></i>
    </a>

    <!-- Users Icon (Employees) -->
    <a id="<?php echo $row['ID']; ?>" class="btn btn-secondary emple_empresa" title='EMPLEADOS'>
        <i class="fas fa-users"></i> <!-- corrected from fas-solid to fas -->
    </a>

    <!-- Car Icon (Vehicles) -->
    <a id="<?php echo $row['ID']; ?>" class="btn btn-primary vehic_empresa" title='VEHÍCULOS'>
        <i class="fas fa-car"></i> 
    </a>

    <!-- File Icon (Details) -->
    <a id="<?php echo $row['ID']; ?>" class="btn btn-warning Det_Empre" title='DETALLE'>
        <i class="fas fa-file"></i> <!-- corrected from fas-regular to fas, and fa-fil to fa-file -->
    </a>

    <!-- Edit Icon (Edit) -->
    <a id="<?php echo $row['ID']; ?>" class="btn btn-danger btnEditar" title='EDITAR'>
        <i class="fas fa-edit"></i> <!-- changed fa to fas for consistency -->
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
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre" class="col-form-label">RTN:</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                    <label for="nombre" class="col-form-label">Razòn Social:</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                    <label for="nombre" class="col-form-label">Fecha Inicio:</label>
                    <input type="text" class="form-control" id="nombre">
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>