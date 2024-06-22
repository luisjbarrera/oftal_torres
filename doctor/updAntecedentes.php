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
    $data = $_POST['recibe'];

    // Comenzar una transacción
    $pdo->beginTransaction();

    // Preparar la consulta SQL
    $sql = 'UPDATE antecedentes SET 
        DM = :DM, 
        HTA = :HTA, alergias = :alergias, sinOjoSeco = :sinOjoSeco, glaucoma = :glaucoma, altRetinales = :altRetinales, 
        traumaOcular = :traumaOcular, qxOcularPrevia = :qxOcularPrevia, 
        usaLC = :usaLC, colgenopatias = :colgenopatias, medTopicos = :medTopicos, 
        descripcion = :descripcion, updated_at = NOW() WHERE appoid = :appoid AND pid = :pid AND docid = :docid;';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':appoid' => $data['appoid'],
        ':pid' => $data['pid'],
        ':docid' => $data['docid'],
        ':DM' => $data['DM'],
        ':HTA' => $data['HTA'],
        ':alergias' => $data['alergias'],
        ':sinOjoSeco' => $data['sinOjoSeco'],
        ':glaucoma' => $data['glaucoma'],
        ':altRetinales' => $data['altRetinales'],
        ':traumaOcular' => $data['traumaOcular'],
        ':qxOcularPrevia' => $data['qxOcularPrevia'],
        ':usaLC' => $data['usaLC'],
        ':colgenopatias' => $data['colgenopatias'],
        ':medTopicos' => $data['medTopicos'],
        ':descripcion' => $data['descripcion']
    ]);

    // Confirmar la transacción
    $pdo->commit();

    // Enviar una respuesta de éxito al cliente
    echo json_encode(['status' => 'success', 'message' => 'Antecedentes actualizados correctamente.']);

} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar los antecedentes: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>