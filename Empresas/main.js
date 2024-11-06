// Inicialización de la tabla para "Personas" usando DataTables
$(document).ready(function(){
<<<<<<< Updated upstream
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
=======
    tablaArmas = $("#tablaArmas").DataTable({
       
>>>>>>> Stashed changes
        
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
    
<<<<<<< Updated upstream
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    pais = fila.find('td:eq(2)').text();
    edad = parseInt(fila.find('td:eq(3)').text());
    
    $("#nombre").val(nombre);
    $("#pais").val(pais);
    $("#edad").val(edad);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
=======
});

/* --------------------------------Empresa de Seguridad------------------------------------- */
   


/**ARMAS EMPRESA */
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
>>>>>>> Stashed changes
            }
        }
    });
<<<<<<< Updated upstream
  
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
=======
});


 /******Empleado Empresa*/
 
$( "a.emple_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'dEmple', id: id }; // Enviar id en la solicitud AJAX
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


 /**Vehiculo empresa*/
$( "a.vehic_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'dveh', id: id }; // Enviar id en la solicitud AJAX
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



 /**Permiso EMPRESA*/
 $( "a.Perm_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'dpermiso', id: id }; // Enviar id en la solicitud AJAX
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


 /**DOCUMENTACION EMPRESA*/
 $( "a.doc_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'ddocumentacionEmp', id: id }; // Enviar id en la solicitud AJAX
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



 /**Permiso EMPLEADO*/
 $( "a.Perm_empleado" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'dpermisoEmp', id: id }; // Enviar id en la solicitud AJAX
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









/* --------------------------------VEHICULOS BLINDADOS------------------------------------- */




 /**VEHICULO BLINDADO*/
 
 $( "a.Veh_Bli" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'dvehiculoBli', id: id }; // Enviar id en la solicitud AJAX
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

 /**DETALLE VEHICULO BLINDADO*/
 $( "a.doc_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'ddocumentacionEmp', id: id }; // Enviar id en la solicitud AJAX
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


 /**Permiso EMPLEADO*/
 $( "a.Perm_blinado" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'dpermisoBli', id: id }; // Enviar id en la solicitud AJAX
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
 /**DOCUMENTACION VEHICULO BLINDADO*/
 $( "a.doc_empresa" ).click(function() {
    var id = $(this).data('id'); // Cambiado de id a data-id

    // Validar que el id no sea undefined
    if (typeof id === 'undefined') {
        console.error("ID no definido");
        return; // Salir de la función si no hay ID
    }

    var valores = { od: 'ddocumentacionEmp', id: id }; // Enviar id en la solicitud AJAX
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
>>>>>>> Stashed changes
