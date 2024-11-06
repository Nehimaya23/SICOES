<?php 

// Verifica si el ID de la empresa está definido


INCLUDE "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
<<<<<<< Updated upstream
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();

//session_start();
//echo "EL ID DEL SOLICITANTE ES: ".$_SESSION['ids'];
$id = $_SESSION['ids'];
$vehiculos= $sicoes->vehiculos($id);

?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Vehículos</h1>
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
                                          if ($row['ESTADO']=='1'){
                                             echo ' <td id="estado_elemento'.$row['ID'].'" class="valor_estado_elemento" value="ACTIVO"><span value="A" class="label label-success label-mini">ACTIVO</span></td>
                                                <td><a id="'.$row['ID'].'" class="fa fa-edit btn btn-danger enviar_actualizar_empleado"></a></td>';
                                          }elseif ($row['ESTADO']=='0') {
                                                 echo ' <td id="estado_elemento'.$row['ID'].'" class="valor_estado_elemento" value="INACTIVO"><span value="I"class="label label-danger label-mini">INACTIVO</span></td>
                                                <td><a value="'.$row['ID'].'" id="'.$row['ID'].'" class="fa fa-edit btn btn-danger enviar_actualizar_empleado"> </a></td>';}
                              echo '</tr>';
                            }?>                             
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    

=======
$sicoes = new valores_sicoes('');
//
$id =$_SESSION['ids'] ; // ID del solicitante
$vehiculos = $sicoes->vehiculos($id);
$empre = $sicoes->empre($id);
?>

<div class="background">
<!--INICIO del cont principal-->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Detalle Vehículos</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="SolicitudesEmpresa.php">Solicitudes de Empresas de Seguridad</a></li>
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
                            <td><?php echo date('d/m/Y', strtotime($row['FECHA'])); ?></td>
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
    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" title="Registro de Nueva Arma">
    <i class="fas fa-car"></i> Nuevo Vehículo
    </button>
>>>>>>> Stashed changes

 
    <br>
    
    <div class="table-responsive">    
    <br>
        
        <table id="tablaArmas" class="table table-striped table-bordered" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>                                
                    <th>Color</th>  
                    <th>Año</th>
                    <th>Placa</th>
                    <th>ACIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($vehiculos) ): ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['MARCA']; ?></td>
                        <td><?php echo $row['MDOELO']; ?></td>
                        <td><?php echo $row['COLOR']; ?></td>
                        <td><?php echo $row['YEAR']; ?></td>
                        <td><?php echo $row['PLACA']; ?></td>
                        <td class="text-center">
                        <a id="<?php echo $row['ID']; ?>" class="btn btn-primary btnEditar" title='EDITAR'>
                        <i class="fas fa-edit" style="color: black;"></i> <!-- changed fa to fas for consistency -->
                        </a>
                        <a id="<?php echo $row['ID']; ?>" class="btn btn-warning btnEditar" title='VISTA VEHÍCULO'>
                        <i class="fas fa-image" style="color: black;"></i> <!-- changed fa to fas for consistency -->
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

<!-- Modal for CRUD -->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
<<<<<<< Updated upstream
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
=======
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE NUEVO VEHICULO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
>>>>>>> Stashed changes
                </button>
            </div>
            <form id="formVehiculos">   
                <div class="modal-body">
                    <!-- Step 1: Basic Information -->
                    <div id="step-1" class="wizard-step">
                        <div class="form-group">
                            <label for="fk_id_solicitud" class="col-form-label">ID Solicitud:</label>
                            <input type="text" class="form-control" id="fk_id_solicitud" value="<?php echo $id; ?>" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="marca" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo" class="col-form-label">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" required>
                        </div>
                        <div class="form-group">
                            <label for="serie" class="col-form-label">Serie:</label>
                            <input type="text" class="form-control" id="serie" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-form-label">color:</label>
                            <input type="text" class="form-control" id="color" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_vehiculo" class="col-form-label">tipo_vehiculo:</label>
                            <input type="text" class="form-control" id="tipo_vehiculo" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                    </div>
                    
                    <!-- Step 2: Technical Details -->
                    <div id="step-2" class="wizard-step" style="display:none;">
                   
                        <div class="form-group">
                            <label for="motor" class="col-form-label">Motor:</label>
                            <input type="text" class="form-control" id="motor" required>
                        </div>
                        <div class="form-group">
                            <label for="cilindraje" class="col-form-label">cilindraje:</label>
                            <input type="text" class="form-control" id="cilindraje" required>
                        </div>
                        <div class="form-group">
                            <label for="year" class="col-form-label">Año:</label>
                            <input type="number" class="form-control" id="year" required>
                        </div>
                        <div class="form-group">
                            <label for="placa" class="col-form-label">placa:</label>
                            <input type="text" class="form-control" id="placa" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                    </div>
                    
                    <!-- Step 3: Additional Information -->
                    <div id="step-3" class="wizard-step" style="display:none;">
                        <div class="form-group">
                            <label for="img_front" class="col-form-label">Upload Front Image:</label>
                            <input type="file" class="form-control" id="img_front" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="img_rear" class="col-form-label">Upload Rear Image:</label>
                            <input type="file" class="form-control" id="img_rear" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="img_left" class="col-form-label">Upload Left Image:</label>
                            <input type="file" class="form-control" id="img_left" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="img_right" class="col-form-label">Upload Right Image:</label>
                            <input type="file" class="form-control" id="img_right" accept="image/*" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Back</button>
                        <button type="button" id="btnGuardar" class="btn btn-dark">Guardar</button>

                    </div>

                </div>
            </form> 
        </div>
    </div>
</div>


<script>
    function nextStep(step) {
        document.querySelectorAll('.wizard-step').forEach(stepDiv => stepDiv.style.display = 'none');
        document.getElementById(`step-${step}`).style.display = 'block';
    }

    function prevStep(step) {
        document.querySelectorAll('.wizard-step').forEach(stepDiv => stepDiv.style.display = 'none');
        document.getElementById(`step-${step}`).style.display = 'block';
    }
</script>


<style>
      
      .background {
          background-image: url('img/DICSPS.png'); /* Use your image path */
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;
          width: 100%;
          height: 100%;
      }
  </style>



<?php include "vistas/parte_inferior.php"; ?>
