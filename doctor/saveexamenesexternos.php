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
        $data = $_POST['sDataExamExt'];

        // Comenzar una transacción
        $pdo->beginTransaction();

            // Preparar la consulta SQL
            $sql='INSERT INTO ordenexamexterno(oreex_descripcion, examid, created_at, oeex_estado, appoid, pid, docid)
                    VALUES (:ordenExamExt, :nTpExamenExt, NOW(), 1, :appoid, :pid, :docid);';

        //var_dump($data['DM']);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ordenExamExt'=>$data['ordenExamExt'],
            ':nTpExamenExt'=>$data['nTpExamenExt'],
            ':appoid'=>$data['appoid'],
            ':pid'=>$data['pid'],
            ':docid'=>$data['docid']
        ]);
        $pdo->commit();
        echo json_encode(['status' => 'success', 'message' => 'La orden para examen externo fue registrado correctamente.']);
    } catch (PDOException $e) {
        // Revertir la transacción si algo sale mal
        $pdo->rollBack();
        // Enviar una respuesta de error al cliente
        echo json_encode(['status' => 'error', 'message' => 'Error al intentar guardar el examen externo: ' . $e->getMessage()]);
    } finally {
        // Cerrar la conexión a la base de datos
        $pdo = null;
    }
?>