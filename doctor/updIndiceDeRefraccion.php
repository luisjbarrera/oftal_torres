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
        $sql='UPDATE indicerefraccion SET 
        ODRefraccionLejos = :ODRefraccionLejos,
        OIRefraccionLejos = :OIRefraccionLejos,
        ODEsferaLejos = :ODEsferaLejos, 
        OIEsferaLejos = :OIEsferaLejos, 
        ODCilindroLejos = :ODCilindroLejos, 
        OICilindroLejos = :OICilindroLejos, 
        ODEjeLejos = :ODEjeLejos, 
        OIEjeLejos = :OIEjeLejos, 
        DIPLejos = :DIPLejos, 
        PrismaLejos = :PrismaLejos, 
        ODRefraccionCerca = :ODRefraccionCerca, 
        OIRefraccionCerca = :OIRefraccionCerca, 
        ODEsferaCerca = :ODEsferaCerca, 
        OIEsferaCerca = :OIEsferaCerca, 
        ODCilindroCerca = :ODCilindroCerca, 
        OICilindroCerca = :OICilindroCerca, 
        ODEjeCerca = :ODEjeCerca, 
        OIEjeCerca = :OIEjeCerca, 
        DIPCerca = :DIPCerca, 
        PrismaCerca = :PrismaCerca, 
        checkAstismatigmo = :checkAstismatigmo, 
        checkHipermetropia = :checkHipermetropia, 
        checkMiopia = :checkMiopia, 
        checkPresbicia = :checkPresbicia, 
        checkCristalBlanco = :checkCristalBlanco, 
        checkCristalPhotogray = :checkCristalPhotogray, 
        checkCristalPhotobrown = :checkCristalPhotobrown, 
        checkResinaBlanco = :checkResinaBlanco, 
        checkResinaProteccionUV = :checkResinaProteccionUV, 
        checkResinaTransition = :checkResinaTransition, 
        checkResinaFotomatic = :checkResinaFotomatic, 
        checkResinaUltralite = :checkResinaUltralite, 
        checkPolicarbonato = :checkPolicarbonato, 
        checkAntireflex = :checkAntireflex, 
        checkFiltroAzul = :checkFiltroAzul, 
        checkPCETermico = :checkPCETermico, 
        checkPCEDuraquarz = :checkPCEDuraquarz, 
        checkResinaEndurecido = :checkResinaEndurecido, 
        txtProcesosObservacion = :txtProcesosObservacion, 
        checkAdicMasReducDiametro = :checkAdicMasReducDiametro, 
        checkAdicMenAltoIndice = :checkAdicMenAltoIndice, 
        checkBifocalFlaptop = :checkBifocalFlaptop, 
        checkBifocalInvisible = :checkBifocalInvisible, 
        checkMultifocalVisionLCI = :checkMultifocalVisionLCI, 
        updated_at = NOW()
        WHERE appoid = :appoid AND pid = :pid AND docid = :docid';


    //var_dump($data['DM']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ODRefraccionLejos'=>$data['ODRefraccionLejos'],
        ':OIRefraccionLejos'=>$data['OIRefraccionLejos'],
        ':ODEsferaLejos'=>$data['ODEsferaLejos'],
        ':OIEsferaLejos'=>$data['OIEsferaLejos'],
        ':ODCilindroLejos'=>$data['ODCilindroLejos'],
        ':OICilindroLejos'=>$data['OICilindroLejos'],
        ':ODEjeLejos'=>$data['ODEjeLejos'],
        ':OIEjeLejos'=>$data['OIEjeLejos'],
        ':DIPLejos'=>$data['DIPLejos'],
        ':PrismaLejos'=>$data['PrismaLejos'],
        ':ODRefraccionCerca'=>$data['ODRefraccionCerca'],
        ':OIRefraccionCerca'=>$data['OIRefraccionCerca'],
        ':ODEsferaCerca'=>$data['ODEsferaCerca'],
        ':OIEsferaCerca'=>$data['OIEsferaCerca'],
        ':ODCilindroCerca'=>$data['ODCilindroCerca'],
        ':OICilindroCerca'=>$data['OICilindroCerca'],
        ':ODEjeCerca'=>$data['ODEjeCerca'],
        ':OIEjeCerca'=>$data['OIEjeCerca'],
        ':DIPCerca'=>$data['DIPCerca'],
        ':PrismaCerca'=>$data['PrismaCerca'],
        ':checkAstismatigmo'=>$data['checkAstismatigmo'],
        ':checkHipermetropia'=>$data['checkHipermetropia'],
        ':checkMiopia'=>$data['checkMiopia'],
        ':checkPresbicia'=>$data['checkPresbicia'],
        ':checkCristalBlanco'=>$data['checkCristalBlanco'],
        ':checkCristalPhotogray'=>$data['checkCristalPhotogray'],
        ':checkCristalPhotobrown'=>$data['checkCristalPhotobrown'],
        ':checkResinaBlanco'=>$data['checkResinaBlanco'],
        ':checkResinaProteccionUV'=>$data['checkResinaProteccionUV'],
        ':checkResinaTransition'=>$data['checkResinaTransition'],
        ':checkResinaFotomatic'=>$data['checkResinaFotomatic'],
        ':checkResinaUltralite'=>$data['checkResinaUltralite'],
        ':checkPolicarbonato'=>$data['checkPolicarbonato'],
        ':checkAntireflex'=>$data['checkAntireflex'],
        ':checkFiltroAzul'=>$data['checkFiltroAzul'],
        ':checkPCETermico'=>$data['checkPCETermico'],
        ':checkPCEDuraquarz'=>$data['checkPCEDuraquarz'],
        ':checkResinaEndurecido'=>$data['checkResinaEndurecido'],
        ':txtProcesosObservacion'=>$data['txtProcesosObservacion'],
        ':checkAdicMasReducDiametro'=>$data['checkAdicMasReducDiametro'],
        ':checkAdicMenAltoIndice'=>$data['checkAdicMenAltoIndice'],
        ':checkBifocalFlaptop'=>$data['checkBifocalFlaptop'],
        ':checkBifocalInvisible'=>$data['checkBifocalInvisible'],
        ':checkMultifocalVisionLCI'=>$data['checkMultifocalVisionLCI'],
        ':appoid'=>$data['appoid'],
        ':pid'=>$data['pid'],
        ':docid'=>$data['docid']
    ]);

    // Confirmar la transacción
    $pdo->commit();

} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al intentar editar los indices de refracción: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>