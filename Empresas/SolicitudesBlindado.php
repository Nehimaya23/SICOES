
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');

$solicitudes= $sicoes->solicitudes_Blindaje();
?>

<div class="background">

<div class="container">
    <h1>Solicitudes de Vehículos Blindados</h1>
    <div class="container">
        <div class="row">
            
        </div>    
    </div>    
    <br>  <br>  <br>  
    <div class="jumbotron jumbotron-fluid">
        
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="tablaArmas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>RTN</th>
                                <th>Denominación</th>
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
                                    <td><?php echo date('d/m/Y', strtotime($row['FECHA'])); ?></td>
                                    <td><?php echo $row['STATUS']; ?></td>
                                    <td>
   
    <!-- Car Icon (Vehicles) -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="Veh_Bli" class="btn btn-primary Veh_Bli" title='VEHÍCULOS'>
        <i class="fas fa-car" style="color: black;"></i> 
    </a>

    <!-- File Icon (Details) -->
    <a id="<?php echo $row['ID']; ?>" class="btn btn-info Det_Empre" title='DETALLE'>
        <i class="fas fa-file" style="color: black;"></i> <!-- corrected from fas-regular to fas, and fa-fil to fa-file -->
    </a>
     <!-- File Icon (Details) -->
   
     <a id="<?php echo $row['ID']; ?>" class="btn btn-warning Det_Empre" title="DOCUMENTACIÓN">
     <i class="fas fa-file-alt" style="color: black;"></i> <!-- You can also use 'fa-certificate' -->
     </a>

     <a data-id="<?php echo $row['ID']; ?>" data-action="Perm_blinado" class="btn btn-success Perm_blinado" title="PERMISO" aria-label="Ver permiso de la empresa">
        <i class="fas fa-certificate" style="color: black;"></i>
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


<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>