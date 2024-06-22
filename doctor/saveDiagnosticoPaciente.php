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
        $sql='INSERT INTO diagnostico (
                    appoid, pid, docid, descripciondiag, datereg
                    ) VALUES (
                        :appoid, 
                        :pid, 
                        :docid, 
                        :DiagnosticoPaciente, 
                        NOW()
                    );
                ';

    //var_dump($data['DM']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':appoid'=>$data['appoid'],
        ':pid'=>$data['pid'],
        ':docid'=>$data['docid'],
        ':DiagnosticoPaciente'=>$data['DiagnosticoPaciente']
    ]);
    $pdo->commit();
    echo json_encode(['status' => 'success', 'message' => 'Diagnostico registrado correctamente.']);
} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar el diagnostico: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>