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
    $sql = 'INSERT INTO examoftalmologico (
        appoid, pid, docid, 
        OiSinCorrector,
        OdSinCorrector,
        OiConCorrector,
        OdConCorrector,
        OiAgujeroSteropertico,
        OdAgujeroSteropertico,
        OiParpados,
        OdParpados,
        OiViaLagrimal,
        OdViaLagrimal,
        OiConjuntiva,
        OdConjuntiva,
        OiCornea,
        OdCornea,
        OiCamaraAnterior,
        OdCamaraAnterior,
        OiCristalino,
        OdCristalino,
        OiAplanatico,
        OdAplanatico,
        OiPIntraocular,
        OdPIntraocular,
        OiRelacionCopa,
        OdRelacionCopa,
        OiVasos,
        OdVasos,
        OiBordesNervio,
        OdBordesNervio,
        OiAnilloNeuroretinal,
        OdAnilloNeuroretinal,
        OiRetina,
        OdRetina,
        OiVasosRetinales,
        OdVasosRetinales,
        OiMacula,
        odMacula,
        OiRetinaPeriferica,
        odRetinaPeriferica, 
        datereg
    ) VALUES (
        :appoid, :pid, :docid,
        :oiSinCorrector,
        :odSinCorrector,
        :oiConCorrector,
        :odConCorrector,
        :oiAgujeroSteropertico,
        :odAgujeroSteropertico,
        :oiParpados,
        :odParpados,
        :oiViaLagrimal,
        :odViaLagrimal,
        :oiConjuntiva,
        :odConjuntiva,
        :oiCornea,
        :odCornea,
        :oiCamaraAnterior,
        :odCamaraAnterior,
        :oiCristalino,
        :odCristalino,
        :oiAplanatico,
        :odAplanatico,
        :oiPIntraocular,
        :odPIntraocular,
        :oiRelacionCopa,
        :odRelacionCopa,
        :oiVasos,
        :odVasos,
        :oiBordesNervio,
        :odBordesNervio,
        :oiAnilloNeuroretinal,
        :odAnilloNeuroretinal,
        :oiRetina,
        :odRetina,
        :oiVasosRetinales,
        :odVasosRetinales,
        :oiMacula,
        :odMacula,
        :oiRetinaPeriferica,
        :odRetinaPeriferica,
        NOW()
    );';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':appoid' => $data['appoid'],
        ':pid' => $data['pid'],
        ':docid' => $data['docid'],
        ':oiSinCorrector' => $data['oiSinCorrector'],
        ':odSinCorrector' => $data['odSinCorrector'],
        ':oiConCorrector' => $data['oiConCorrector'],
        ':odConCorrector' => $data['odConCorrector'],
        ':oiAgujeroSteropertico' => $data['oiAgujeroSteropertico'],
        ':odAgujeroSteropertico' => $data['odAgujeroSteropertico'],
        ':oiParpados' => $data['oiParpados'],
        ':odParpados' => $data['odParpados'],
        ':oiViaLagrimal' => $data['oiViaLagrimal'],
        ':odViaLagrimal' => $data['odViaLagrimal'],
        ':oiConjuntiva' => $data['oiConjuntiva'],
        ':odConjuntiva' => $data['odConjuntiva'],
        ':oiCornea' => $data['oiCornea'],
        ':odCornea' => $data['odCornea'],
        ':oiCamaraAnterior' => $data['oiCamaraAnterior'],
        ':odCamaraAnterior' => $data['odCamaraAnterior'],
        ':oiCristalino' => $data['oiCristalino'],
        ':odCristalino' => $data['odCristalino'],
        ':oiAplanatico' => $data['oiAplanatico'],
        ':odAplanatico' => $data['odAplanatico'],
        ':oiPIntraocular' => $data['oiPIntraocular'],
        ':odPIntraocular' => $data['odPIntraocular'],
        ':oiRelacionCopa' => $data['oiRelacionCopa'],
        ':odRelacionCopa' => $data['odRelacionCopa'],
        ':oiVasos' => $data['oiVasos'],
        ':odVasos' => $data['odVasos'],
        ':oiBordesNervio' => $data['oiBordesNervio'],
        ':odBordesNervio' => $data['odBordesNervio'],
        ':oiAnilloNeuroretinal' => $data['oiAnilloNeuroretinal'],
        ':odAnilloNeuroretinal' => $data['odAnilloNeuroretinal'],
        ':oiRetina' => $data['oiRetina'],
        ':odRetina' => $data['odRetina'],
        ':oiVasosRetinales' => $data['oiVasosRetinales'],
        ':odVasosRetinales' => $data['odVasosRetinales'],
        ':oiMacula' => $data['oiMacula'],
        ':odMacula' => $data['odMacula'],
        ':oiRetinaPeriferica' => $data['oiRetinaPeriferica'],
        ':odRetinaPeriferica' => $data['odRetinaPeriferica']
    ]);

    // Confirmar la transacción
    $pdo->commit();

    // Enviar una respuesta de éxito al cliente
    echo json_encode(['status' => 'success', 'message' => 'Se registraron los datos del examen oftalmológico con éxito.']);
} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos del examen oftalmológico: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>
