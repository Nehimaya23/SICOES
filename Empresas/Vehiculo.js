$(document).ready(function() {
    // Inicialización de DataTables
    tablaVehiculos = $("#tablaVehiculos").DataTable({
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

    // Eventos y otras inicializaciones
    $("#btnNuevo").click(function() {
        var formId = $(this).data('form-id');
        $("#" + formId).trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a").css("color", "white");
        $(".modal-title").text("Nuevo Empleado");
        $("#modalCRUD1").modal("show");
        id = null;
        opcion = 1; // Alta
    });

    // Filtro de búsqueda
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tablaVehiculos tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Manejo del botón "Editar"
    $(document).on("click", ".btnEditar", function() {
        fila = $(this).closest("tr"); // Obtener la fila seleccionada
        id = parseInt(fila.find('td:eq(0)').text()); // Obtener el ID
        nombre = fila.find('td:eq(1)').text(); // Obtener el nombre
        pais = fila.find('td:eq(2)').text(); // Obtener el país
        edad = parseInt(fila.find('td:eq(3)').text()); // Obtener la edad

        $("#nombre").val(nombre);
        $("#pais").val(pais);
        $("#edad").val(edad);
        opcion = 2; // Editar

        $(".modal-header").css("background-color", "#4e73df").css("color", "white");
        $(".modal-title").text("Editar Vehiculos");
        $("#modalCRUD1").modal("show");
    });

    // Manejo del formulario de Vehiculos
    $(document).ready(function() {
        $('#formVehiculos').submit(function(e) {
            e.preventDefault(); // Evita el envío inmediato del formulario
    
            // Obtener valores de los campos
            
            var fk_id_solicitud = $.trim($("#fk_id_solicitud").val());
            var serie = $.trim($("#serie").val());
            var motor = $.trim($("#motor").val());
            var marca = $.trim($("#marca").val());
            var modelo = $.trim($("#modelo").val());
            var year = $.trim($("#year").val());
            var tipo_vehiculo = $.trim($("#tipo_vehiculo").val());
            var color = $.trim($("#color").val());
            var cilindraje = $.trim($("#cilindraje").val());
            var placa = $.trim($("#placa").val());
            var img_front = $.trim($("#img_front").val());
            var img_rear = $.trim($("#img_rear").val());
            var img_left = $.trim($("#img_left").val());
            var img_rigtht = $.trim($("#img_rigtht").val());



            // Validaciones adicionales
            if (!serie || !motor || !marca || !modelo || !year || !tipo_vehiculo || !color || !cilindraje || !placa || !img_front || !img_rear || !img_left || !img_rigtht) {
                alert('Por favor, complete todos los campos obligatorios.');
                return;
            }
    
            // Si las validaciones son correctas, envía el formulario (aquí puedes hacer una petición AJAX si lo deseas)
            $.ajax({
                url: "bd/crudVehiculo.php",
                type: "POST",
                dataType: "json",
                data: {
                    fk_id_solicitud: $.trim($("#fk_id_solicitud").val()),
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
                    img_rigtht: img_rigtht,
                    opcion: opcion
                },
                success: function(data) {
                    if (opcion == 1) {
                        tablaVehiculos.row.add([data.id,serie,motor,marca,modelo,year,tipo_vehiculo,color,cilindraje,placa,img_front,img_rear,img_left,img_rigtht ]).draw();
                    } else {
                        tablaVehiculos.row(fila).data([data.id,serie,motor,marca,modelo,year,tipo_vehiculo,color,cilindraje,placa,img_front,img_rear,img_left,img_rigtht  ]).draw();
                    }
                    $("#modalCRUD1").modal("hide"); // Ocultar el modal
                }
            });
        });
    });

    // Control para selección de municipios
    $("#depto").on('change', function() {
        var id = $(this).val();
        var valores = { od: 'sel_mun', cod_depto: id };
        $.ajax({
            data: valores,
            url: 'crudVehiculos.php',
            type: 'post',
            success: function(respuesta) {
                var obj = JSON.parse(respuesta);
                if (obj.answ == 1) {
                    $("#muni").html(obj.resp).removeAttr('disabled');
                } else {
                    alert("NO FUE POSIBLE OBTENER RESULTADOS");
                }
            }
        });
    });
});

$(document).ready(function () {
    let currentStep = 0; // Paso actual
    const steps = $('.step'); // Selecciona todos los pasos

    // Muestra el primer paso al abrir el modal
    function showStep(step) {
        steps.hide(); // Oculta todos los pasos
        $(steps[step]).show(); // Muestra el paso actual

        // Cambia la visibilidad de los botones según el paso
        $('#prevBtn').toggle(step > 0);
        $('#nextBtn').toggle(step < steps.length - 1);
        $('#btnGuardar').toggle(step === steps.length - 1);
    }

    // Evento para el botón "Siguiente"
    $('#nextBtn').click(function () {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Evento para el botón "Anterior"
    $('#prevBtn').click(function () {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Muestra el primer paso al cargar el modal
    $('#modalCRUD1').on('show.bs.modal', function () {
        currentStep = 0; // Reinicia el paso
        showStep(currentStep);
    });

    // Manejo del envío del formulario
    $('#formVehiculos').on('submit', function (e) {
        e.preventDefault(); // Evita el envío normal

        // Aquí podrías agregar la lógica para manejar el envío del formulario
        var formData = new FormData(this);
        
        $.ajax({
            type: 'POST',
            url: 'ruta/a/tu/archivo.php', // Cambia esto a la ruta correcta
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                $('#modalCRUD1').modal('hide'); // Cierra el modal
                // Aquí podrías actualizar la tabla o mostrar un mensaje de éxito
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});
