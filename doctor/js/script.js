$(document).ready(function() {
    $('#btnSearch').click(function() {
        var searchQuery = $('#searchMedicine').val();
        $.ajax({
            url: 'searchMedicine.php',
            type: 'GET',
            data: { query: searchQuery },
            dataType: 'json', // Asegúrate de que la respuesta sea tratada como JSON
            success: function(response) {
                // Aquí puedes actualizar tu interfaz con los resultados de la búsqueda
                //console.log(response);




                // Suponiendo que 'response' es un array de objetos medicamentos

                // Encuentra el cuerpo de la tabla donde se cargarán los medicamentos
                var tableBody = $('#medicinesList tbody');
                // Limpia el cuerpo de la tabla
                tableBody.empty();

                // Itera a través de los resultados de la búsqueda y agrega una fila por cada uno
                response.forEach(function(medicine) {
                    // Crea una nueva fila y celdas para los datos del medicamento
                    var row = $('<tr></tr>');
                    row.append($('<td></td>').text(medicine.id));
                    row.append($('<td></td>').text(medicine.nombremed));
                    row.append($('<td></td>').text(medicine.formafarmaceutica));
                    // Añade la fila al cuerpo de la tabla
                    tableBody.append(row);

                });






            }
        });
    });

    $('#btnAddToList').click(function() {
        var medicineName = $('#searchMedicine').val();
        var quantity = $('#quantity').val();
        var description = $('#description').val();

        // Añadir a la lista
        $('#medicinesList tbody').append('<tr><td>' + medicineName + '</td><td>' + quantity + '</td><td>' + description + '</td><td><button class="edit">Editar</button> <button class="delete">Eliminar</button></td></tr>');
        
        // Limpiar los campos
        $('#searchMedicine').val('');
        $('#quantity').val('');
        $('#description').val('');
    });


    // Suponiendo que esta función se llama cuando recibes la respuesta del servidor
    function loadMedicinesIntoTable(medicines) {
        var tableBody = $('#medicinesList tbody');
        tableBody.empty(); // Limpia la tabla antes de cargar nuevos elementos

        medicines.forEach(function(medicine) {
            var row = $('<tr></tr>');
            row.append($('<td></td>').text(medicine.id));
            row.append($('<td></td>').text(medicine.nombremed));
            row.append($('<td></td>').text(medicine.formafarmaceutica));
            row.append($('<td></td>').html('<button class="edit">Editar</button> <button class="delete">Eliminar</button>'));
            tableBody.append(row);
        });
    }

    // Evento para botones de editar y eliminar, como se muestra anteriormente
    $('#medicinesList').on('click', '.edit', function() {
        // Implementar la lógica de edición aquí
    });
    $('#medicinesList').on('click', '.delete', function() {
        $(this).closest('tr').remove();
    });




    $('#btnSavePrescription').click(function() {
        var prescriptionData = [];
        
        // Iterar a través de cada fila de la tabla
        $('#medicinesList tbody tr').each(function() {
            var row = $(this);
            var medicine = row.find('td:eq(0)').text(); // Obtener el medicamento
            var quantity = row.find('td:eq(1)').text(); // Obtener la cantidad
            var description = row.find('td:eq(2)').text(); // Obtener la descripción
            
            // Añadir al array de datos
            prescriptionData.push({
                medicine: medicine,
                quantity: quantity,
                description: description
            });
        });
    
        // Ahora prescriptionData tiene todos los datos de la tabla
        // Enviar al servidor
        $.ajax({
            url: 'savePrescription.php', // Cambia esta URL por la URL de tu servidor
            type: 'POST',
            contentType: 'application/json', // Asegúrate de que el servidor pueda manejar JSON
            data: JSON.stringify({ prescription: prescriptionData }),
            success: function(response) {
                // Aquí manejas lo que sucede después de guardar los datos
                console.log(response);
                alert('Receta guardada con éxito.');
            },
            error: function(xhr, status, error) {
                // Aquí manejas los errores
                console.error(error);
                alert('Hubo un error al guardar la receta.');
            }
        });
    });
    
});
