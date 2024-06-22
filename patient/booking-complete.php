<?php
// Configuración de la base de datos
$host = 'localhost'; // o la IP del servidor de base de datos
$dbname = 'citas';
$user = 'root';
$pass = '';
// Cadena de conexión
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

echo $_POST['pacienteid'];

    try {
        // Conectar a la base de datos
        $pdo = new PDO($dsn, $user, $pass);
        // Asegurar que se reporten todos los errores de SQL
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pacienteid = $_POST['pacienteid'];
        $programacionmedid = $_POST['programacionmedid'];
        $edad = $_POST['edad'];
        $tipoatencion = $_POST['tipoatencion'];
        $fechaprogramada = $_POST['fechaprogramada'];
        $horaprogramada = $_POST['horaprogramada'];

        

        // Comenzar una transacción
        $pdo->beginTransaction();
            // Preparar la consulta SQL
            $sql="INSERT INTO appointment (pid, apponum, scheduleid, edad, typeattention, estadoattenc, appodate, appohour)
            VALUES (:pacienteid, :apponum, :programacionmedid, :edad, :tipoatencion, :estadoattenc, ':fechaprogramada', ':horaprogramada');";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':pacienteid'=>$pacienteid,
            ':apponum'=>'(SELECT COALESCE(MAX(apponum), 0) + 1 FROM appointment WHERE appodate = CURDATE())',
            ':programacionmedid'=>$programacionmedid,
            ':edad'=>$edad,
            ':tipoatencion'=>$tipoatencion,
            ':estadoattenc'=>1,
            ':fechaprogramada'=>$fechaprogramada,
            ':horaprogramada'=>$horaprogramada
        ]);

        // Confirmar la transacción
        $pdo->commit();
        
    } catch (PDOException $e) {
        // Revertir la transacción si algo sale mal
        $pdo->rollBack();
        // Enviar una respuesta de error al cliente
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar los antecedentes: ' . $e->getMessage()]);
    } finally {
        // Cerrar la conexión a la base de datos
        $pdo = null;
    }
 ?>