
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$id = $_SESSION['ids']; 

$solicitudes= $sicoes->solicitudes_Empresas();
?>


<div class="background">
<div class="container">
    <h1>Solicitudes de Empresas de Seguridad</h1>
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
    <!-- Botón Arma Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="arma_empresa" class="btn btn-dark arma_empresa" title="ARMAS" aria-label="Ver armas de la empresa">
    
    
<i class="fas fa-gun icon-color"></i>
</a>

    <!-- Botón Empleados Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="emple_empresa" class="btn btn-secondary emple_empresa" title="EMPLEADOS" aria-label="Ver empleados de la empresa">
        <i class="fas fa-users icon-color"></i>
    </a>

    <!-- Botón Vehículos Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="vehic_empresa" class="btn btn-primary vehic_empresa" title="VEHÍCULOS" aria-label="Ver vehículos de la empresa">
        <i class="fas fa-car icon-color"></i>
    </a>

    <!-- Botón Detalle Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="Det_Empre" class="btn btn-info" title="DETALLE" aria-label="Ver detalles de la empresa">
        <i class="fas fa-file icon-color"></i>
    </a>

    <!-- Botón Permiso Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="Perm_empresa" class="btn btn-success Perm_empresa" title="PERMISO" aria-label="Ver permiso de la empresa">
        <i class="fas fa-certificate icon-color"></i>
    </a>

    <!-- Botón Documentación Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="doc_empresa" class="btn btn-warning doc_empresa" title="DOCUMENTACIÓN" aria-label="Ver documentación de la empresa">
        <i class="fas fa-file-alt icon-color"></i>
    </a>
</td>

<style>
    .icon-color {
        color: black; /* Use CSS to define icon colors */
    }
</style>



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

</div>



<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>