
<?php 
require_once "vistas/parte_superior.php";

// INCLUDE E INVOCACIÓN DE METODOS Y CLASES
include_once('sicoes.class.php');
$sicoes= new valores_sicoes('');
$deptos= $sicoes->deptos();
$solicitantes= $sicoes->solicitantes();
?>

<!--INICIO del cont principal-->
<div class="container">
<h1 style="display: inline-block;">!Bienvenido  </h1>
<span class="h1 text-gray-600"><?php echo $_SESSION["s_usuario"]; ?>¡</span>
                     
           
          
</div>  

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>