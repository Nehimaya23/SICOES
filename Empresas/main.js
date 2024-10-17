// Inicialización de la tabla para "Personas" usando DataTables
$(document).ready(function(){
    tablaArmas = $("#tablaArmas").DataTable({
       
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
    $("#btnNuevo").click(function(){
        var formId = $(this).data('form-id');
        $("#" + formId).trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Arma");            
        $("#modalCRUD").modal("show");        
        id = null;
        opcion = 1; //alta
    });


    
var fila; //capturar la fila para editar o borrar el registro
$(document).ready(function(){
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tablaPersonas tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});   
// Función para el botón "Editar"
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr"); // Obtener la fila seleccionada
    id = parseInt(fila.find('td:eq(0)').text()); // Obtener el ID de la fila
    nombre = fila.find('td:eq(1)').text(); // Obtener el nombre
    pais = fila.find('td:eq(2)').text(); // Obtener el país
    edad = parseInt(fila.find('td:eq(3)').text()); // Obtener la edad

    // Llenar los campos del formulario con los datos de la fila seleccionada
    $("#nombre").val(nombre);
    $("#pais").val(pais);
    $("#edad").val(edad);
    opcion = 2; // Editar (actualizar registro)

    // Cambiar el estilo del modal para modo edición
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar arma"); // Cambiar el título del modal
    $("#modalCRUD").modal("show"); // Mostrar el modal
});







$(document).ready(function() {
    $('#formArmas').submit(function(e) {
        e.preventDefault(); // Evita el envío inmediato del formulario

        // Validaciones personalizadas
        var marca = $('#marca').val();
        var modelo = $('#modelo').val();
        var serie = $('#serie').val();
        var regBalistico = $('#reg_balistico').val();
        var tipoArma = $('#tipo_arma').val();
        
        if (!marca || !modelo || !regBalistico || !tipoArma) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        // Si las validaciones son correctas, envía el formulario (aquí puedes hacer una petición AJAX si lo deseas)
        this.submit();
    });
});

$("#formArmas").submit(function(e){
    e.preventDefault();    
    fk_id_solicitud = $.trim($("#fk_id_solicitud").val());
    marca = $.trim($("#marca").val());
    modelo = $.trim($("#modelo").val());
    serie = $.trim($("#serie").val());
    reg_balistico = $.trim($("#reg_balistico").val());
    tipo_arma = $.trim($("#tipo_arma").val()); 
    

    

    $.ajax({
        url: "bd/crudArma.php",
        type: "POST",
        dataType: "json",
        data: {fk_id_solicitud:fk_id_solicitud, marca:marca, serie:serie,modelo:modelo, reg_balistico:reg_balistico, tipo_arma:tipo_arma, opcion:opcion},
        success: function(data){  
            console.log(data);
            fk_id_solicitud = data[0]. fk_id_solicitud;            
            marca = data[0]. marca;
            modelo = data[0].modelo;
            serie = data[0].serie;
            reg_balistico = data[0].reg_balistico;
            tipo_arma = data[0].tipo_arma;
           
            if(opcion == 1){tablaPersonas.row.add([fk_id_solicitud, marca,modelo,serie,reg_balistico,tipo_arma]).draw();}
            else{tablaPersonas.row(fila).data([fk_id_solicitud, marca,modelo,serie,reg_balistico,tipo_arma]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});




//CONTROL PARA SELECCIÓN DE MUNICIPIOS EN FUNCIÓN DEL DEPARTAMENTO
$( "#depto" ).on('change', function () {
    var id = $(this).val();
    //console.log(departamento);
    var valores = {od:'sel_mun',
                   cod_depto:id
    };
    $.ajax({
    data:  valores,
    url:   'crud.php',
    type:  'post',
    success:  function (respuesta) {
          var obj = JSON.parse(respuesta);
          //console.log(obj.depto_correcto);
          if(obj.answ == 1){
            $("#muni").html(obj.resp);
            $("#muni").removeAttr('disabled');
          }else {
            alert("NO FUE POSIBLE OBTENER RESULTADOS");
          }
        }
    });
  
  });

  //FUNCION PARA TRAER EL FORMULARIO DE EDITAR EMPLEADO
$( "a.vehic_empresa" ).click(function() {
    var valores = {od:'dveh',
                   id:$(this).attr('id')};
    var url = 'crud.php';
              $.ajax({
                  data:  valores,
                  url:   url,
                  type:  'post',
                  success:  function (respuesta) {
                    var obj = JSON.parse(respuesta);
                    if(obj.answ == 1){
                        window.location.assign(obj.url);
                    }
                  }
                });

    //$('#formulario_empleados').attr('hidden', true);
    //$('#formulario_edita_empleados').attr('hidden', false);

});
$( "a.emple_empresa" ).click(function() {
    var valores = {od:'dEmple',
                   id:$(this).attr('id')};
    var url = 'crud.php';
              $.ajax({
                  data:  valores,
                  url:   url,
                  type:  'post',
                  success:  function (respuesta) {
                    var obj = JSON.parse(respuesta);
                    if(obj.answ == 1){
                        window.location.assign(obj.url);
                    }
                  }
                });

    //$('#formulario_empleados').attr('hidden', true);
    //$('#formulario_edita_empleados').attr('hidden', false);

});


$( "a.Det_Empre" ).click(function() {
    var valores = {od:'dDet_Emp',
                   id:$(this).attr('id')};
    var url = 'crud.php';
              $.ajax({
                  data:  valores,
                  url:   url,
                  type:  'post',
                  success:  function (respuesta) {
                    var obj = JSON.parse(respuesta);
                    if(obj.answ == 1){
                        window.location.assign(obj.url);
                    }
                  }
                });

    //$('#formulario_empleados').attr('hidden', true);
    //$('#formulario_edita_empleados').attr('hidden', false);

});
$( "a.arma_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'darms', id: id }; // Enviar id en la solicitud AJAX
    var url = 'crud.php';
    
    $.ajax({
        data: valores,
        url: url,
        type: 'post',
        success: function (respuesta) {
            var obj = JSON.parse(respuesta);
            if (obj.answ == 1) {
                window.location.assign(obj.url);
            }
        }
    });
});

/*$( "a.Arma_empresa" ).click(function() {
    var valores = {od:'darms',
                   id:$(this).attr('id')};
    var url = 'crud.php';
              $.ajax({
                  data:  valores,
                  url:   url,
                  type:  'post',
                  success:  function (respuesta) {
                    var obj = JSON.parse(respuesta);
                    if(obj.answ == 1){
                        window.location.assign(obj.url);
                    }
                  }
                });

    //$('#formulario_empleados').attr('hidden', true);
    //$('#formulario_edita_empleados').attr('hidden', false);

});*/