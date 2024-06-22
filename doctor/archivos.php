<!DOCTYPE html>
<html>
    <!-- Agrega los estilos CSS de SweetAlert2 -->
    <link rel="stylesheet" href="../vendors/sweetalert2/sweetalert2.min.css">

    <!-- Agrega el script de SweetAlert2 -->
    <script src="../vendors/sweetalert2/sweetalert2.all.min.js"></script>
<head>

</head>
<body>

<?php
    if(!isset($_SESSION['id'])){ header("Location: index.php"); exit; }else{$ssIDusersession=$_SESSION['id']; $tipo_usuario=$_SESSION['tipo_usuario'];}
    
    include("classreadfile.php");
    include("classdatastatus.php");
    require('namehostclient.php');
    //require('transformsecuretext.php');
    
    $ip=get_client_ip();
    $sIDusersession=get_encrypttxinfo($ssIDusersession);
    $transformsecuretextenc=get_encrypttxinfo($ip);
    $nNroDatosDev=""; $bContainerDate=false;
    if(!empty($_POST['filedelete'])){
        $sNombArch=$_POST['filedelete'];
        echo $sNombArch;
    }
    $sMensaje="";
    $clsBca= new status_import();
    if(isset($_POST['reset_data_temp'])){
        //echo "Se resetearon los datos temporales, ahora podra cargarlos nuevamente.<br>";
        $sMensaje=$clsBca->reset_data_temp();
        if(isset($sMensaje)){
            reset_pre_carga();
        }else{
            error_reset_pre_carga();
        }
    }

    if(isset($_POST['precargar'])) {

        $lee = new lectura();
        //$nNroPregunta=$lee->read_file_siries($sIDusersession, $transformsecuretextenc, $_POST['txtNameFilePreCarga']);
        if($_POST['txtNameFilePreCarga']=='Reportesiries.csv'){
            $sStado=$clsBca->status_date__entity("repsiries", "id_repsiries");
            //echo is_null($sStado) ? 'Null' : $sStado;
            if(!isset($sStado)){
                $bContainerDate=false;
                $nNroDatosDev=$lee->read_file_siries($_POST['txtNameFilePreCarga']);
                confirma_mensaje($_POST['txtNameFilePreCarga'], " Ahora, continúe con la carga de los demas archivos necesarios.", $nNroDatosDev);
                //echo "No tiene datos en SIRIES y registrara";
            }else{ 
                $bContainerDate=true;
                error_confirma_mensaje($_POST['txtNameFilePreCarga']);
                //echo "SI TIENE DATOS SIRIES y no ara nada";
            }
        }elseif($_POST['txtNameFilePreCarga']=='clave.bin'){
            $sStado=$clsBca->status_date__entity("key_file", "id_keyfile");
            if(!isset($sStado)){
                $bContainerDate=false;
                $nNroDatosDev=$lee->read_file_clave($sIDusersession, $transformsecuretextenc, $_POST['txtNameFilePreCarga']);
                confirma_mensaje($_POST['txtNameFilePreCarga'], " Ahora, continúe con la carga de los demas archivos necesarios.", $nNroDatosDev);
                //echo "No tiene datos en CLAVE y registrara";
            }else{ 
                $bContainerDate=true;
                error_confirma_mensaje($_POST['txtNameFilePreCarga']);
                //echo "SI TIENE DATOS CLAVE y no ara nada";
            }
        }elseif($_POST['txtNameFilePreCarga']=='identifica.bin'){
            $sStado=$clsBca->status_date__entity("identifica", "id_identifica");
            if(!isset($sStado)){
                $bContainerDate=false;
                $nNroDatosDev=$lee->read_file_identifica($_POST['txtNameFilePreCarga']);
                confirma_mensaje($_POST['txtNameFilePreCarga'], " Ahora, continúe con la carga de los demas archivos necesarios.", $nNroDatosDev);
                //echo "No tiene datos en IDENTIFICA y registrara";
            }else{ 
                $bContainerDate=true;
                error_confirma_mensaje($_POST['txtNameFilePreCarga']);
                //echo "SI TIENE DATOS IDENTIFICA y no hara nada";
            }
        }elseif($_POST['txtNameFilePreCarga']=='respuesta.bin'){
            $sStado=$clsBca->status_date__entity("replystudent", "id_reply");
            if(!isset($sStado)){
                $bContainerDate=false;
                $nNroDatosDev=$lee->read_file_respuesta($_POST['txtNameFilePreCarga']);
                confirma_mensaje($_POST['txtNameFilePreCarga'], " Ahora, continúe con la carga de los demas archivos necesarios.", $nNroDatosDev);
                //echo "No tiene datos en RESPUESTA y registrara";
            }else{ 
                $bContainerDate=true;
                error_confirma_mensaje($_POST['txtNameFilePreCarga']);
                //echo "SI TIENE DATOS DE RESPUESTA y no hara nada";
            }
        }
            if($bContainerDate!=false){
                ?>
                <br>
                <br>
                <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> CUIDADO : !!!</h4>    
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Cuidado |</strong> YA SE SUBIERON LOS DATOS DE ESTE ARCHIVO - <?php echo $_POST['txtNameFilePreCarga']; ?>.!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <hr>
                        <p class="mb-0">
                            <form name="frmResetDataTemp" method="POST" action="principal.php?sFiles=archivos" enctype="multipart/form-data">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="input-group-btn">
                                                <button class="btn btn-round btn-warning" name="reset_data_temp" type="submit">Resetear data temporal</button>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </form>

                        </p>
                    </div>
                <?php
            }
    }



    if(isset($_POST['eliminar'])) {
        if(!empty($_POST['txtNameFileDelete'])){
            $sNombArchDelete=$_POST['txtNameFileDelete'];
            If (unlink('uploads_files/'.$sNombArchDelete)) {
                remove_file($sNombArchDelete);
                ?>
                    <!--
                        <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> EXCELENTE : !!!</h4>
                        <div class="alert alert-success alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>El achivo</strong> se elimino satisfactoriamente.
                        </div>
            -->
                    <?php
            } else {
                error_remove_file($sNombArchDelete);
                ?>
                <!--
                    <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> ERROR : 1041!!!</h4>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Lo lamento, el archivo no se pudo eliminar !!</strong>, contacte al administrador del sistema.
                    </div>
            -->
                <?php
            }
        }
    }
?>
    <link rel="stylesheet" type="text/css" href="stylosarchivos.css">

<div class="x_panel">
    <div class="page-title">
        <div class="title_left">
            <h3>Realizar la carga de archivos base para la importaci&oacute;n</h3>
        </div>
    </div>

    <div class="jumbotron">
        <section>
                <form name="frmBcaDNIPost" method="POST" action="principal.php?sFiles=archivos" enctype="multipart/form-data" >
                    <div class="title_right">
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div class="file">
                                    <h4 id="nombre"></h4><br>
                                    <label for="archivo">Elige un archivo</label>
                                    <input type="file" id="archivo" name="archivo" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">Subir el archivo seleccionado</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </section>
    <script type="text/javascript">
        let archivo = document.querySelector('#archivo');
        archivo.addEventListener('change',() => {
            document.querySelector('#nombre').innerText = archivo.files[0].name;
        });
    </script>
    </div>
</div>

<?php






    if(isset($_FILES["archivo"])){
        $formatos_permitidos =  array('bin', 'csv');
        $nombress_permitidos =  array('clave', 'identifica', 'Reportesiries', 'respuesta');
        $archivoExt = $_FILES['archivo']['name'];
        $extension = pathinfo($archivoExt, PATHINFO_EXTENSION);
        $nombresFiles = pathinfo($archivoExt, PATHINFO_FILENAME);
        if(!in_array($extension, $formatos_permitidos)) {
            ?>
                <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> ERROR : 1023!!!</h4>
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Lo lamento, el formato no es permitido !!</strong>, vuelva a intentarlo.
                </div>
            <?php
        }elseif(!in_array($nombresFiles, $nombress_permitidos)) {
            ?>
                <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> ERROR : 1024!!!</h4>
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Lo lamento, el nombre del archivo no es el correcto !!</strong>, verifique los requisitos exigidos por el sistema y vuelva a intentarlo.
                </div>
            <?php
        }else{
            $file1 = $_FILES["archivo"];
            if(move_uploaded_file( $file1["tmp_name"], "./uploads_files/".$file1["name"])){ // FUNCION PARA SUBIR EL ARCHIVO
                ?><div>
                    <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> EXCELENTE : !!!</h4>
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>El achivo</strong> fue cargado satisfactoriamente.
                    </div>
            </div>
                <?php
            }else{
                ?>
                    <h4 class="alert-heading"><i class="fa fa-info-circle fa-warning (alias)"></i> ERROR : 1030!!!</h4>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Lo lamento,</strong> no se logro subir el archivo, verifique los requisitos antes de volver a intentarlo.
                    </div>
                <?php
            }
        }
    }


$dir='uploads_files/';
$nNroFilesBsca=0;
if($handle=opendir($dir)){
    while(($file=readdir($handle))!==false){
        if(!in_array($file,array('.', '..')) && !is_dir($dir.$file)){
            $nNroFilesBsca++;
        }
    }
}

    //Listamos los archivos cargados en el servidor
    $nContIng=0;
    $thefolder = "uploads_files/";
    if ($handler = opendir($thefolder)) {
        if($nNroFilesBsca !== 0){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="x_content">
                    
                    <div class="col-md-6 col-sm-6  ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>ARCHIVOS REQUERIDOS <small>Files SIAD Server (FSS)</small></h2>
                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nombre del archivo</th>
                                        <th>Extensi&oacute;n</th>
                                        <th>Tama&ntilde;o</th>
                                        <th>Acti&oacute;n File</th>
                                        <th>Data File</th>
                                    </tr>
                                    </thead>
                                    
                                        <?php
                                            while (false !== ($file = readdir($handler))) {
                                                if($file<>'.' && $file<>'..'){
                                                    $nContIng++;
                                                    ?>
                                                    <form name="frmEliminaArchivo" method="POST" action="principal.php?sFiles=archivos" enctype="multipart/form-data" >
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $nContIng; ?></th>
                                                                <td><?php echo strtoupper(pathinfo($file, PATHINFO_FILENAME)); ?></td>
                                                                <td><?php echo strtoupper(pathinfo($file, PATHINFO_EXTENSION)); ?></td>
                                                                <td><?php $nTamanho=0;
                                                                    if(filesize("uploads_files/".$file) < 1000){
                                                                        //Son Byte
                                                                        echo $nTamanho=number_format(filesize("uploads_files/".$file),2).' bytes';
                                                                    }elseif(filesize("uploads_files/".$file) >= 1000 and filesize("uploads_files/".$file) < 1000000){
                                                                        //Son KB
                                                                        echo $nTamanho=number_format(filesize("uploads_files/".$file)/1000,2).' KB';
                                                                    }elseif(filesize("uploads_files/".$file) >= 1000000){
                                                                        //Son MB
                                                                        echo $nTamanho=number_format(filesize("uploads_files/".$file)/1000000,2).' MB';
                                                                    }
                                                                ?></td>
                                                                <td>
                                                                    <input type="hidden" id="txtNameFileDelete" name="txtNameFileDelete" value="<?php echo $file; ?>" required>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-danger" name="eliminar" type="submit">Eliminar</button>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" id="txtNameFilePreCarga" name="txtNameFilePreCarga" value="<?php echo $file; ?>" required>    
                                                                    <span class="input-group-btn">
                                                                        <?php //if($nNroDatosDev="Con datos"){ ?>
                                                                            <button class="btn btn-success" name="precargar" type="submit">Pre-cargar</button>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </form>
                                                <?php
                                            }}?>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php
        closedir($handler);
        closedir($handle);
        }
    }




    function reset_pre_carga(){
        /*
            success: Muestra un icono de éxito (verificación).
            error: Muestra un icono de error (equis roja).
            warning: Muestra un icono de advertencia (triángulo amarillo).
            info: Muestra un icono de información (i en un círculo).
            question: Muestra un icono de pregunta (signo de interrogación).
            none: No muestra ningún icono.
            Aquí tienes un ejemplo de cómo usar 
        */
            echo '<script>
                    Swal.fire({
                        title: "Reset PRE-CARGA!",
                        text: "Se reiniciaros todos los registros de la PRE-CARGA, Vuelva a realizar la PRE-CARGA de datos de los cuatro (04) archivos.",
                        icon: "info"
                    });
                </script>';
    }

    function error_reset_pre_carga(){
            echo '<script>
                    Swal.fire({
                        title: "Excelente.!",
                        text: "Lamentablemente sucedió un error inesperado, porfavor vuelva a intentarlo.",
                        icon: "error"
                    });
                </script>';
    }

    function confirma_mensaje($sNameFile, $sMsg, $nNroDatos){
        echo '<script>
                Swal.fire({
                    title: "Excelente.!",
                    text: "¡Buen trabajo! La PRE-CARGA de \"'.$sNameFile.'\" culminó satisfactoriamente con la inserción de '.$nNroDatos.' registros. '.$sMsg.'",
                    icon: "success",
                });
            </script>';
    }
    
    function error_confirma_mensaje($sNameFile){
        echo '<script>
                Swal.fire({
                    title: "Advertencia.!",
                    text: "Ya se realizó la PRE-CARGA de este archivo \"'.$sNameFile.'\". Si desea, puede reinicializar los datos de la pre-carga, para ello haga clic en el botón \"Resetear data temporal\"",
                    icon: "warning"

                });
            </script>';
    }

    function remove_file($sNameFile){
        echo '<script>
                Swal.fire({
                    title: "Excelente.!",
                    text: "Se eliminó el archivo \"'.$sNameFile.'\" satisfactoriamente.,
                    icon: "success"
                });
            </script>';
    }
    
    function error_remove_file($sNameFile){
        echo '<script>
                Swal.fire({
                    title: "Error inesperado.!",
                    text: "Lamentablemente no pudimos eliminar el archivo \"'.$sNameFile.'\". Si el problema persiste, contacte al administrador del sistema.,
                    icon: "error"
                });
            </script>';
    }
?>