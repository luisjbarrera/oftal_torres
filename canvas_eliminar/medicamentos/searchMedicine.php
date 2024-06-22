<?php
// Conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "citas";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el término de búsqueda del AJAX
$searchQuery = $_GET['query'];

// Consulta de búsqueda
$sql = "SELECT id, CONCAT(principioactivo, ' ', concentracion, ' ', formafarmaceutica) as nombremed, principioactivo, concentracion, formafarmaceutica FROM medicinali WHERE principioactivo LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = "%".$searchQuery."%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();

$medicines = array();
while($row = $result->fetch_assoc()) {
    $medicines[] = $row;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Retornar resultados como JSON
echo json_encode($medicines);
?>
