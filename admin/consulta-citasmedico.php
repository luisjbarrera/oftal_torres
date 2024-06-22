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
        $scheduleid = $_POST['scheduleid'];
        $pid = $_POST['pid'];
        $dDateProgMedico = $_POST['FechaProgMedico'];
        $dDateProgMedico = DateTime::createFromFormat('Y-m-d', $dDateProgMedico);
        $formattedDate = $dDateProgMedico->format('Y-m-d');

        $tipoConsulta = $_POST['tipoConsulta'];

        // Comenzar una transacción
            // Preparar la consulta SQL para listar todos los pacientes del Dr. Seleccionado
        if($tipoConsulta=='ListaMedicos')
        {
            $sql="SELECT
                    d.docid,
                    d.docname,
                    sh.scheduleid,
                    sh.title,
                    sh.scheduledate,
                    ap.apponum,
                    ap.appohour
                FROM
                    doctor d
                    INNER JOIN (schedule sh INNER JOIN appointment ap ON sh.scheduleid = ap.scheduleid) ON d.docid = sh.docid
                WHERE
                    sh.scheduledate = CURDATE() AND sh.scheduleid = ? 
                ORDER BY 
                    ap.apponum ASC;";
                    $stmt = $conn->prepare($sql);
                    $searchParam = $scheduleid;
                    $stmt->bind_param("s", $scheduleid);
        }elseif($tipoConsulta=='HoraMax'){
            $sql="SELECT
                        ADDTIME(MAX(ap.appohour), '00:20:00') AS plusminutes 
                    FROM
                        appointment ap
                        INNER JOIN schedule sh ON ap.scheduleid = sh.scheduleid
                    WHERE
                        sh.scheduledate = ? AND ap.scheduleid = ?;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $formattedDate, $scheduleid);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $citas = array();
        while($row = $result->fetch_assoc()) {
            $citas[] = $row;
        }


        // Si hay resultados, los enviamos como respuesta
        if ($result) {
            // Retornar resultados como JSON
            echo json_encode($citas);
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