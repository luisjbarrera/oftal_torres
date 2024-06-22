<?php
// Configuración de la base de datos
$host = 'localhost'; // o la IP del servidor de base de datos
$dbname = 'citas';
$user = 'root';
$pass = '';

// Cadena de conexión
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

try {
    // Conectar a la base de datos
    $pdo = new PDO($dsn, $user, $pass);

    // Asegurar que se reporten todos los errores de SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //// Decodificar el JSON enviado por el cliente
    //$data = json_decode(file_get_contents('php://input'), true);
    // Usar $_POST si los datos son enviados como datos de formulario
    $data = $_POST['prescription'];

    // Comenzar una transacción
    $pdo->beginTransaction();

    // Preparar la consulta SQL
    $sql = "INSERT INTO recipe (id_medicinali, medicamento, cantidad, descripcion, fecha, pid, docid, appoid) 
                VALUES (:medicina_id, :medicamento, :cantidad, :descripcion, NOW(), :pid, :docid, :appoid)";
    $stmt = $pdo->prepare($sql);

    // Insertar cada ítem de la receta en la base de datos
    foreach ($data as $item) {
        $stmt->execute([
            ':medicina_id' => $item['id'], //
            ':medicamento' => $item['medicine'], //
            ':cantidad' => $item['quantity'], //
            ':descripcion' => $item['description'], //
            ':pid' => $item['pid'], // Id del paciente
            ':docid' => $item['docid'], // Id del Doctor
            ':appoid' => $item['appoid'] // Nro atencion
        ]);
    }

    // Confirmar la transacción
    $pdo->commit();

    // Enviar una respuesta de éxito al cliente
    echo json_encode(['status' => 'success', 'message' => 'Receta guardada correctamente te te te.']);

} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar la receta: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>

