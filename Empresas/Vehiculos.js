$(document).ready(function() {
    // Initialize DataTable for Vehicles
    let tablaVehiculos = $("#tablaVehiculos").DataTable({
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

    // New Vehicle
    $("#btnNuevo").click(function(){
        $("#formVehiculo").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Vehículo");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // Alta
    });

    // Edit Vehicle
    let fila; // Capture the row to edit or delete
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        fk_id_solicitud = fila.find('td:eq(1)').text();
        serie = fila.find('td:eq(2)').text();
        motor = fila.find('td:eq(3)').text();
        marca = fila.find('td:eq(4)').text();
        modelo = fila.find('td:eq(5)').text();
        year = fila.find('td:eq(6)').text();
        tipo_vehiculo = fila.find('td:eq(7)').text();
        color = fila.find('td:eq(8)').text();
        cilindraje = fila.find('td:eq(9)').text();
        placa = fila.find('td:eq(10)').text();
        
        // Populate form fields with data
        $("#fk_id_solicitud").val(fk_id_solicitud);
        $("#serie").val(serie);
        $("#motor").val(motor);
        $("#marca").val(marca);
        $("#modelo").val(modelo);
        $("#year").val(year);
        $("#tipo_vehiculo").val(tipo_vehiculo);
        $("#color").val(color);
        $("#cilindraje").val(cilindraje);
        $("#placa").val(placa);

        opcion = 2; // Edit

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Vehículo");
        $("#modalCRUD").modal("show");
    });

    // Save Vehicle
   
    $("#formVehiculo").submit(function(e) {
        e.preventDefault();
        let fk_id_solicitud = $.trim($("#fk_id_solicitud").val());
        let serie = $.trim($("#serie").val());
        let motor = $.trim($("#motor").val());
        let marca = $.trim($("#marca").val());
        let modelo = $.trim($("#modelo").val());
        let year = $.trim($("#year").val());
        let tipo_vehiculo = $.trim($("#tipo_vehiculo").val());
        let color = $.trim($("#color").val());
        let cilindraje = $.trim($("#cilindraje").val());
        let placa = $.trim($("#placa").val());
    
        // Check if we are creating (opcion = 1) or updating (opcion = 2)
        let opcion = id ? 2 : 1;
    
        $.ajax({
            url: "bd/crudVehiculo.php",
            type: "POST",
            dataType: "json",
            data: {
                fk_id_solicitud: fk_id_solicitud,
                serie: serie,
                motor: motor,
                marca: marca,
                modelo: modelo,
                year: year,
                tipo_vehiculo: tipo_vehiculo,
                color: color,
                cilindraje: cilindraje,
                placa: placa,
                img_front: img_front,
                img_rear: img_rear,
                img_left: img_left,
                img_right: img_right,
                opcion: opcion,
                id: id
            },
            success: function(data) {
                console.log("AJAX Success:", data);
                let message = opcion === 2 ? '¡Edición exitosa!' : '¡Registro de Vehículo exitoso!';
                Swal.fire({
                    icon: 'success',
                    title: message,
                })
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo procesar la solicitud.',
                });
            }
        });
    });
        


});
