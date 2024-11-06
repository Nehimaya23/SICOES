$(document).ready(function() {
    // Inicialización de la tabla para Empleados
    tablaEmpleados = $("#tablaEmpleados").DataTable({
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
            "sProcessing":"Procesando..."
        }
    });

    // Nuevo empleado
    $("#btnNuevo").click(function(){
        var formId = $(this).data('form-id');
        $("#" + formId).trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Empleado");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // Alta
    });

    // Editar empleado
    var fila; //capturar la fila para editar o borrar el registro
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        dni = fila.find('td:eq(1)').text();
        nombres = fila.find('td:eq(2)').text();
        apellidos = fila.find('td:eq(3)').text();
        telefono = fila.find('td:eq(4)').text();
        tipo_empleado = fila.find('td:eq(5)').text();
        cargo = fila.find('td:eq(6)').text();
        fecha = fila.find('td:eq(7)').text();

        // Llenar los campos del formulario con los datos de la fila seleccionada
        $("#dni").val(dni);
        $("#nombres").val(nombres);
        $("#apellidos").val(apellidos);
        $("#telefono").val(telefono);
        $("#tipo_empleado").val(tipo_empleado);
        $("#cargo").val(cargo);
        $("#fecha").val(fecha);
        opcion = 2; // Modificar

        // Cambiar estilo del modal para edición
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Empleado");
        $("#modalCRUD").modal("show");
    });

    // Guardar datos
   
    $("#formEmpleado").submit(function(e) {
        e.preventDefault();
        let fk_id_solicitud = $.trim($("#fk_id_solicitud").val());
        let dni = $.trim($("#dni").val());
        let nombres = $.trim($("#nombres").val());
        let apellidos = $.trim($("#apellidos").val());
        let telefono = $.trim($("#telefono").val());
        let tipo_empleado = $.trim($("#tipo_empleado").val());
        let cargo = $.trim($("#cargo").val());
        let fecha = $.trim($("#fecha").val());
        
        // Use the value of `id` defined in the edit function to determine the action
        let opcion = id ? 2 : 1; // If id is defined, we're editing; otherwise, we're adding a new record
    
        $.ajax({
            url: "bd/crudEmpleado.php",
            type: "POST",
            dataType: "json",
            data: {
                fk_id_solicitud: fk_id_solicitud,
                dni: dni,
                nombres: nombres,
                apellidos: apellidos,
                telefono: telefono,
                tipo_empleado: tipo_empleado,
                cargo: cargo,
                fecha: fecha,
                opcion: opcion,
                id: id
            },
            success: function(data) {
                console.log("AJAX Success:", data);
                let message = opcion === 2 ? '¡Edición exitosa!' : '¡Registro de Empleado exitoso!'; // Change message based on the operation
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
