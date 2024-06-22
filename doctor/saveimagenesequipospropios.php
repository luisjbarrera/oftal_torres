<?php
// Configuración de la base de datos
$host = 'localhost'; // o la IP del servidor de base de datos
$dbname = 'citas';
$user = 'root';
$pass = '';
// Cadena de conexión
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
$data = $_POST['sMotivoConsulta'];
// Acceder a la propiedad checkImgVolkPictor
$checkImgVolkPictor = $data['checkImgVolkPictor'];

// Procesar los datos del array checkImgVolkPictor
foreach ($checkImgVolkPictor as $imagen) {
  // Guardar el nombre del archivo y la extensión en la base de datos
  $values = explode('|', $imagen);
  $originalNameImage = $values[0]; // "Nombre y ruta Original de la Imagen"
  $newNameImages = $values[1]; // "Nuevo nombre y ruta de la imagen"
  $newTipoExamen = $values[2]; // "Tipo de imagen"
  if (copy($originalNameImage, $newNameImages)){ //Subimos la imagen al servidor
  // Verificar si la copia fue exitosa
  //if (file_exists($newNameImages)) {
                try {
                  // Conectar a la base de datos
                  $pdo = new PDO($dsn, $user, $pass);
                  // Asegurar que se reporten todos los errores de SQL
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                  // Comenzar una transacción
                  $pdo->beginTransaction();
              
                      // Preparar la consulta SQL
                      $sql='INSERT INTO examenphotos (
                          appoid, pid, docid, examid, urlfile, nuevaimagen, estadoexamphotos, datereg
                      ) VALUES (
                          :appoid, :pid, :docid, :newTipoExamen, :newNameImages, :nuevaimagen, 1, NOW()
                      );
                      ';
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute([
                      ':appoid'=>$data['appoid'],
                      ':pid'=>$data['pid'],
                      ':docid'=>$data['docid'],
                      ':newNameImages'=>$newNameImages,
                      ':nuevaimagen' => $originalNameImage,
                      ':newTipoExamen'=>$newTipoExamen
                  ]);
                  // Confirmar la transacción
                  $pdo->commit();
                  echo json_encode(['status' => 'success', 'message' => 'Imagenes registradas correctamente.']);
              } catch (PDOException $e) {
                  // Revertir la transacción si algo sale mal
                  $pdo->rollBack();
                  // Enviar una respuesta de error al cliente
                  echo json_encode(['status' => 'error', 'message' => 'Error al guardar las imagenes: ' . $e->getMessage()]);
              } finally {
                  // Cerrar la conexión a la base de datos
                  $pdo = null;
              }
    // Eliminar la imagen original
    unlink($originalNameImage);
 } //Fin del if
}
?>