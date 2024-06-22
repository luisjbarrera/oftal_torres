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
        //$id_prod = $_POST['id_prod'];

        // Comenzar una transacción
            // Preparar la consulta SQL para listar todos los pacientes del Dr. Seleccionado
            $sql="SELECT * FROM doctor ORDER BY docname ASC;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $medicos = array();
            while($row = $result->fetch_assoc()) {
                $medicos[] = $row;
            }

            // Si hay resultados, los enviamos como respuesta
            if ($result) {
                // Retornar resultados como JSON
                echo json_encode($medicos);
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