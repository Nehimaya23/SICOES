
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="background">
<div class="container">
    <h1>Bienvenido <?php echo $_SESSION["s_usuario"];?></h1>
    <div class="container">
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