<?php
// Configuración de la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "citas";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    try {
        $id_prod = $_POST['id_prod'];

        // Comenzar una transacción
            // Preparar la consulta SQL para listar todos los pacientes del Dr. Seleccionado
            $sql="SELECT id_prod, nombre_prod, abreviatura_prod, dcto_prod, precio_prod FROM producto WHERE id_prod = ? and estado_prod = 1;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_prod);
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = array();
        while($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }


        // Si hay resultados, los enviamos como respuesta
        if ($result) {
            // Retornar resultados como JSON
            echo json_encode($productos);
        } else {
            // Enviar un mensaje de error si no se encontraron resultados
            echo json_encode(['status' => 'error', 'message' => 'No se encontraron resultados para la seleccion.']);
        }
        
        
    } catch (PDOException $e) {
        // Enviar una respuesta de error al cliente
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar la cita: ' . $e->getMessage()]);
    } finally {
        // Cerrar la conexión a la base de datos
        $stmt->close();
        $conn->close();
    }
 ?>