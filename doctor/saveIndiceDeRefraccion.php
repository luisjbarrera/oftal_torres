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
        $sql='INSERT INTO indicerefraccion (
        appoid, pid, docid, ODRefraccionLejos, OIRefraccionLejos, ODEsferaLejos, OIEsferaLejos, ODCilindroLejos, OICilindroLejos, ODEjeLejos, OIEjeLejos, DIPLejos, PrismaLejos, ODRefraccionCerca, OIRefraccionCerca, ODEsferaCerca, OIEsferaCerca, ODCilindroCerca, OICilindroCerca, ODEjeCerca, OIEjeCerca, DIPCerca, PrismaCerca, checkAstismatigmo, checkHipermetropia, checkMiopia, checkPresbicia, checkCristalBlanco, checkCristalPhotogray, checkCristalPhotobrown, checkResinaBlanco, checkResinaProteccionUV, checkResinaTransition, checkResinaFotomatic, checkResinaUltralite, checkPolicarbonato, checkAntireflex, checkFiltroAzul, checkPCETermico, checkPCEDuraquarz, checkResinaEndurecido, txtProcesosObservacion, checkAdicMasReducDiametro, checkAdicMenAltoIndice, checkBifocalFlaptop, checkBifocalInvisible, checkMultifocalVisionLCI, datereg
        ) VALUES (
            :appoid, :pid, :docid, 
            :ODRefraccionLejos,
            :OIRefraccionLejos,
            :ODEsferaLejos, 
            :OIEsferaLejos, 
            :ODCilindroLejos, 
            :OICilindroLejos, 
            :ODEjeLejos, 
            :OIEjeLejos, 
            :DIPLejos, 
            :PrismaLejos, 
            :ODRefraccionCerca, 
            :OIRefraccionCerca, 
            :ODEsferaCerca, 
            :OIEsferaCerca, 
            :ODCilindroCerca, 
            :OICilindroCerca, 
            :ODEjeCerca, 
            :OIEjeCerca, 
            :DIPCerca, 
            :PrismaCerca, 
            :checkAstismatigmo, 
            :checkHipermetropia, 
            :checkMiopia, 
            :checkPresbicia, 
            :checkCristalBlanco, 
            :checkCristalPhotogray, 
            :checkCristalPhotobrown, 
            :checkResinaBlanco, 
            :checkResinaProteccionUV, 
            :checkResinaTransition, 
            :checkResinaFotomatic, 
            :checkResinaUltralite, 
            :checkPolicarbonato, 
            :checkAntireflex, 
            :checkFiltroAzul, 
            :checkPCETermico, 
            :checkPCEDuraquarz, 
            :checkResinaEndurecido, 
            :txtProcesosObservacion, 
            :checkAdicMasReducDiametro, 
            :checkAdicMenAltoIndice, 
            :checkBifocalFlaptop, 
            :checkBifocalInvisible, 
            :checkMultifocalVisionLCI, 
            NOW()
        );
        ';

    //var_dump($data['DM']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':appoid'=>$data['appoid'],
        ':pid'=>$data['pid'],
        ':docid'=>$data['docid'],
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
        ':checkMultifocalVisionLCI'=>$data['checkMultifocalVisionLCI']
    ]);
    
    // Confirmar la transacción
    $pdo->commit();

} catch (PDOException $e) {
    // Revertir la transacción si algo sale mal
    $pdo->rollBack();
    // Enviar una respuesta de error al cliente
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar los indices de refracción: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $pdo = null;
}
?>