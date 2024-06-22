$(document).ready(function() {
    $('#btnSearch').click(function() {
        var searchQuery = $('#searchMedicine').val();
        $.ajax({
            url: 'searchMedicine.php',
            type: 'GET',
            data: { query: searchQuery },
            success: function(response) {
                // Aquí puedes actualizar tu interfaz con los resultados de la búsqueda
                console.log(response);
            }
        });
    });

    $('#btnAddToList').click(function(e) {
        e.preventDefault();
        var medicineName = $('#searchMedicine').val();
        var quantity = $('#quantity').val();
        var description = $('#description').val();

        // Añadir a la lista
        $('#medicinesList tbody').append('<tr><td>' + medicineName + '</td><td>' + quantity + '</td><td>' + description + '</td><td><button class="delete">X</button></td></tr>');
        
        // Limpiar los campos
        $('#searchMedicine').val('');
        $('#quantity').val('');
        $('#description').val('');
        updateSaveButtonStatus();
    });

    // Suponiendo que esta función se llama cuando recibes la respuesta del servidor
    function loadMedicinesIntoTable(medicines) {
        var tableBody = $('#medicinesList tbody');
        tableBody.empty(); // Limpia la tabla antes de cargar nuevos elementos

        medicines.forEach(function(medicine) {
            var row = $('<tr></tr>');
            row.append($('<td></td>').text(medicine.name));
            row.append($('<td></td>').text(medicine.quantity));
            row.append($('<td></td>').text(medicine.description));
            row.append($('<td></td>').html('<button class="delete">X</button>'));
            tableBody.append(row);
        });
    }

    // Evento para botones de editar y eliminar, como se muestra anteriormente
    //$('#medicinesList').on('click', '.edit', function() {
    //    // Implementar la lógica de edición aquí
    //    updateSaveButtonStatus();
    //});
    $('#medicinesList').on('click', '.delete', function() {
        $(this).closest('tr').remove();
        updateSaveButtonStatus();
    });

    // Agrega el controlador de eventos al botón Guardar Receta
    $('#btnSavePrescription').on('click', savePrescription);

    function updateSaveButtonStatus() {
        var itemCount = $('#medicinesList tbody tr').length; // Cuenta la cantidad de filas en la lista
        if (itemCount > 0) {
            $('#btnSavePrescription').prop('disabled', false); // Habilita el botón si hay uno o más medicamentos
        } else {
            $('#btnSavePrescription').prop('disabled', true); // Deshabilita el botón si no hay medicamentos
        }
    }
    
    function savePrescription() {
        var prescriptionData = [];
    
        // Recoger todos los datos de la lista de medicamentos
        $('#medicinesList tbody tr').each(function() {
            var medicine = $(this).find('td').eq(0).text(); // Obtén el nombre del medicamento
            var quantity = $(this).find('td').eq(1).text(); // Obtén la cantidad
            var description = $(this).find('td').eq(2).text(); // Obtén la descripción
            
            // Agrega los datos a un array
            prescriptionData.push({
                medicine: medicine,
                quantity: quantity,
                description: description
            });
        });
    
        // Aquí deberías enviar `prescriptionData` a tu servidor usando AJAX o algún otro método
        // Por ejemplo:
        $('#btnSavePrescription').click(function() {
            console.log(prescriptionData); // Asegúrate de que esto muestra los datos correctos en la estructura correcta.
            $.ajax({
                url: 'savePrescription.php',
                type: 'POST',
                data: { prescription: prescriptionData },
                success: function(response) {
                    console.log(response);
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        alert(jsonResponse.message);
                    } else {
                        alert(jsonResponse.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error en la petición AJAX: ', textStatus, errorThrown);
                    alert('Hubo un error al guardar la receta');
                }
            });
        });

        console.log(prescriptionData); // Solo para fines de depuración
    }
});