<?php 

// Verifica si el ID de la empresa está definido


INCLUDE "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
setlocale(LC_TIME, 'es_ES.UTF-8'); // Sets the locale to Spanish

$sicoes = new valores_sicoes('');

//;
$id = $_SESSION['ids'] ;// ID del solicitante

$empre = $sicoes->empre($id);

$empleados = $sicoes->empleados_empre($id);

?>

<div class="background">
<!--INICIO del cont principal-->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Detalle Empleados</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="SolicitudesEmpresa.php">Solicitudes de Empresas de Seguridad</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalle Empleados</li>
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
    <p class="lead">Empleados registrados</p>
    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" title="Registro de Nueva Arma">
    <i class="fas fa-users"></i> Nuevo Empleado
    </button>

 
    <br>
    
    <div class="table-responsive">    
     <br>
        
        <table id="tablaArmas" class="table table-striped table-bordered" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>NOMBRE</th>                                
                    <th>CARGO</th>  
                    <th>TELEFONO</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($empleados)) : ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['DNI']; ?></td>
                        <td><?php echo $row['NOMBRE']; ?></td>
                        <td><?php echo $row['CARGO']; ?></td>
                        <td><?php echo $row['TELEFONO']; ?></td>
                        <td class="text-center">
                        <a id="<?php echo $row['ID']; ?>" class="btn btn-primary btnEditar" title='EDITAR'>
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

<!-- Modal para CRUD Empleado -->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEmpleado">   
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fk_id_solicitud" class="col-form-label">ID Solicitud:</label>
                        <input type="text" class="form-control" id="fk_id_solicitud" value="<?php echo $id; ?>" readonly>
                    </div> 
                    <div class="form-group">
                        <label for="dni" class="col-form-label">DNI</label>
                        <input type="text" class="form-control" id="dni" required>
                    </div>
                    <div class="form-group">
                        <label for="nombres" class="col-form-label">Nombres:</label>
                        <input type="text" class="form-control" id="nombres" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos" class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="col-form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_empleado" class="col-form-label">Tipo de Empleado:</label>
                        <input type="text" class="form-control" id="tipo_empleado" required>
                    </div>
                    <div class="form-group">
                        <label for="cargo" class="col-form-label">Cargo:</label>
                        <input type="text" class="form-control" id="cargo" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="col-form-label">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" required>
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
