<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();

//session_start();
//echo "EL ID DEL SOLICITANTE ES: ".$_SESSION['ids'];
$id = $_SESSION['ids'];
$empre = $sicoes->empre($id);
$empleados_empre= $sicoes->empleados_empre($id);

?>

<!--INICIO del cont principal-->
<div class="container">
    
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Detalle Empleados</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.php">Solicitudes de Empresas de Seguridad</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalle Empleados</li>
        </ol>
    </nav>
</div>

<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <p class="lead">Datos de la solicitud</p>
        <div class="table-responsive">        
        <table  class="table table-borderless">
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
    <p class="lead">Empleados registrados</p>
    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" title="Registro de Nuevo Empleado">
    <i class="fas fa-users"></i> Nuevo Empleado
    </button>
    
    <div class="table-responsive">    
    <br>
    <table id="tablaEmpleados" class="table table-striped table-bordered table-condensed" style="width:100%">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>NOMBRE</th>                                
                <th>TIPO EMPLEADO</th>  
                <th>CARGO</th> 
                <th>TELÉFONO</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($empleados_empre)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID']); ?></td>
                    <td><?php echo htmlspecialchars($row['DNI']); ?></td>
                    <td><?php echo htmlspecialchars($row['NOMBRE']); ?></td>
                    <td><?php echo htmlspecialchars($row['TIPO_EMPLEADO']); ?></td>
                    <td><?php echo htmlspecialchars($row['CARGO']); ?></td>
                    <td><?php echo htmlspecialchars($row['TELEFONO']); ?></td>
                    <td class="text-center">
                        <a id="<?php echo $row['ID']; ?>" class="btn btn-danger btnEditar" title='EDITAR'>
                            <i class="fas fa-edit" style="color: black;"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>       
        </tbody>        
    </table>                    
</div>

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formEmpleados">    
                <div class="modal-body">

                    <div class="form-group">
                        <label for="fk_id_solicitud" class="col-form-label">ID Solicitud:</label>
                        <input type="text" class="form-control" id="fk_id_solicitud" value="<?php echo $id; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="dni" class="col-form-label">DNI:</label>
                        <input type="text" class="form-control" id="dni">
                    </div>

                    <div class="form-group">
                        <label for="nombres" class="col-form-label">Nombres:</label>
                        <input type="text" class="form-control" id="nombres">
                    </div>

                    <div class="form-group">
                        <label for="apellidos" class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos">
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="col-form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono">
                    </div>

                    <div class="form-group">
                        <label for="tipo_empleado" class="col-form-label">Rol:</label>
                        <select id="tipo_empleado" name="rol" class="form-control">
                            <option value="operativo">Operativo</option>
                            <option value="administrativo">Administrativo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cargo" class="col-form-label">Cargo:</label>
                        <input type="text" class="form-control" id="cargo">
                    </div>

                    <div class="form-group">
                        <label for="fecha" class="col-form-label">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" required>
                    </div>

                    <!-- Descomentar si es necesario el campo de departamento -->
                    <!--
                    <div class="form-group">
                        <label for="depto" class="col-form-label">Departamento:</label>
                        <select name="depto" id="depto" class="form-control">
                            <?php while ($fila = mysqli_fetch_assoc($deptos)) { ?>
                                <option value="<?php echo $fila['ID']?>"><?php echo $fila['DESCRIP']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    -->

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
<?php require_once "vistas/parte_inferior1.php"?>