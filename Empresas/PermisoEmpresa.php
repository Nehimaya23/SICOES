<?php 

// Verifica si el ID de la empresa está definido


include_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes = new valores_sicoes('');

//
$id = $_SESSION['ids']; // ID del solicitante
$armas = $sicoes->armas($id);
$empre = $sicoes->empre($id);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

<div class="background">
<!--INICIO del cont principal-->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Permiso de Empresa de seguridad</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="SolicitudesEmpresa.php">Solicitudes de Empresas de seguridad</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permiso de Empresa </li>
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
        <p class="lead">Permiso</p>
        <button id="btnNuevo" type="button" class="btn btn-success"   onclick="generatePDF()">
            <i class="fas fa-print"></i> Imprimir  
        </button>

        <!-- ID card-sized sections -->
        <div class="d-flex justify-content-around mt-4">
            <div class="id-card front-card" id="card-front">
      
            </div>




       
        </div>
        <br>
    </div>
    



</div>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <p class="lead">Permiso</p>
        

        <!-- ID card-sized sections -->
        <div class="d-flex justify-content-around mt-4">
           
        <div class="id-card back-card" id="card-back">
           
           </div>



       
        </div>
        <br>
    </div>
</div>

<style>
    .signature-container {
    display: flex;
    justify-content: space-around;
    margin-top: 75px;
}

.signature p {
    color: black;
    font-size: 8px;
    text-align: center;
}

    .background {
    background-image: url('img/DICSPS.png'); /* Use your image path */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    width: 100%;
    height: 100%;
}

.wpT {
    color: white;
    margin: 0;
    margin-top: -4px;
    margin-left: 80px;
    margin-right: -5px;
    font-size: 6px;
    flex: 1;
    text-align: center;
}
.wp {
    color: black;
    margin: 0;
    margin-top: -4px;
    margin-left: -5px;
    margin-right: -5px;
    font-size: 8px;
    flex: 1;
    text-align: justify;
}
.wp2 {
    color: black;
    margin: 0;
    margin-top: -9px;
    margin-left: 150px;
    margin-right: -5px;
    font-size: 8px;
    flex: 1;
    text-align: justify;
}
.wp3 {
    color: black;
    margin: 0;
    margin-top: 20px;
    margin-left: -120px;
    margin-right: -5px;
    font-size: 8px;
    flex: 1;
    text-align: justify;
}
.wp4 {
    color: white;
    margin: 0;
    margin-top: 125px;
    margin-left: 100px;
    margin-right: -5px;
    font-size: 10px;
    flex: 1;
    text-align: justify;
}

.id-card {
    width: 8.5in; /* Ancho de una hoja carta */
    height: 11in; /* Altura de una hoja carta */
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 40px; /* Ajusta el padding para un mejor margen interno */
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Asegura que el contenido no se desborde */
}




</style>


<script>
  function generatePDF() {
    const { jsPDF } = window.jspdf;

    try {
        // Capture front and back card images with html2canvas
        html2canvas(document.getElementById("card-front"), { scale: 2 }).then(canvasFront => {
            html2canvas(document.getElementById("card-back"), { scale: 2 }).then(canvasBack => {

                const imgDataFront = canvasFront.toDataURL("image/png");
                const imgDataBack = canvasBack.toDataURL("image/png");

                const pdf = new jsPDF({
                    orientation: "portrait",
                    unit: "in",
                    format: [4, 6],
                    compress: true 
                });

                // Add images to PDF with specified size
                pdf.addImage(imgDataFront, 'PNG', 0, 0, 4, 6);
                pdf.addPage();
                pdf.addImage(imgDataBack, 'PNG', 0, 0, 4, 6);

                pdf.save("flip-card.pdf");
            });
        });
    } catch (error) {
        console.error("Error generating PDF:", error);
    }
}


function rotateBackCanvas(canvas) {
    const rotatedCanvas = document.createElement("canvas");
    rotatedCanvas.width = canvas.width;
    rotatedCanvas.height = canvas.height;
    const ctx = rotatedCanvas.getContext("2d");
    
    ctx.translate(rotatedCanvas.width / 2, rotatedCanvas.height / 2);
    ctx.rotate(Math.PI);
    ctx.drawImage(canvas, -canvas.width / 2, -canvas.height / 2);
    
    return rotatedCanvas;
}

</script>


<?php include "vistas/parte_inferior.php"; ?>
