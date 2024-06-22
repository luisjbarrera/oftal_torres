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
    $sql = "SELECT eph.examphotoid, eph.urlfile, eph.examid, 
                (SELECT te.examnombre FROM tipoexamen te WHERE te.examid = eph.examid) nuevaimagen 
                FROM examenphotos eph 
                    WHERE eph.pid = :pid AND eph.docid = :docid AND eph.appoid = :appoid AND eph.examid = :examid AND eph.estadoexamphotos = :estadoexamphotos;";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    $stmt->execute([
        ':pid' => $_POST['sMotivoConsulta']['pid'], // Id del paciente
        ':docid' => $_POST['sMotivoConsulta']['docid'], // Id del Doctor
        ':appoid' => $_POST['sMotivoConsulta']['appoid'], // Nro atencion
        ':examid' => $_POST['sMotivoConsulta']['exam_id'], // Es el grupo de examenes al que pertenece 5 VolkPictor, 10 TopCon y 11 AutoKerato
        ':estadoexamphotos' => $_POST['sMotivoConsulta']['estado']
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