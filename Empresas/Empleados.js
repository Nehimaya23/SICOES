$(document).ready(function() {
    $('#tablaEmpleados').DataTable({
        // Configuración opcional
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});

$(document).ready(function() {
    // Inicialización de DataTables
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
        $("#tablaEmpleados tbody tr").filter(function() {
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
        $(".modal-title").text("Editar Empleados");
        $("#modalCRUD1").modal("show");
    });

    // Manejo del formulario de empleados
    $(document).ready(function() {
        $('#formEmpleados').submit(function(e) {
            e.preventDefault(); // Evita el envío inmediato del formulario
    
            // Obtener valores de los campos
            var dni = $.trim($("#dni").val());
            var nombres = $.trim($("#nombres").val());
            var apellidos = $.trim($("#apellidos").val());
            var telefono = $.trim($("#telefono").val());
            var tipo_empleado = $.trim($("#tipo_empleado").val());
            var cargo = $.trim($("#cargo").val());
            var fecha = $.trim($("#fecha").val());
    
            // Validaciones adicionales
            if (!dni || !nombres || !apellidos || !telefono || !tipo_empleado || !cargo || !fecha) {
                alert('Por favor, complete todos los campos obligatorios.');
                return;
            }
    
            // Validar que el DNI tenga al menos 13 dígitos y solo contenga números
            if (dni.length < 13 || !/^\d+$/.test(dni)) {
                alert('El DNI debe tener al menos 13 dígitos y solo contener números.');
                return;
            }
    
            // Si las validaciones son correctas, envía el formulario (aquí puedes hacer una petición AJAX si lo deseas)
            $.ajax({
                url: "bd/crudEmpleado.php",
                type: "POST",
                dataType: "json",
                data: {
                    fk_id_solicitud: $.trim($("#fk_id_solicitud").val()),
                    dni: dni,
                    nombres: nombres,
                    apellidos: apellidos,
                    telefono: telefono,
                    tipo_empleado: tipo_empleado,
                    cargo: cargo,
                    fecha: fecha,
                    opcion: opcion
                },
                success: function(data) {
                    if (opcion == 1) {
                        tablaEmpleados.row.add([data.id, dni, nombres, apellidos, telefono, tipo_empleado, cargo, fecha]).draw();
                    } else {
                        tablaEmpleados.row(fila).data([data.id, dni, nombres, apellidos, telefono, tipo_empleado, cargo, fecha]).draw();
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
            url: 'crudEmpleados.php',
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

