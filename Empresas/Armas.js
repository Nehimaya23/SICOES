
$(document).ready(function(){
    // Verifica si la tabla ya está inicializada
    if (!$.fn.DataTable.isDataTable('#tablaArmas')) {
        // Inicializa la tabla solo si no está inicializada
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
    }
    
   





    $("#btnNuevo").click(function(){
        $("#formArmas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Arma");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // alta
    });
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr"); // Encuentra la fila del registro
    id = parseInt(fila.find('td:eq(0)').text()); // Obtiene el ID de la primera columna
    fk_id_solicitud = fila.find('td:eq(1)').text(); // Obtiene el ID de Solicitud de la segunda columna
    marca = fila.find('td:eq(2)').text(); // Obtiene la marca de la tercera columna
    modelo = fila.find('td:eq(3)').text(); // Obtiene el modelo de la cuarta columna
    serie = fila.find('td:eq(4)').text(); // Obtiene la serie de la quinta columna
    reg_balistico = fila.find('td:eq(5)').text(); // Obtiene el registro balístico de la sexta columna
    tipo_arma = fila.find('td:eq(6)').text(); // Obtiene el tipo de arma de la séptima columna

    // Asigna los valores a los campos del formulario en la modal
    $("#fk_id_solicitud").val(fk_id_solicitud); // Asigna ID de solicitud al campo
    $("#marca").val(marca); // Asigna marca al campo
    $("#modelo").val(modelo); // Asigna modelo al campo
    $("#serie").val(serie); // Asigna serie al campo
    $("#reg_balistico").val(reg_balistico); // Asigna registro balístico al campo
    $("#tipo_arma").val(tipo_arma); // Asigna tipo de arma al campo
    
    // Define la opción como 2 (editar)
    opcion = 2; 

    // Modifica la apariencia de la modal para indicar que es una edición
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar arma");
    
    // Muestra la modal
    $("#modalCRUD").modal("show");
});


    $("#formArmas").submit(function(e) {
        e.preventDefault();
    
        // Get values from form
        let fk_id_solicitud = $.trim($("#fk_id_solicitud").val());
        let marca = $.trim($("#marca").val());
        let modelo = $.trim($("#modelo").val());
        let serie = $.trim($("#serie").val());
        let reg_balistico = $.trim($("#reg_balistico").val());
        let tipo_arma = $.trim($("#tipo_arma").val());
        
        // Use the value of `id` defined in the edit function to determine the action
        let opcion = id ? 2 : 1; // If id is defined, we're editing; otherwise, we're adding a new record
    
        $.ajax({
            url: "bd/crudArma.php",
            type: "POST",
            dataType: "json",
            data: {
                fk_id_solicitud: fk_id_solicitud,
                marca: marca,
                modelo: modelo,
                serie: serie,
                reg_balistico: reg_balistico,
                tipo_arma: tipo_arma,
                opcion: opcion,
                id: id
            },
            success: function(data) {
                    
                let message = opcion === 2 ? '¡Edición exitosa!' : '¡Registro de Arma exitoso!'; // Change message based on the operation
                Swal.fire({
                    icon: 'success',
                    title: message,
                }).then(() => {
                    $("#modalCRUD").modal("hide");
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo procesar la solicitud.',
                });
            }
        });
    });
    
    
});
       