<?php
$host = 'localhost';
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

    // Comenzar una transacción
    $pdo->beginTransaction();

    // Preparar la consulta SQL
    $sql = "SELECT examid, COUNT(*) as total
            FROM examenphotos 
            WHERE pid = :pid 
            AND docid = :docid 
            AND appoid = :appoid
            GROUP BY examid;";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    $stmt->execute([
        ':pid' => $_POST['idPaciente'], // Id del paciente
        ':docid' => $_POST['idMedico'], // Id del Doctor
        ':appoid' => $_POST['numAtencion'] // Nro atencion
    ]);

    // Obtener los registros encontrados
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Confirmar la transacción
    $pdo->commit();

    // Enviar una respuesta de éxito al cliente con los registros encontrados
    echo json_encode(['status' => 'success', 'data' => $rows]);

} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al verificar los registros: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>