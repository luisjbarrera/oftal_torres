<?php
if(!isset($_SESSION['id'])){ header("Location: index.php"); exit; }else{$ssIDusersession=$_SESSION['id'];}
$sRpta1=""; $sRpta2=""; $sRpta3=""; $sRpta4=""; $sRpta5="";
$tipo_usuario = $_SESSION['tipo_usuario'];
require('namehostclient.php');
require_once('cls_closeadmprocess.php');

$ip=get_client_ip();
$sIDusersession=get_encrypttxinfo($ssIDusersession);
$transformsecuretextenc=get_encrypttxinfo($ip);

// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
date_default_timezone_set('America/Lima');
$from = 'uploads_files';
$to = 'backups_filesupload';

//Seleccionamos el proceso en curso
    // $sqlProcenCurso="SELECT pr.id AS NroProceso, mo.id AS IDMOD, mo.modalidad, ad.periodo, pr.nro_evaluaciones, pr.tp_cepunib 
    // FROM modalidad mo INNER JOIN (proceso pr INNER JOIN admision ad ON pr.id_admision=ad.id) ON mo.id=pr.id_modalidad
    // WHERE ad.estado=1 and mo.estado=1 and pr.estado=1 and pr.conditions=1";
    $objClose=new process_close($sIDusersession, $transformsecuretextenc);
    $sSqlResult=$objClose->bca_proceso_activo();
    // $sSqlResult = $mysqli->query($sqlProcenCurso, MYSQLI_STORE_RESULT);
    ?>
    <div class="x_panel">
        <div class="x_title">
            <h2>SELECCIONE UN PROCESO EN CURSO PARA PODER CERRARLO</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Seleccione un proceso en curso
            </button>
            <div class="dropdown-menu">
            <?php
                // while($row=$sSqlResult->fetch_assoc())
                foreach($sSqlResult as $row)
                    { ?>
                        <tr>
                        <th class="a-center" scope="row"></th>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="principal.php?sFiles=closeadmprocess&idproceso=<?php echo $row['NroProceso']; ?>"><?php
                            if($row['nro_evaluaciones']>=2){
                                if($row['tp_cepunib']==1){
                                    echo $row['modalidad']." ".$row['periodo'].' -> PARCIAL';
                                }elseif($row['tp_cepunib']>=2){
                                    echo $row['modalidad']." ".$row['periodo'].' -> FINAL';
                                }
                            }else{
                                echo $row['modalidad'].' '.$row['periodo'];
                            }
                            unset($sSqlResult);
                            ?></a>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>
<?php
//Fin Seleccionamos el proceso en curso

if(!empty($_GET['idproceso'])){
    $nIdProceso=$_GET['idproceso'];

    //Abro el directorio que voy a leer
    $dir = opendir($from);
    //Recorro el directorio para leer los archivos que tiene
    while(($file = readdir($dir)) !== false){
        //Leo todos los archivos excepto . y ..
        if(strpos($file, '.') !== 0){
            $sNameFile=pathinfo($file,PATHINFO_FILENAME);
            $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
            copy($from.'/'.$file, $to.'/'.$sNameFileEnc.$file);
        }
    }

    $fromfile = glob($from.'/*'); //Definimos la primera ruta
    foreach($fromfile as $archivo){
        if(is_file($archivo))      // Comprobamos que sean ficheros normales, y de ser asi los eliminamos en la siguiente linea
        unlink($archivo);          //Eliminamos el archivo
    }

    //Cambiamos el estado de la modalidad por haber sido cerrado y culminado
    $objClose=new process_close($sIDusersession, $transformsecuretextenc, $nIdProceso);
    $sRpta1=$objClose->upd_proceso_estado_modalidad();
    // $sSqlUpdModalidad="UPDATE proceso SET estado=1, conditions=2, updated_at=NOW(), namehostclient='".$sIDusersession."', nameclientconection='".$transformsecuretextenc."' WHERE id = ".$nIdProceso;
    // $mysqli->query($sSqlUpdModalidad, MYSQLI_STORE_RESULT);

    
    $objClose=new process_close($sIDusersession, $transformsecuretextenc, "TRUNCATE repsiries");
    $sRpta2=$objClose->clear_tablet_primary();
    $objClose=new process_close($sIDusersession, $transformsecuretextenc, "TRUNCATE identifica");
    $sRpta3=$objClose->clear_tablet_primary();
    $objClose=new process_close($sIDusersession, $transformsecuretextenc, "TRUNCATE replystudent");
    $sRpta4=$objClose->clear_tablet_primary();
    $objClose=new process_close($sIDusersession, $transformsecuretextenc, "TRUNCATE key_file");
    $sRpta5=$objClose->clear_tablet_primary();

    // $sSqlUpdModalidad='TRUNCATE repsiries';
    //     $mysqli->query($sSqlUpdModalidad, MYSQLI_STORE_RESULT);
    // $sSqlUpdModalidad='TRUNCATE identifica';
    //     $mysqli->query($sSqlUpdModalidad, MYSQLI_STORE_RESULT);
    // $sSqlUpdModalidad='TRUNCATE replystudent';
    //     $mysqli->query($sSqlUpdModalidad, MYSQLI_STORE_RESULT);
    // $sSqlUpdModalidad='TRUNCATE key_file';
    //     $mysqli->query($sSqlUpdModalidad, MYSQLI_STORE_RESULT);
    if($sRpta1="Ok" && $sRpta2="Ok" && $sRpta3="Ok" && $sRpta4="Ok" && $sRpta5="Ok")
    {
        ?>
            <br>
                <div class="bs-example" data-example-id="glyphicons-accessibility">
                <h5 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> Msg.6001 : EXCELENTE !!!</h5>
                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">PROCESO CERRADO:</span> Usted acaba de cerrar definitivamente el proceso en curso.
                    </div>
                </div>
            <br>
    <?php
    }
}
?>