
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();
//session_start();
//echo "EL ID DEL SOLICITANTE ES: ".$_SESSION['ids'];
$id = $_SESSION['ids'];
$vehiculos= $sicoes->vehiculos($id);
$empre = $sicoes->empre($id);

?>


<!--INICIO del cont principal-->
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Detalle Vehículos</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.php">Solicitudes de Empresas de Seguridad</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalle Vehículos</li>
        </ol>
    </nav>
</div>

<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <p class="lead">Datos de la solicitud</p>
        <div class="table-responsive">        
        <table class="table table-borderless">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">RTN</th>
          <th scope="col">Razòn Social</th>
          <th scope="col">Fecha Creaciòn</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_assoc($empre)): ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['RTN']; ?></td>
                            <td><?php echo $row['DENOMINACION']; ?></td>
                            <td><?php echo $row['FECHA']; ?></td>
                            <td><?php echo $row['STATUS']; ?></td>
                        </tr>
                    <?php endwhile; ?>       
      </tbody>
        </table>   
     </div>
      </div>
    
    </div>

<br>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
    <p class="lead">Vehículos registrados</p>
    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" title="Registro de Nuevo Vehículo">
    <i class="fas fa-car" ></i> Nuevo Vehículo
    </button>
 
    <br>
    
    <div class="table-responsive">    
    <br>
                    <div class="table-responsive">        
                        <table id="tablaVehiculos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Marca</th>
                                <th>Modelo</th>                                
                                <th>Color</th>
                                <th>Año</th>
                                <th>Placa</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_assoc($vehiculos)): ?>
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['MARCA']; ?></td>
                                    <td><?php echo $row['MODELO']; ?></td>
                                    <td><?php echo $row['COLOR']; ?></td>
                                    <td><?php echo $row['YEAR']; ?></td>
                                    <td><?php echo $row['PLACA']; ?></td>
                                    <td class="text-center">
                                    <a id="<?php echo $row['ID']; ?>" class="btn btn-danger btnEditar" title='EDITAR'>
                                    <i class="fas fa-edit" style="color: black;"></i> <!-- changed fa to fas for consistency -->
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
    </div>  
    </div>   

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formVehiculos">    
                <div class="modal-body">
                    <div id="wizard">
                        <div class="step">
                            <h5>Paso 1: Información General</h5>
                            <div class="form-group">
                                <label for="fk_id_solicitud" class="col-form-label">ID Solicitud:</label>
                                <input type="text" class="form-control" id="fk_id_solicitud" value="<?php echo $id; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="serie" class="col-form-label">Serie:</label>
                                <input type="text" class="form-control" id="serie" required>
                            </div>
                            <div class="form-group">
                                <label for="motor" class="col-form-label">Motor:</label>
                                <input type="text" class="form-control" id="motor" required>
                            </div>
                        </div>
                        <div class="step" style="display:none;">
                            <h5>Paso 2: Detalles del Vehículo</h5>
                            <div class="form-group">
                                <label for="marca" class="col-form-label">Marca:</label>
                                <select id="marca" name="marca" class="form-control" required>
                                    <option value="TOYOTA">Toyota</option>
                                    <option value="NISSAN">Nissan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="modelo" class="col-form-label">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" required>
                            </div>
                            <div class="form-group">
                                <label for="year" class="col-form-label">Año:</label>
                                <select id="year" name="year" class="form-control" required>
                                    <option value="2010">2010</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>
                        <div class="step" style="display:none;">
                            <h5>Paso 3: Información Adicional</h5>
                            <div class="form-group">
                                <label for="tipo_vehiculo" class="col-form-label">Tipo de vehículo:</label>
                                <select id="tipo_vehiculo" name="tipo_vehiculo" class="form-control" required>
                                    <option value="Pick-Up">Pick-Up</option>
                                    <option value="Camioneta">Camioneta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-form-label">Color:</label>
                                <select id="color" name="color" class="form-control" required>
                                    <option value="ROJO">Rojo</option>
                                    <option value="BLANCO">Blanco</option>
                                </select>
                            </div>
                        </div>
                        <div class="step" style="display:none;">
                            <h5>Paso 4: Subir Imágenes</h5>
                            <div class="form-group">
                                <label for="img_front" class="col-form-label">Subir Imagen frontal:</label>
                                <input type="file" class="form-control" id="img_front" name="img_front" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="img_rear" class="col-form-label">Subir Imagen lateral derecha:</label>
                                <input type="file" class="form-control" id="img_rear" name="img_rear" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="img_left" class="col-form-label">Subir Imagen lateral izquierda:</label>
                                <input type="file" class="form-control" id="img_left" name="img_left" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="img_rigtht" class="col-form-label">Subir Imagen trasera:</label>
                                <input type="file" class="form-control" id="img_rigtht" name="img_rigtht" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="prevBtn" class="btn btn-light" style="display:none;">Anterior</button>
                    <button type="button" id="nextBtn" class="btn btn-dark">Siguiente</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark" style="display:none;">Guardar</button>
                </div>
            </form>    
        </div>
    </div>
</div>
 
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior2.php"?>