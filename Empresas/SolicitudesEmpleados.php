
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$id = $_SESSION['ids']; 

$solicitudes= $sicoes->EmpleadosDICSPS();
?>


<div class="background">
<div class="container">
    <h1>Empleados  DICSPS</h1>
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
                                <th>DNI</th>
                                <th>NOMBRES</th>
                                <th>TELEFONO</th>                                
                                <th>CORREO</th>  
                                <th>Acciones</th> <!-- Added column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($solicitudes)): ?>
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['DNI']; ?></td>
                                    <td><?php echo $row['NOMBRE']; ?></td>
                                    <td><?php echo $row['TELEFONO']; ?></td>
                                    <td><?php echo $row['CORREO']; ?></td>
                                    <td>
 
    <!-- Botón Permiso Empresa -->
    <a data-id="<?php echo $row['ID']; ?>" data-action="Perm_empleado" class="btn btn-success Perm_empleado" title="PERMISO" aria-label="Ver permiso de la empresa">
        <i class="fas fa-certificate icon-color"></i>
    </a>

    
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
            <label for="rtn" class="col-form-label">RTN:</label>
            <input type="text" class="form-control" id="rtn" required>
            <small id="rtnError" class="form-text text-danger" style="display: none;">El RTN es obligatorio y debe ser un número válido.</small>
        </div>
        <div class="form-group">
            <label for="razon_social" class="col-form-label">Razón Social:</label>
            <input type="text" class="form-control" id="razon_social" required>
            <small id="razonSocialError" class="form-text text-danger" style="display: none;">La Razón Social es obligatoria.</small>
        </div>
        <div class="form-group">
            <label for="fecha_inicio" class="col-form-label">Fecha Inicio:</label>
            <input type="date" class="form-control" id="fecha_inicio" required>
            <small id="fechaInicioError" class="form-text text-danger" style="display: none;">La Fecha de Inicio es obligatoria.</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
    </div>
</form>

<script>
    document.getElementById('formPersonas').addEventListener('submit', function(event) {
        // Previene el envío del formulario hasta que pase las validaciones
        event.preventDefault();
        
        let isValid = true;

        // Validar RTN
        const rtn = document.getElementById('rtn').value.trim();
        if (rtn === '' || isNaN(rtn) || rtn.length !== 14) {
            isValid = false;
            document.getElementById('rtnError').style.display = 'block';
        } else {
            document.getElementById('rtnError').style.display = 'none';
        }

        // Validar Razón Social
        const razonSocial = document.getElementById('razon_social').value.trim();
        if (razonSocial === '') {
            isValid = false;
            document.getElementById('razonSocialError').style.display = 'block';
        } else {
            document.getElementById('razonSocialError').style.display = 'none';
        }

        // Validar Fecha de Inicio
        const fechaInicio = document.getElementById('fecha_inicio').value;
        if (fechaInicio === '') {
            isValid = false;
            document.getElementById('fechaInicioError').style.display = 'block';
        } else {
            document.getElementById('fechaInicioError').style.display = 'none';
        }

        // Si todo es válido, se puede enviar el formulario
        if (isValid) {
            // Aquí puedes enviar el formulario, por ejemplo con:
            // document.getElementById('formPersonas').submit();
            alert('Formulario enviado correctamente.');
        }
    });
</script>

        </div>
    </div>
</div>  

<style>
      
      .background {
          background-image: url('../img/DICSPS.png'); /* Use your image path */
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