<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocompletar con AJAX</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #suggestions {
            border: 1px solid #ccc;
            display: none;
            position: absolute;
            max-height: 150px;
            overflow-y: auto;
            background-color: #fff;
            z-index: 1000;
        }
        #suggestions div {
            padding: 10px;
            cursor: pointer;
        }
        #suggestions div.active {
            background-color: #eee;
        }
        .custom-medicine-container input[type="number"], .custom-medicine-container input[type="text"], .custom-medicine-container button {
            margin-left: 10px;
        }
        .custom-medicine-container input[type="text"] {
            width: 100%;
        }
        .custom-fieldset {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
        .custom-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .custom-table th {
            background-color: #f4f4f4;
        }
        .custom-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .custom-table tr:hover {
            background-color: #f1f1f1;
        }
        .custom-table-container td {
            padding: 5px;
        }
        .same-width {
            width: 100px; /* Ajusta este valor según sea necesario */
        }
        .row {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .btn-group-right {
            display: flex;
            justify-content: flex-end;
            margin: 20px;
        }
        .btn-group-right .btn {
            margin: 0;
        }
        .btnDelete {
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 5px 10px;
            cursor: pointer;
        }
        .btnDelete:hover {
            background-color: #ff1a1a;
        }
    </style>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="row">
        <fieldset class="custom-fieldset">
            <legend>Receta médica</legend>
            <table class="custom-table-container">
                <tr>
                    <td class="custom-medicine-container">
                        <input type="text" id="search" autocomplete="off" placeholder="Buscar medicamento...">
                        <div id="suggestions"></div>
                    </td>
                    <td class="custom-medicine-container">
                        <input type="number" id="medicine-quantity" min="1" max="20" placeholder="0" value="1" class="same-width">
                    </td>
                </tr>
                <tr>
                    <td class="custom-medicine-container">
                        <input type="text" id="medicine-indicaciones" placeholder="Indicaciones">
                    </td>
                    <td class="custom-medicine-container">
                        <button id="btnAddMedicamento" class="same-width">Agregar</button>
                    </td>
                </tr>
            </table>
        </fieldset>

        <div class="btn-group-right">
            <button class="btn btn-success pull-right" type="button" id="btnSavePrescription" disabled><i class="fa fa-save"></i> Guardar receta</button>
        </div>

        <table id="medicines-table" class="custom-table">
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>Cantidad</th>
                    <th>Indicaciones</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas de medicamentos agregadas aquí -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentFocus = -1;
            let selectedMedicineId = null;

            $("#search").on("input", function() {
                let query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: "searchMedicine.php",
                        method: "GET",
                        data: { query: query },
                        success: function(data) {
                            let medicines = JSON.parse(data);
                            let suggestions = '';
                            medicines.forEach(function(medicine, index) {
                                suggestions += `<div data-id="${medicine.id}" data-index="${index}">${medicine.nombremed}: ${medicine.principioactivo}, ${medicine.concentracion} ${medicine.formafarmaceutica}</div>`;
                            });
                            $("#suggestions").html(suggestions).show();
                            currentFocus = -1;
                        }
                    });
                } else {
                    $("#suggestions").hide();
                }
            });

            $(document).on("click", "#suggestions div", function() {
                let selectedText = $(this).text();
                selectedMedicineId = $(this).data("id");
                $("#search").val(selectedText);
                $("#suggestions").hide();
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('#suggestions, #search').length) {
                    $("#suggestions").hide();
                }
            });

            $("#search").on("keydown", function(e) {
                let items = $("#suggestions div");
                if (items.length > 0) {
                    if (e.keyCode == 40) { // flecha hacia abajo
                        currentFocus++;
                        addActive(items);
                    } else if (e.keyCode == 38) { // flecha hacia arriba
                        currentFocus--;
                        addActive(items);
                    } else if (e.keyCode == 13) { // Enter
                        e.preventDefault();
                        if (currentFocus > -1) {
                            items[currentFocus].click();
                        }
                    }
                }
            });

            function addActive(items) {
                if (!items) return false;
                removeActive(items);
                if (currentFocus >= items.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (items.length - 1);
                $(items[currentFocus]).addClass("active");
                $("#search").val($(items[currentFocus]).text());
                selectedMedicineId = $(items[currentFocus]).data("id");
            }

            function removeActive(items) {
                items.removeClass("active");
            }

            $("#medicine-quantity").on("input", function() {
                if (this.value.length > 2) this.value = this.value.slice(0, 2);
            });

            function updateSaveButtonState() {
                const hasRows = $("#medicines-table tbody tr").length > 0;
                $("#btnSavePrescription").prop('disabled', !hasRows);
            }

            $("#btnAddMedicamento").click(function() {
                let medicamento = $("#search").val();
                let cantidad = $("#medicine-quantity").val();
                let indicaciones = $("#medicine-indicaciones").val();

                if (medicamento && cantidad && indicaciones && selectedMedicineId) {
                    let rowId = `row-${selectedMedicineId}`;
                    let row = `<tr id="${rowId}">
                        <td>${medicamento}</td>
                        <td>${cantidad}</td>
                        <td>${indicaciones}</td>
                        <td><button class="btnDelete" data-id="${selectedMedicineId}">&times;</button></td>
                    </tr>`;
                    $("#medicines-table tbody").append(row);
                    $("#search").val('');
                    $("#medicine-quantity").val(1);
                    $("#medicine-indicaciones").val('');
                    $("#search").focus(); // Poner el foco en el campo de búsqueda
                    selectedMedicineId = null;
                    updateSaveButtonState(); // Update save button state
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campos incompletos',
                        text: 'Por favor, completa todos los campos antes de agregar.'
                    });
                }
            });

            $(document).on("click", ".btnDelete", function() {
                let rowId = $(this).data("id");
                $(`#row-${rowId}`).remove();
                updateSaveButtonState(); // Update save button state
            });

            $("#btnSavePrescription").click(function() {
                Swal.fire({
                    title: '¿Guardar receta?',
                    text: "¿Estás seguro de que deseas guardar esta receta?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var medicines = [];
                        $("#medicines-table tbody tr").each(function() {
                            var row = $(this);
                            var medicine = {
                                id: row.find(".btnDelete").data("id"), // Capturar el ID desde el botón eliminar
                                medicine: row.find("td").eq(0).text(),
                                quantity: row.find("td").eq(1).text(),
                                description: row.find("td").eq(2).text()
                            };
                            medicines.push(medicine);
                        });
                        
                        $("#medicines-table tbody").empty(); // Limpia la tabla antes de enviar los datos
                        updateSaveButtonState(); // Update save button state
                        $.ajax({
                            url: 'savePrescription.php',
                            type: 'POST',
                            data: { prescription: medicines },
                            success: function(response) {
                                console.log(response);
                                Swal.fire( // Mensaje de confirmación con SweetAlert2
                                    '¡Guardado!',
                                    'La receta se ha guardado con éxito.',
                                    'success'
                                );
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
