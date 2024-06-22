<?php
        $useremail="leonardo@gmail.com";
        /*     session_start();
            if (isset($_SESSION["user"])) {
                if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
                    header("location: ../login.php");
                } else {
                    $useremail = $_SESSION["user"];
                }
            } else {
                header("location: ../login.php");
            } */

        //import database
        include("../connection.php");
        $userrow = $database->query("select * from doctor where docemail='$useremail'");
        $userfetch = $userrow->fetch_assoc();
        $userid = $userfetch["docid"];
        $username = $userfetch["docname"];

        if ($_GET) {
            $id = $_GET["id"];
            $att= $_GET["atention"];
            $pid = $id;
            $atention= $att;
            if (isset($_GET["id"]) && isset($_GET["atention"])) {
                $sql2="UPDATE appointment SET estadoattenc = 2 WHERE pid = $id and appoid = $att;";
                $result= $database->query($sql2);
                //header("location: appointment.php?action=booking-added&id=".$apponum."&titleget=none");
            }
        }else{
            header("location: ../login.php");
        }
?>
<!DOCTYPE html>
<html lang="es">

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./css/receta.css">
    <link rel="stylesheet" href="./css/atencion-paciente.css">

    <title>Atenci&oacute;n</title>

    <style>
        .bg-orange {
            background-color: orange;
            color: white; /* Asegúrate de que el texto sea visible */
        }

        .horizontal-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }



        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin: 5px; /* Espacio entre las imágenes */
            cursor: pointer; /* Cambiar el cursor a pointer */
            transition: 0.3s;
        }
        .avatar:hover {opacity: 0.7;}
        .city {display:none}
        .avatar-list {
            display: flex; /* Alinear horizontalmente */
            flex-wrap: wrap; /* Permitir que las imágenes se ajusten a la siguiente línea si es necesario */
        }


        /* The Modal (background) */
        #imageModal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 2000; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {  
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)} 
        to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
        from {transform:scale(0)} 
        to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        }

        .close:hover,
        .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
        }

        .city {display:none}
        .avatar-list {
        display: flex; /* Alinear horizontalmente */
        flex-wrap: wrap; /* Permitir que las imágenes se ajusten a la siguiente línea si es necesario */
        }






        /* Estilos aplicados a la tabla de las ordenes de examenes externos */
        .custom-table {
            width: 100%;
            table-layout: fixed; /* Hace que las columnas tengan un ancho fijo */
            border: none; /* Eliminar el borde de la tabla */
        }

        .custom-table td {
            padding: 10px; /* Espacio interno en las celdas */
            vertical-align: middle; /* Alinea el contenido verticalmente en el medio */
            border: none; /* Quita el borde de las celdas */
        }

        .custom-col-select {
            width: 30%; /* Ajustar según sea necesario */
            white-space: nowrap; /* Impedir que el texto se rompa */
        }

        .custom-col-input {
            width: 40%; /* Ajustar según sea necesario */
        }

        .custom-col-button {
            width: 15%; /* Ajustar según sea necesario */
        }

        .custom-table .form-control {
            width: 100%; /* Asegurarse de que el input ocupe todo el ancho de su celda */
            box-sizing: border-box; /* Incluir padding y border en el ancho total */
        }

        .custom-table button {
            width: auto; /* Permitir que el botón ajuste su tamaño según el contenido */
        }

        /* Estilos adicionales para dispositivos móviles */
        @media (max-width: 768px) {
            .custom-table td {
                display: block; /* Hace que cada celda se comporte como un bloque */
                width: 100%; /* Ancho completo en dispositivos móviles */
                box-sizing: border-box; /* Incluye el padding en el ancho total */
            }

            .custom-col-button {
                margin-top: 10px; /* Espacio superior para los botones en móviles */
            }
        }




        /* ESTILOS APLICADOS PARA LA TABLA DE CARGA DE EXAMENES EXTERNOS  */
        .custom-table-container {
            overflow-x: auto;
            width: 100%;
        }

        .custom-table {
            border-collapse: collapse;
            width: 100%;
            min-width: 600px; /* Ajustar el valor según sea necesario */
        }

        .custom-table th,
        .custom-table td {
            text-align: left;
            padding: 8px;
            white-space: nowrap; /* Impedir que el texto se rompa */
        }

        .custom-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .custom-table th {
            background-color: #04AA6D;
            color: white;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }

        .custom-table td {
            border: 1px solid #ddd;
        }

        .custom-table-header th {
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }

        .custom-table-row td {
            border-bottom: 1px solid #ddd;
        }

        /* Asegurarse de que la tabla no se rompa en dispositivos móviles */
        @media (max-width: 768px) {
        .custom-table-container {
            overflow-x: auto;
            overflow-y: hidden;
        }
        
        .custom-table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        .custom-table thead, .custom-table tbody, .custom-table th, .custom-table td, .custom-table tr {
            display: block;
        }
        
        .custom-table tr {
            display: table-row;
        }
        
        .custom-table th, .custom-table td {
            white-space: nowrap;
        }
        }
        /* FIN ESTILOS APLICADOS PARA LA TABLA DE CARGA DE EXAMENES EXTERNOS  */

    </style>
<body>
        <?php include 'menuv.php'; ?>
        <div class="content" id="main">
            <div>
                <span style="font-size:30px;cursor:pointer">&#9776;</span>
                <!-- Aquí va el contenido específico de la página principal -->
                <div class="dash-body" style="margin-top: 15px">
                    <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
                        <tr>
                            <td width="13%" class="nav-bar">
                                <a href="index.php">
                                    <button type="button" id="btnvolver" class="btn btn-secondary" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        <i class="fa fa-arrow-left"></i> Volver
                                    </button>
                                </a>
                            </td>
                            <td width="25%">

                                <span style="font-size: 23px;padding-left:12px;font-weight: 600;">
                                
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModalHistoriaClinica">
                                    <i class="fa fa-vcard-o" style="font-size:32px;color:white"></i></button>
                                        Atenci&oacute;n del paciente
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModalHistoriaClinica">
                                    <i class="material-icons" style="font-size: 30px;color:white;">&#xe8e8;</i></button>
                                        <?php
                                            //Extrayendo datos del paciente para ser mostrados en el titulo
                                            $patient = $database->query("select pname, pDNI, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS edad, ptel FROM patient where pid=$id");
                                            $userfetch = $patient->fetch_assoc();
                                            $PatientNombre = $userfetch["pname"];
                                            $PatientDNI = $userfetch["pDNI"];
                                            $PatientEdad = $userfetch["edad"];
                                            $PatientCelular = $userfetch["ptel"];
                                        ?>
                                    <div style="font-size: 16px">
                                        <?php
                                            //echo '<h6><div class="h-auto bg-warning">Paciente: '.$PatientNombre.', DNI N&deg;:'.$PatientDNI.', con '.$PatientEdad.' años y N&deg; Celular: '.$PatientCelular.'</div></h6>';
                                            echo '<span class="badge bg-orange rounded-pill">
                                                <strong>Paciente:</strong> '.$PatientNombre.', <strong>DNI N&deg;:<strong>'.$PatientDNI.', con '.$PatientEdad.' años y <strong>N&deg; Celular:<strong> '.$PatientCelular.'
                                                </span>';
                                        ?>
                                    </div>

                                </span>
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Fecha
                                </p>
                                <p class="heading-sub12" style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    <?php
                                        date_default_timezone_set('America/Bogota');
                                        $today = date('Y-m-d');
                                        echo $today;
                                        $list110 = $database->query("select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  doctor.docid=$userid ");
                                    ?>
                                </p>
                            </td>
                            <td width="10%">
                                <!-- <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button> -->
                                <div class="btn-label">
                                    <div class="btn-content">
                                        <img src="../img/calendar.svg">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="x_content">
                <div id="myTab" class="custom-tab-container">
                    <button id="Antecedentes-tab" href="#Antecedentes" aria-controls="Antecedentes" class="custom-tab-button custom-active-button" onclick="changeTab(0)">Antecedentes</button>
                    <button id="Consulta-tab" href="#Consulta" aria-controls="Consulta" class="custom-tab-button" onclick="changeTab(1)">Consulta</button>
                    <button id="eOftalmologico-tab" href="#eOftalmologico" aria-controls="eOftalmologico" class="custom-tab-button" onclick="changeTab(2)">E-Oftalmol&oacute;g.</button>

                    <button id="Refraccion-tab" href="#Refraccion" aria-controls="Refraccion" class="custom-tab-button" onclick="changeTab(3)">Refracci&oacute;n</button>
                    <button id="Imagenes-tab" href="#Imagenes" aria-controls="Imagenes" class="custom-tab-button" onclick="changeTab(4)">Im&aacute;genes</button>
                    <button id="Diagnosticodr-tab" href="#Diagnosticodr" aria-controls="Diagnosticodr" class="custom-tab-button" onclick="changeTab(5)">Diagn&oacute;stico</button>
                    <button id="eExterno-tab" href="#eExterno" aria-controls="eExterno" class="custom-tab-button" onclick="changeTab(6)">E-Externo</button>
                    <button id="Receta-tab" href="#Receta" aria-controls="Receta" class="custom-tab-button" onclick="changeTab(7)">Receta</button>
                </div>
                <div id="myTabContent">
                    <div id="Antecedentes" role="tabpanel" aria-labelledby="Antecedentes-tab" class="custom-tab-content custom-active">
                        <fieldset class="custom-fieldset checkbox">
                                <legend>Antecedentes</legend>
                                <div>
                                    <label for="checkDM">
                                        <input type="checkbox" id="checkDM" class="js-switch" /> DM
                                        </label>
                                    <label for="checkHTA">
                                        <input type="checkbox" id="checkHTA" class="js-switch" /> HTA
                                        </label>
                                    <label for="checkalergias">
                                        <input type="checkbox" id="checkalergias" class="js-switch" /> Alergias
                                        </label>
                                    <label for="checksinOjoSeco">
                                        <input type="checkbox" id="checksinOjoSeco" class="js-switch" /> Sin ojo seco
                                        </label>
                                    <label for="checkglaucoma">
                                        <input type="checkbox" id="checkglaucoma" class="js-switch" /> Glaucoma
                                        </label>
                                    <label for="checkaltRetinales">
                                        <input type="checkbox" id="checkaltRetinales" class="js-switch" /> Alt. Retinales
                                        </label>
                                    <label for="checktraumaOcular">
                                        <input type="checkbox" id="checktraumaOcular" class="js-switch" /> Trauma ocular
                                        </label>
                                    <label for="checkqxOcularPrevia">
                                        <input type="checkbox" id="checkqxOcularPrevia" class="js-switch" /> QX Ocular Previa
                                        </label>
                                    <label for="checkusaLC">
                                        <input type="checkbox" id="checkusaLC" class="js-switch" /> Usa LC tipo/tiempo
                                        </label>
                                    <label for="checkcolgenopatias">
                                        <input type="checkbox" id="checkcolgenopatias" class="js-switch" /> Cologenopatias
                                        </label>
                                    <label for="checkmedTopicos">
                                        <input type="checkbox" id="checkmedTopicos" class="js-switch" /> Med t&oacute;picos que usa
                                        </label>
                                </div>
                        </fieldset>
                        <fieldset class="curstom-fieldset">
                            <legend>Descripci&oacute;n</legend>
                            <div>
                                <textarea name="descripcionatencion" id="descripcionatencion" class="form-control alphanumeric-input" data-max-length="200"></textarea>
                                <!-- <textarea id="descripcionatencion" required="required" class="form-control" name="descripcionatencion" data-parsley-trigger="keyup" data-parsley-minlength="100" data-parsley-maxlength="300" data-parsley-minlength-message="Debes ingresar un comentario de al menos 20 caracteres." data-parsley-validation-threshold="10" class="resizable_textarea form-control"></textarea> -->
                            </div>
                            <!-- <div> -->
                            <!--     <button type="button" id="btnGuardaAntecedentes" class="btn btn-primary pull-right" style="width:100%"> -->
                            <!--         <i class="fa fa-save"></i>  -->
                            <!--         Guardar antecedentes -->
                            <!--     </button> -->
                            <!--     <button type="button" id="btnGuardaEdicionAntecedentes" class="btn btn-warning pull-right" style="width:100%"> -->
                            <!--         <i class="fa fa-save"></i>  -->
                            <!--         Guardar cambios -->
                            <!--     </button> -->
                            <!-- </div> -->
                            <div id="contenido">
                                <button type="button" id="btnGuardaAntecedentes" class="btn btn-primary pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    <i class="fa fa-save"></i>
                                    Guardar antecedentes
                                </button>
                                <button type="button" id="btnGuardaEdicionAntecedentes" class="btn btn-warning pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    <i class="fa fa-save"></i>
                                    Guardar cambios
                                </button>
                            </div>



                        </fieldset>
                    </div><!-- Fin del primer tab Antecedentes -->

                    <!-- REGISTAR MOTIVO DE LA CONSULTA -->
                    <div id="Consulta" role="tabpanel" aria-labelledby="Consulta-tab" class="custom-tab-content">
                        <fieldset>
                            <legend>Registrar motivo de la consulta</legend>
                            <div>
                                <textarea name="motivoconsulta" id="motivoconsulta" class="form-control alphanumeric-input" data-max-length="250"></textarea>
                                <!-- <textarea id="motivoconsulta"  style="height: 150px;" required="required" class="form-control txtmotivoconsulta" name="motivoconsulta" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="500" data-parsley-minlength-message="Debes ingresar un comentario de al menos 20 caracteres." data-parsley-validation-threshold="10" class="resizable_textarea form-control"></textarea> -->
                            </div>
                            <div id="contenido">
                                <button type="button" id="btnGuardaMotivoConsulta" class="btn btn-primary pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    <i class="fa fa-save"></i>
                                    Guardar motivo
                                </button>
                                <button type="button" id="btnGuardaEdicionMotivoConsulta" class="btn btn-warning pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    <i class="fa fa-save"></i>
                                    Guardar cambios
                                </button>
                            </div>


                        </fieldset>
                    </div>
                    <!-- FIN REGISTAR MOTIVO DE LA CONSULTA -->

                    <!-- EXAMEN OFTALMOLOGICO -->
                    <div id="eOftalmologico" role="tabpanel" aria-labelledby="eOftalmologico-tab" class="custom-tab-content">
                    
                        <h2><i class="fa fa-eye"></i> Ex&aacute;men oftalmol&oacute;gico
                            <button type="button" id="btnGuardaExamOftalm" class="btn btn-primary" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                            <button type="button" id="btnGuardaEdicionExamOftalm" class="btn btn-warning pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                <i class="fa fa-save"></i>
                                Guardar cambios
                            </button>
                        </h2>
                        
                        <fieldset class="custom-fieldset">
                            <legend>Agudeza visual:</legend>
                                <div>
                                    <label for="odSinCorrector">Sin correctores</label>
                                    <input type="text" class="form-control decimal-input" style="width: 100%;" id="odSinCorrector" name="odSinCorrector" placeholder="OD">
                                    <input type="text" class="form-control decimal-input" style="width: 100%;" id="oiSinCorrector" name="oiSinCorrector" placeholder="OI">
                                </div>
                                <div>
                                    <label for="odConCorrector">Con corrector</label>
                                    <input type="text" class="form-control decimal-input" style="width: 100%;" id="odConCorrector" name="odConCorrector" placeholder="OD">
                                    <input type="text" class="form-control decimal-input" style="width: 100%;" id="oiConCorrector" name="oiConCorrector" placeholder="OI">
                                </div>
                                <div>
                                    <label for="odAgujeroSteropertico">Agujero esteroperco</label>
                                    <input type="text" id="odAgujeroSteropertico" class="form-control decimal-input" style="width: 100%;" name="odAgujeroSteropertico" placeholder="OD">
                                    <input type="text" id="oiAgujeroSteropertico" class="form-control decimal-input" style="width: 100%;" name="oiAgujeroSteropertico" placeholder="OI">
                                </div>
                        </fieldset>
                        
                        <fieldset class="custom-fieldset">
                            <legend>Biomicroscop&iacute;a:</legend>
                                <div>
                                    <label for="odParpados">P&aacute;rpados</label>
                                    <input type="text" class="form-control decimal-input" id="odParpados" name="odParpados" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiParpados" name="oiParpados" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odViaLagrimal">V&iacute;a lagrimal</label>
                                    <input type="text" class="form-control decimal-input" id="odViaLagrimal" name="odViaLagrimal" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiViaLagrimal" name="oiViaLagrimal" placeholder="OI" style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odConjuntiva">Conjuntiva</label>
                                    <input type="text" class="form-control decimal-input" id="odConjuntiva" name="odConjuntiva" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiConjuntiva" name="oiConjuntiva" placeholder="OI" style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odCornea">C&oacute;rnea</label>
                                    <input type="text" class="form-control decimal-input" id="odCornea" name="odCornea" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiCornea" name="oiCornea" placeholder="OI" style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odCamaraAnterior">C&aacute;mara anterior</label>
                                    <input type="text" class="form-control decimal-input" id="odCamaraAnterior" name="odCamaraAnterior" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiCamaraAnterior" name="oiCamaraAnterior" placeholder="OI" style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odCristalino">Cristalino</label>
                                    <input type="text" class="form-control decimal-input" id="odCristalino" name="odCristalino" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiCristalino" name="oiCristalino" placeholder="OI" style="width: 100%;">
                                </div>
                        </fieldset>

                        <fieldset class="custom-fieldset">
                            <legend>Tonometr&iacute;a:</legend>
                                <div>
                                    <label for="odAplanatico">Aplan&aacute;tico</label>
                                    <input type="text" class="form-control decimal-input" id="odAplanatico" name="odAplanatico" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiAplanatico" name="oiAplanatico" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odPIntraocular">Presi&oacute;n intraocular corregida</label>
                                    <input type="text" class="form-control decimal-input" id="odPIntraocular" name="odPIntraocular" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiPIntraocular" name="oiPIntraocular" placeholder="OI" style="width: 100%;">
                                </div>
                        </fieldset>

                        <fieldset class="custom-fieldset">
                            <legend>Fondo de ojo:</legend>
                                <div>
                                    <label for="odRelacionCopa">Relación Copa/Disco</label>
                                    <input type="text" class="form-control decimal-input" id="odRelacionCopa" name="odRelacionCopa" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiRelacionCopa" name="oiRelacionCopa" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odVasos">Vasos</label>
                                    <input type="text" class="form-control decimal-input" id="odVasos" name="odVasos" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiVasos" name="oiVasos" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odBordesNervio">Bordes del nervio &oacute;ptico</label>
                                    <input type="text" class="form-control decimal-input" id="odBordesNervio" name="odBordesNervio" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiBordesNervio" name="oiBordesNervio" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odAnilloNeuroretinal">Anillo neuroretinal</label>
                                    <input type="text" class="form-control decimal-input" id="odAnilloNeuroretinal" name="odAnilloNeuroretinal" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiAnilloNeuroretinal" name="oiAnilloNeuroretinal" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odRetina">Otras caracter&iacute;sticas</label>
                                    <input type="text" class="form-control decimal-input" id="odRetina" name="odRetina" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiRetina" name="oiRetina" placeholder="OI"  style="width: 100%;">
                                </div>
                        </fieldset>
                        
                        <fieldset class="custom-fieldset">
                            <legend>Retina:</legend>
                                <div>
                                    <label for="odVasosRetinales">Vasos retinales</label>
                                    <input type="text" class="form-control decimal-input" id="odVasosRetinales" name="odVasosRetinales" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiVasosRetinales" name="oiVasosRetinales" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odMacula">M&aacute;cula</label>
                                    <input type="text" class="form-control decimal-input" id="odMacula" name="odMacula" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiMacula" name="oiMacula" placeholder="OI"  style="width: 100%;">
                                </div>
                                <div>
                                    <label for="odRetinaPeriferica">Retina perif&eacute;rica</label>
                                    <input type="text" class="form-control decimal-input" id="odRetinaPeriferica" name="odRetinaPeriferica" placeholder="OD" style="width: 100%;">
                                    <input type="text" class="form-control decimal-input" id="oiRetinaPeriferica" name="oiRetinaPeriferica" placeholder="OI"  style="width: 100%;">
                                </div>
                        </fieldset>
                        
                    </div>
                    <!-- FIN EXAMEN OFTALMOLOGICO -->

                    <!-- INDICE DE REFRACCION -->
                    <div id="Refraccion" role="tabpanel" aria-labelledby="Refraccion-tab" class="custom-tab-content">
                        <div class="horizontal-container">
                            <h2><i class="fa fa-codiepie"></i> &Iacute;ndice de refracci&oacute;n</h2>
                            <div id="contenido">
                                <button type="button" id="btnGuardaIndiceRefraccion" class="btn btn-primary" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                                <button type="button" id="btnGuardaEdicionIndiceRefraccion" class="btn btn-warning pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    <i class="fa fa-save"></i> Guardar cambios
                                </button>
                            </div>
                        </div>
                        <fieldset>
                                <table class="custom-table refraccion">
                                    <thead>
                                            <tr class="custom-row">
                                                <th class="col">Refracci&oacute;n</th>
                                                <th class="col">Esfera</th>
                                                <th class="col">Cilindro</th>
                                                <th class="col">Eje</th>
                                                <th class="col">D.I.P.</th>
                                                <th class="col">Prisma</th>
                                            </tr>
                                    </thead>
                                    <thead>
                                            <!-- Filas -->
                                            <tr class="custom-row">
                                                <td class="col">Lejos OD</td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="ODEsferaLejos" name="ODEsferaLejos" placeholder="EL D"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="ODCilindroLejos" placeholder="CL D"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="ODEjeLejos" placeholder="EL D"></td>
                                                <td class="col" rowspan="2"><input type="text"class="form-control decimal-input" style="width: 100%;" id="DIPLejos" placeholder="DIP"></td>
                                                <td class="col" rowspan="2"><input type="text"class="form-control decimal-input" style="width: 100%;" id="PrismaLejos" placeholder="Pris"></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">Lejos OI</td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="OIEsferaLejos" placeholder="Esf Lej I"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="OICilindroLejos" placeholder="Cil Lej I"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="OIEjeLejos" placeholder="Eje Lej I"></td>
                                                <!-- <td class="col">DIP Lejos</td>
                                                <td class="col">Prisma Lejos</td> -->
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">Cerca OD</td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="ODEsferaCerca" placeholder="Esfera"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="ODCilindroCerca" placeholder="Cilindro"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="ODEjeCerca" placeholder="Eje"></td>
                                                <td class="col" rowspan="2"><input type="text"class="form-control decimal-input" style="width: 100%;" id="DIPCerca" placeholder="DIP"></td>
                                                <td class="col" rowspan="2"><input type="text"class="form-control decimal-input" style="width: 100%;" id="PrismaCerca" placeholder="Prisma"></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">Cerca OI</td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="OIEsferaCerca" placeholder="Esfera"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="OICilindroCerca" placeholder="Cilindro"></td>
                                                <td class="col"><input type="text"class="form-control decimal-input" style="width: 100%;" id="OIEjeCerca" placeholder="Eje"></td>
                                                <!-- <td class="col">Celda</td>
                                                <td class="col">Celda</td> -->
                                            </tr>

                                            <tr class="custom-row">
                                                <td class="col">DIAGN&Oacute;STICO:</td>
                                                <td class="col"><input type="checkbox" id="checkAstismatigmo" class="js-switch" /> <label for="checkAstismatigmo"><span style="font-size: 14px;">Astigmatismo</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkHipermetropia" class="js-switch" /> <label for="checkHipermetropia"><span style="font-size: 14px;">Hipermetropia</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkMiopia" class="js-switch" /> <label for="checkMiopia"><span style="font-size: 14px;">Miopia</span></label></td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkPresbicia" class="js-switch" /><label for="checkPresbicia"><span style="font-size: 14px;">Presbicia</span></label></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">CRISTAL:</td>
                                                <td class="col"><input type="checkbox" id="checkCristalBlanco" class="js-switch" /><label for="checkCristalBlanco"><span style="font-size: 14px;">Blanco</span></label></td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkCristalPhotogray" class="js-switch" /><label for="checkCristalPhotogray"><span style="font-size: 14px;">Photogray</span></label></td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkCristalPhotobrown" class="js-switch" /><label for="checkCristalPhotobrown"><span style="font-size: 14px;">Photobrown</span></label></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col" rowspan="2">RESINA:</td>
                                                <td class="col"><input type="checkbox" id="checkResinaBlanco" class="js-switch" />  <label for="checkResinaBlanco"><span style="font-size: 14px;">Blanco</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkResinaProteccionUV" class="js-switch" /><label for="checkResinaProteccionUV"><span style="font-size: 14px;">Protecci&oacute;n UV</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkResinaTransition" class="js-switch" /><label for="checkResinaTransition"><span style="font-size: 14px;">Transition</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkResinaFotomatic" class="js-switch" /><label for="checkResinaFotomatic"><span style="font-size: 14px;">Fotomatic</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkResinaUltralite" class="js-switch" /><label for="checkResinaUltralite"><span style="font-size: 14px;">Ultralite</span></label></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col"><input type="checkbox" id="checkPolicarbonato" class="js-switch" /><label for="checkPolicarbonato"><span style="font-size: 14px;">Policarbonato</span></label></td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkAntireflex" class="js-switch" /><label for="checkAntireflex"><span style="font-size: 14px;">Antireflex</span></label></td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkFiltroAzul" class="js-switch" /><label for="checkFiltroAzul"><span style="font-size: 14px;">Filtro Azul</span></label></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col" rowspan="2">PROCESOS:</td>
                                                <td class="col">Cristal endurecido</td>
                                                <td class="col"><input type="checkbox" id="checkPCETermico" class="js-switch" /><label for="checkPCETermico"><span style="font-size: 14px;">T&eacute;mico</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkResinaEndurecido" class="js-switch" /><label for="checkResinaEndurecido"><span style="font-size: 14px;">Endurecido</span></label></td>
                                                <td class="col" colspan="2" rowspan="2">
                                                    <label for="txtProcesosObservacion"><span style="font-size: 14px;">Observaci&oacute;n</span></label><br>
                                                    <input type="text" id="txtProcesosObservacion" class="form-control alphanumeric-input" data-max-length="175" style="width: 100%;">
                                                </td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">Resina</td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkPCEDuraquarz" class="js-switch" /><label for="checkPCEDuraquarz"><span style="font-size: 14px;">Duraquarz</span></label></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">ADICIONALES:</td>
                                                <td class="col">Lentes (+):</td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkAdicMasReducDiametro" class="js-switch" /><label for="checkAdicMasReducDiametro"><span style="font-size: 14px;">Reducci&oacute;n de di&aacute;metro</span></label></td>
                                                <td class="col">Lentes (-):</td>
                                                <td class="col"><input type="checkbox" id="checkAdicMenAltoIndice" class="js-switch" /><label for="checkAdicMenAltoIndice"><span style="font-size: 14px;">Alto &iacute;ndice</span></label></td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td class="col">Bifocal:</td>
                                                <td class="col"><input type="checkbox" id="checheckBifocalFlaptopckAdicMasReducDiametro" class="js-switch" /><label for="checheckBifocalFlaptopckAdicMasReducDiametro"><span style="font-size: 14px;">Flaptop</span></label></td>
                                                <td class="col"><input type="checkbox" id="checkBifocalInvisible" class="js-switch" /><label for="checkBifocalInvisible"><span style="font-size: 14px;">Invisible</span></label></td>
                                                <td class="col">Multifocal:</td>
                                                <td class="col" colspan="2"><input type="checkbox" id="checkMultifocalVisionLCI" class="js-switch" /><label for="checkMultifocalVisionLCI"><span style="font-size: 14px;">Visi&oacute;n de lejos, cerca, intermedia</span></label></td>
                                            </tr>
                                    </thead>
                                </table>
                        </fieldset>
                    </div>
                    <div id="Imagenes" role="tabpanel" aria-labelledby="Imagenes-tab" class="custom-tab-content">
                        <div class="container mt-3">
                            <h2><i class="fa fa-id-badge"></i> Mis ex&aacute;menes
                                <button type="button" id="btnGuardaImagenesEquiposPropios" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;"><i class="fa fa-save"></i> Guardar</button>
                            </h2>
                            <fieldset class="custom-fieldset">
                                    <legend>Volk Pictor
                                        <span id="volkPictorBadge" class="w3-badge w3-green" style="cursor: pointer;">0</span>
                                    </legend>
                                <?php
                                    $from = 'tomas/volkpictor/';
                                    $to = 'tomas/';
                                    foreach (scandir($from) as $file) {
                                        // Si el archivo es una imagen, lo cargamos
                                        if (is_file($from.$file) && exif_imagetype($from.$file)) {
                                            $fromVolkPictor = opendir($from);
                                            $imageNameVolkPictor=pathinfo($file,PATHINFO_FILENAME);
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);// Obtenemos la extensión de la imagen
                                            $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
                                            $sNameOriginalImages = $imageNameVolkPictor.'.'.$extension;
                                            $sNewNameImages = $sNameFileEnc.$file;
                                            ?>
                                            <table>
                                                <tr>
                                                    <td colspan="2">
                                                        <img class="rounded img-fluid" width="100" src="<?php echo $from.$sNameOriginalImages; ?>" alt="image"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="mask">
                                                            <div class="tools tools-bottom">
                                                                <a href="visor.php?TZS2C=<?php echo $i.'&TtS2c='.$f; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="checkImgVolkPictor<?php echo $imageNameVolkPictor; ?>" name="checkImgVolkPictor[]" 
                                                        value="<?php echo $from.$sNameOriginalImages.'|'. $to.$sNewNameImages.'|5'; ?>" class="js-switch" checked />
                                                        <strong><?php echo $imageNameVolkPictor; ?></strong>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php
                                        }
                                    }
                                ?>
                            </fieldset>
                            <fieldset class="custom-fieldset">
                                <legend>TopCon 
                                    <span id="TopConBadge" class="w3-badge w3-green" style="display:none;">0</span>
                                </legend>
                                <?php
                                    $fromTopCon = 'tomas/topcon/';
                                    $toTopCon = 'tomas/';
                                    unset($file);
                                    foreach (scandir($fromTopCon) as $file) {
                                        // Si el archivo es una imagen, lo cargamos
                                        if (is_file($fromTopCon.$file) && exif_imagetype($fromTopCon.$file)) {
                                            $fromTopC = opendir($fromTopCon);
                                            $imageNameTopCon = pathinfo($file,PATHINFO_FILENAME);
                                            $extensionTopCon = pathinfo($file, PATHINFO_EXTENSION);// Obtenemos la extensión de la imagen
                                            $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
                                            $sNameOriginalImagesTopCon = $imageNameTopCon.'.'.$extensionTopCon;
                                            $sNewNameImagesTopCon = $sNameFileEnc.$file;
                                            ?>
                                            <table>
                                                <tr>
                                                    <td colspan="2">
                                                        <img class="rounded img-fluid" width="100" src="<?php echo $fromTopCon.$sNameOriginalImagesTopCon; ?>" alt="image"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="mask">
                                                            <div class="tools tools-bottom">
                                                                <a href="visor.php?TZS2C=<?php echo $i.'&TtS2c='.$f; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="checkImgVolkPictor<?php echo $imageNameTopCon; ?>" name="checkImgVolkPictor[]" 
                                                        value="<?php echo $fromTopCon.$sNameOriginalImagesTopCon.'|'. $toTopCon.$sNewNameImagesTopCon.'|10'; ?>" class="js-switch" checked />
                                                        <strong><?php echo $imageNameTopCon; ?></strong>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php
                                        }
                                    }
                                ?>
                            </fieldset>
                            <fieldset class="custom-fieldset">
                                <legend>AutoKerato
                                    <span id="AutoKeratoBadge" class="w3-badge w3-green" style="display:none;">0</span>
                                </legend>
                                <?php
                                    $fromAutoKerato = 'tomas/autokerato/';
                                    $toAutoKerato = 'tomas/';
                                    unset($file);
                                    foreach (scandir($fromAutoKerato) as $file) {                                                                                                                
                                        // Si el archivo es una imagen, lo cargamos
                                        if (is_file($fromAutoKerato.$file) && exif_imagetype($fromAutoKerato.$file)) {
                                            $fromAK = opendir($fromAutoKerato);
                                            $imageNameAutoKerato = pathinfo($file,PATHINFO_FILENAME);
                                            $extensionAutoKerato = pathinfo($file, PATHINFO_EXTENSION);// Obtenemos la extensión de la imagen
                                            $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
                                            $sNameOriginalImagesAutoKerato = $imageNameAutoKerato.'.'.$extensionAutoKerato;
                                            $sNewNameImagesAutoKerato = $sNameFileEnc.$file;
                                            ?>
                                            <table>
                                                <tr>
                                                    <td colspan="2">
                                                        <img class="rounded img-fluid" width="100" src="../doctor/tomas/autokerato/<?php echo $sNameOriginalImagesAutoKerato; ?>" alt="image"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="mask">
                                                            <div class="tools tools-bottom">
                                                                <a href="visor.php?TZS2C=<?php echo $i.'&TtS2c='.$f; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="checkImgVolkPictor<?php echo $imageNameAutoKerato; ?>" name="checkImgVolkPictor[]" 
                                                        value="<?php echo $fromAutoKerato.$sNameOriginalImagesAutoKerato.'|'. $toAutoKerato.$sNewNameImagesAutoKerato.'|11'; ?>" class="js-switch" checked />
                                                        <strong> <?php echo $imageNameAutoKerato; ?></strong>
                                                    </td>
                                                </tr>
                                            </table><?php
                                        }
                                    }
                                ?>
                            </fieldset>
                        </div>
                        
                        
                    </div>
                    <div id="Diagnosticodr" role="tabpanel" aria-labelledby="Diagnosticodr-tab" class="custom-tab-content">
                        <fieldset> <!-- class="curstom-fieldset" -->
                            <legend>Registrar diagn&oacute;stico</legend>
                            <div>
                                <input type="text"name="DiagnosticoPaciente" id="DiagnosticoPaciente" class="form-control alphanumeric-input" data-max-length="245" style="width:99%">
                            </div>
                            <div>
                                    <button type="button" id="btnGuardaDiagnostico" class="btn btn-primary" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        <i class="fa fa-save"></i> Guardar
                                    </button>
                                    <button type="button" id="btnGuardaEdicionDiagnostico" class="btn btn-warning pull-right" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        <i class="fa fa-save"></i> Guardar cambios
                                    </button>
                            </div>
                        </fieldset>
                    </div>
                    <div id="eExterno" role="tabpanel" aria-labelledby="eExterno-tab" class="custom-tab-content">
                            <h2><i class="fa fa-medkit"></i> Solicitud de examenes externos</h2>
                            <fieldset>
                                <table id="tableExamExternos" class="custom-table w-100">
                                    <tr>
                                        <td class="custom-col-select">
                                            
                                            <select name="nTpExamExterno" id="nTpExamExterno" class="form-control">
                                                <option value="1">Tomografía coherencia óptica</option>
                                                <option value="2">Biometría de interferometría</option>
                                                <option value="3">Tomografía corneal (Pentacan)</option>
                                                <option value="4">Campo visual computarizado</option>
                                                <option value="6">Servicio 12</option>
                                                <option value="7">Ecografía ocular</option>
                                                <option value="8">Tonometría de no contacto</option>
                                                <option value="9">Microscopía especular</option>
                                            </select>
                                        </td>
                                        <td class="custom-col-input">
                                            
                                            <input type="text" class="form-control alphanumeric-input" data-max-length="150" id="descTomografCoherencia" placeholder="Indicaciones..." aria-label="Tomografía coherencia óptica" aria-describedby="btndescTomografCoherencia">
                                        </td>
                                        <td class="custom-col-button">
                                            <button type="button" id="btndescTomografCoherencia" onclick="guarda_orden_para_examen_externo()" class="login-btn btn-primary btn">
                                                <i class="fa fa-save"></i> Guardar
                                            </button>
                                        </td>
                                        <!--
                                            <td class="custom-col-button">
                                                <button class="btn btn-warning pull-right" type="button" id="uploadTomografCoherencia">
                                                    <i class="fa fa-upload"></i>
                                                </button>
                                            </td>
                                        -->
                                    </tr>
                                </table>
                            </fieldset>
                            <fieldset>
                                <h3>Mis ex&aacute;menes externos programados</h3>
                                <div class="custom-table-container" style="overflow-x: auto;">
                                    <table class="custom-table">
                                        <tr class="custom-table-header">
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        <th>Points</th>
                                        </tr>
                                        <tr class="custom-table-row">
                                        <td>Jill</td>
                                        <td>Smith</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        </tr>
                                    </table>
                                </div>

                            </fieldset>
                    </div>


                    <!-- GENERACION DE RECETAS -->
                    <div id="Receta" role="tabpanel" aria-labelledby="Receta-tab" class="custom-tab-content">
                        <div class="row">
                            <fieldset>
                                <legend>B&uacute;squeda de medicamentos</legend>
                                <table>
                                    <tr>
                                    <td>
                                        <input type="text" id="btnBcaMedicina" autocomplete="off" class="form-label" placeholder="Buscar medicamento...">
                                        <div id="suggestions"></div>
                                    </td>
                                    <td>
                                        <input type="number" id="medicine-quantity" min="1" max="20" placeholder="0" value="1" class="same-width">
                                    </td>
                                    <td>
                                        <input type="text" id="medicine-indicaciones" class="flat alphanumeric-input" data-max-length="230" placeholder="Indicaciones">
                                    </td>
                                    <td>
                                        <button id="btnAddMedicamento" class="btn btn-success same-width">Agregar</button>
                                    </td>
                                    </tr>
                                </table>
                            </fieldset>

                            <fieldset class="col-12 mt-3">
                            <legend>Receta médica</legend>
                            <button class="btn btn-primary pull-right" type="button" id="btnSavePrescription" disabled><i class="fa fa-save"></i> Guardar receta</button>
                                <table id="medicines-table" class="custom-table" style="padding-top:20px; padding-bottom:20px; padding-left:50%; padding-right:50%;">
                                    <thead>
                                        <tr>
                                            <th>Medicamento</th>
                                            <th>Cantidad</th>
                                            <th>Indicaciones</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Filas de medicamentos agregadas aquí -->
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>    
                    </div>
                    <!-- GENERACION DE RECETAS -->
                </div>
            </div>
        </div>


        <div id="id01" class="modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                <header class="w3-container w3-blue"> 
                    <span onclick="document.getElementById('id01').style.display='none'" 
                    class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
                    <h2>Im&aacute;genes</h2>
                </header>

                <div class="w3-bar w3-border-bottom">
                    <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'volkpictor')">Ver im&aacute;genes de Volk Pictor</button>
                </div>

                <div id="volkpictor" class="w3-container city">
                    <div id="avatarList" class="avatar-list"></div>
                </div>

                <div class="w3-container w3-light-grey w3-padding">
                    <button class="w3-button w3-right w3-white w3-border" 
                    onclick="document.getElementById('id01').style.display='none'">Cerrar</button>
                </div>
            </div>
        </div>

        <div id="id02" class="modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                <header class="w3-container w3-blue"> 
                    <span onclick="document.getElementById('id02').style.display='none'" 
                    class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
                    <h2>Im&aacute;genes</h2>
                </header>

                <div class="w3-bar w3-border-bottom">
                    <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'TopCon')">Ver im&aacute;genes de TopCon</button>
                </div>

                <div id="TopCon" class="w3-container city">
                    <div id="avatarListTP" class="avatar-list"></div>
                </div>

                <div class="w3-container w3-light-grey w3-padding">
                    <button class="w3-button w3-right w3-white w3-border" 
                    onclick="document.getElementById('id02').style.display='none'">Cerrar</button>
                </div>
            </div>
        </div>

        <div id="id03" class="modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                <header class="w3-container w3-blue"> 
                    <span onclick="document.getElementById('id03').style.display='none'" 
                    class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
                    <h2>Im&aacute;genes</h2>
                </header>

                <div class="w3-bar w3-border-bottom">
                    <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'AutoKerato')">Ver im&aacute;genes del AutoKerato</button>
                </div>

                <div id="AutoKerato" class="w3-container city">
                    <div id="avatarListAK" class="avatar-list"></div>
                </div>

                <div class="w3-container w3-light-grey w3-padding">
                    <button class="w3-button w3-right w3-white w3-border" 
                    onclick="document.getElementById('id03').style.display='none'">Cerrar</button>
                </div>
            </div>
        </div>

        <!-- The Image Modal -->
        <div id="imageModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModalHistoriaClinica">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Mis atenciones</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h3>Lista de historias cl&iacute;nica</h3>
                        <p>Selecciones una opci&oacute;n de la lista para ver generar la historia cl&iacute;nica segcl&uacute;n la fecha de atenci&oacute;n  </p>
                        <p>
                            <div class="form-floating">
                                <select class="form-select" id="sel1" name="sellist">
                                    <?php
                                        $userrow = $database->query("SELECT appoid, pid, apponum, scheduleid, edad, 
                                        CASE typeattention
                                            WHEN 1 THEN 'Atenci&oacute;n m&eacute;dica'
                                            WHEN 2 THEN 'Lectura de resultados'
                                            WHEN 3 THEN '1º atenci&oacute;n postoperatoria' 
                                            WHEN 4 THEN '2º atenci&oacute;n postoperatoria'
                                            WHEN 5 THEN '3º atenci&oacute;n postoperatoria'
                                            WHEN 6 THEN '4º atenci&oacute;n postoperatoria'
                                        END AS typeattention, 
                                        estadoattenc, appodate 
                                        FROM appointment ORDER BY appodate DESC;");
                                        //WHERE pid = $pid and appoid = $atention 
                                        foreach($userrow as $row){
                                            //echo '<option value="'.$row['appoid'].'">'.$row['appodate'].' '.$row['typeattention'].'</option>';
                                            // echo '<option value="'.$row['appoid'].'" data-pdf="historiaclinica.php'.$row['nombre_del_pdf'].'">'.$row['appodate'].' '.$row['typeattention'].'</option>';
                                            //echo '<option value="'.$row['appoid'].'" data-pdf="historiaclinica.php?appoid='.$row['appoid'].'">'.$row['appodate'].' '.$row['typeattention'].'</option>';
                                            echo '<option value="'.$row['appoid'].'">'.$row['appodate'].' '.$row['typeattention'].'</option>';
                                        }
                                    ?>
                                </select>
                                <label for="sel1" class="form-label">Lista de selección (seleccione una opci&oacute;n):</label>
                            </div>
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin The Modal -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./script.js"></script>

        <script>
    
            function changeTab(tabIndex) {
                // Oculta todas las pestañas
                let tabs = document.getElementsByClassName('custom-tab-content');
                for (let tab of tabs) {
                    tab.classList.remove('custom-active');
                }

                // Muestra la pestaña seleccionada
                tabs[tabIndex].classList.add('custom-active');

                // Resalta el botón de la pestaña activa
                let buttons = document.getElementsByClassName('custom-tab-button');
                for (let button of buttons) {
                    button.classList.remove('custom-active-button');
                }
                buttons[tabIndex].classList.add('custom-active-button');

                // Establece el foco en el campo de texto correspondiente al tab activo
                if(tabIndex === 0) {
                    document.getElementById('descripcionatencion').focus();
                }else if(tabIndex === 1) {
                    document.getElementById('motivoconsulta').focus();
                }else if(tabIndex === 2) {
                    document.getElementById('odSinCorrector').focus();
                }else if(tabIndex === 3){
                    document.getElementById('ODEsferaLejos').focus();
                } else if(tabIndex === 5) {
                    document.getElementById('DiagnosticoPaciente').focus();
                } else if(tabIndex === 6) {
                    document.getElementById('descTomografCoherencia').focus();
                } else if(tabIndex === 7) {
                    document.getElementById('btnBcaMedicina').focus();
                }
            }

            document.getElementById("btnGuardaAntecedentes").addEventListener("click", function() {
                // Aquí puedes realizar tu lógica de guardado o hacer una petición AJAX
                // En este ejemplo, se activa la pestaña "Consulta-tab" al guardar
                changeTab(1);
            });
            document.getElementById("btnGuardaEdicionAntecedentes").addEventListener("click", function() {
                changeTab(1);
            });
            document.getElementById("btnGuardaMotivoConsulta").addEventListener("click", function() {
                changeTab(2);
            });
            document.getElementById("btnGuardaEdicionMotivoConsulta").addEventListener("click", function() {
                changeTab(2);
            });
            document.getElementById("btnGuardaExamOftalm").addEventListener("click", function() {
                changeTab(3);
            });
            document.getElementById("btnGuardaEdicionExamOftalm").addEventListener("click", function() {
                changeTab(3);
            });
            document.getElementById("btnGuardaIndiceRefraccion").addEventListener("click", function() {
                changeTab(4);
            });
            document.getElementById("btnGuardaEdicionIndiceRefraccion").addEventListener("click", function() {
                changeTab(4);
            });

            //////////////////////////////////////////////////////////
            ///////////////// ADMINISTRACION DE RECETAS  /////////////
            $(document).ready(function() {
                // Inicializar Switchery
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                    var switchery = new Switchery(html);
                });

                // Inicializar Select2
                $('.select2').select2();

                // Inicializar iCheck
                $('input.flat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });



                let currentFocus = -1;
                let selectedMedicineId = null;

                $("#btnBcaMedicina").on("input", function() {
                    let query = $(this).val();
                    if (query.length > 1) {
                        $.ajax({
                            url: "searchMedicine.php",
                            method: "GET",
                            data: { query: query },
                            success: function(data) {
                                let medicines = JSON.parse(data);
                                let suggestions = '';
                                medicines.forEach(function(medicine, index) {
                                    suggestions += `<div data-id="${medicine.id}" data-index="${index}">${medicine.nombremed}: ${medicine.principioactivo}, ${medicine.concentracion} ${medicine.formafarmaceutica}</div>`;
                                });
                                $("#suggestions").html(suggestions).show();
                                currentFocus = -1;
                            }
                        });
                    } else {
                        $("#suggestions").hide();
                    }
                });

                $(document).on("click", "#suggestions div", function() {
                    let selectedText = $(this).text();
                    selectedMedicineId = $(this).data("id");
                    $("#btnBcaMedicina").val(selectedText);
                    $("#suggestions").hide();
                });

                $(document).click(function(e) {
                    if (!$(e.target).closest('#suggestions, #btnBcaMedicina').length) {
                        $("#suggestions").hide();
                    }
                });

                $("#btnBcaMedicina").on("keydown", function(e) {
                    let items = $("#suggestions div");
                    if (items.length > 0) {
                        if (e.keyCode == 40) { // flecha hacia abajo
                            currentFocus++;
                            addActive(items);
                        } else if (e.keyCode == 38) { // flecha hacia arriba
                            currentFocus--;
                            addActive(items);
                        } else if (e.keyCode == 13) { // Enter
                            e.preventDefault();
                            if (currentFocus > -1) {
                                items[currentFocus].click();
                            }
                        }
                    }
                });

                function addActive(items) {
                    if (!items) return false;
                    removeActive(items);
                    if (currentFocus >= items.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (items.length - 1);
                    $(items[currentFocus]).addClass("active");
                    $("#btnBcaMedicina").val($(items[currentFocus]).text());
                    selectedMedicineId = $(items[currentFocus]).data("id");
                }

                function removeActive(items) {
                    items.removeClass("active");
                }

                $("#medicine-quantity").on("input", function() {
                    if (this.value.length > 2) this.value = this.value.slice(0, 2);
                });

                function updateSaveButtonState() {
                    const hasRows = $("#medicines-table tbody tr").length > 0;
                    $("#btnSavePrescription").prop('disabled', !hasRows);
                }

                $("#btnAddMedicamento").click(function() {
                    let medicamento = $("#btnBcaMedicina").val();
                    let cantidad = $("#medicine-quantity").val();
                    let indicaciones = $("#medicine-indicaciones").val();

                    if (medicamento && cantidad && indicaciones && selectedMedicineId) {
                        let rowId = `row-${selectedMedicineId}`;
                        let row = `<tr id="${rowId}">
                            <td>${medicamento}</td>
                            <td>${cantidad}</td>
                            <td>${indicaciones}</td>
                            <td><button class="btnDelete" data-id="${selectedMedicineId}">&times;</button></td>
                        </tr>`;
                        $("#medicines-table tbody").append(row);
                        $("#btnBcaMedicina").val('');
                        $("#medicine-quantity").val(1);
                        $("#medicine-indicaciones").val('');
                        $("#btnBcaMedicina").focus(); // Poner el foco en el campo de búsqueda
                        selectedMedicineId = null;
                        updateSaveButtonState(); // Update save button state
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Campos incompletos',
                            text: 'Por favor, completa todos los campos antes de agregar.'
                        });
                    }
                });

                $(document).on("click", ".btnDelete", function() {
                    let rowId = $(this).data("id");
                    $(`#row-${rowId}`).remove();
                    updateSaveButtonState(); // Update save button state
                });

                $("#btnSavePrescription").click(function() {
                    // Obtener el valor de PHP
                    const userid = <?php echo json_encode($userid); ?>;
                    const useratt = <?php echo json_encode($att); ?>;

                    // Obtener los parámetros actuales de la URL
                    const params = new URLSearchParams(window.location.search);

                    Swal.fire({
                        title: '¿Guardar receta?',
                        text: "¿Estás seguro de que deseas guardar esta receta?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var medicines = [];
                            $("#medicines-table tbody tr").each(function() {
                                var row = $(this);
                                var medicine = {
                                    pid: params.get('id'), //Id del paciente
                                    docid: userid, //Id del Dr.
                                    appoid: useratt, //Nro de atencion
                                    id: row.find(".btnDelete").data("id"), // Capturar el ID desde el botón eliminar
                                    medicine: row.find("td").eq(0).text(),
                                    quantity: row.find("td").eq(1).text(),
                                    description: row.find("td").eq(2).text()
                                };
                                medicines.push(medicine);
                            });

                            $("#medicines-table tbody").empty(); // Limpia la tabla antes de enviar los datos
                            updateSaveButtonState(); // Actualizar el estado del botón de guardar
                            console.log("Mis parametros: ", medicines);

                            $.ajax({
                                url: 'savePrescription.php',
                                type: 'POST',
                                data: { prescription: medicines },
                                success: function(response) {
                                    console.log(response);
                                    Swal.fire( // Mensaje de confirmación con SweetAlert2
                                        '¡Guardado!',
                                        'La receta se ha guardado con éxito.',
                                        'success'
                                    );
                                },
                                error: function(xhr, status, error) {
                                    console.error("Ha ocurrido un error: " + error);
                                }
                            });
                        }
                    });
                });
;
            });
        //////////////////////////////////////////////////////////
        ///////////////// FIN DE ADMINISTRACION DE RECETAS  //////











            //<!-- Guarda antecedentes -->
            $("#btnGuardaAntecedentes").click(function() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                var antecedentes = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    docid: userid,
                    DM: $("#checkDM").prop('checked') ? 1 : 0,
                    HTA: $("#checkHTA").prop('checked') ? 1 : 0,
                    alergias: $("#checkalergias").prop('checked') ? 1 : 0,
                    sinOjoSeco: $("#checksinOjoSeco").prop('checked') ? 1 : 0,
                    glaucoma: $("#checkglaucoma").prop('checked') ? 1 : 0,
                    altRetinales: $("#checkaltRetinales").prop('checked') ? 1 : 0,
                    traumaOcular: $("#checktraumaOcular").prop('checked') ? 1 : 0,
                    qxOcularPrevia: $("#checkqxOcularPrevia").prop('checked') ? 1 : 0,
                    usaLC: $("#checkusaLC").prop('checked') ? 1 : 0,
                    colgenopatias: $("#checkcolgenopatias").prop('checked') ? 1 : 0,
                    medTopicos: $("#checkmedTopicos").prop('checked') ? 1 : 0,
                    descripcion: $("#descripcionatencion").val()
                };

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar estos antecedentes?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'saveAntecedentes.php',
                            type: 'POST',
                            data: { recibe: antecedentes },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.status === 'success') {
                                    Swal.fire(
                                        '¡Guardado!', res.message, 'success'
                                    ).then(event => {
                                        if (event.isConfirmed) {
                                            activeTab('Consulta', 'motivoconsulta');
                                        }
                                    });
                                } else {
                                    Swal.fire(
                                        'Error', res.message, 'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al guardar los antecedentes.', 'error'
                                );
                            }
                        });
                    }
                });
            });
            //<!-- Fin Guarda Antecedentes -->

            
            //<!-- Guarda Edicion de antecedentes -->
            $("#btnGuardaEdicionAntecedentes").click(function() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                var antecedentes = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    docid: userid,
                    DM: $("#checkDM").prop('checked') ? 1 : 0,
                    HTA: $("#checkHTA").prop('checked') ? 1 : 0,
                    alergias: $("#checkalergias").prop('checked') ? 1 : 0,
                    sinOjoSeco: $("#checksinOjoSeco").prop('checked') ? 1 : 0,
                    glaucoma: $("#checkglaucoma").prop('checked') ? 1 : 0,
                    altRetinales: $("#checkaltRetinales").prop('checked') ? 1 : 0,
                    traumaOcular: $("#checktraumaOcular").prop('checked') ? 1 : 0,
                    qxOcularPrevia: $("#checkqxOcularPrevia").prop('checked') ? 1 : 0,
                    usaLC: $("#checkusaLC").prop('checked') ? 1 : 0,
                    colgenopatias: $("#checkcolgenopatias").prop('checked') ? 1 : 0,
                    medTopicos: $("#checkmedTopicos").prop('checked') ? 1 : 0,
                    descripcion: $("#descripcionatencion").val()
                };

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los cambio realizados?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'updAntecedentes.php',
                            type: 'POST',
                            data: { recibe: antecedentes },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.status === 'success') {
                                    Swal.fire(
                                        '¡Actualizado!', res.message, 'success'
                                    ).then(event => {
                                        if (event.isConfirmed) {
                                            activeTab('Consulta', 'motivoconsulta');
                                        }
                                    });
                                } else {
                                    Swal.fire(
                                        'Error', res.message, 'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al actualizar los antecedentes del paciente.', 'error'
                                );
                            }
                        });
                    }
                });
            });
            //<!-- Fin Guarda Modificacion de Antecedentes -->


            ///////////////////////////////
            // Guarda Motivo de la consulta
                $("#btnGuardaMotivoConsulta").click(function() {
                    const params=new URLSearchParams(window.location.search)
                    const userid = <?php echo json_encode($userid); ?>;
                    var motivoConsulta = {
                        appoid: params.get('atention'),
                        pid: params.get('id'),
                        docid: userid,
                        descripcion: $("#motivoconsulta").val()
                    };

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Deseas guardar el motivo de la consulta?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'saveMotivoConsulta.php',
                                type: 'POST',
                                data: { recibe: motivoConsulta },
                                success: function(response) {
                                    let res = JSON.parse(response);
                                    if (res.status === 'success') {
                                        Swal.fire(
                                            '¡Guardado!', res.message, 'success'
                                        ).then(event => {
                                            if (event.isConfirmed) {
                                                activeTab('eOftalmologico', 'step-2');
                                            }
                                        });
                                    } else {
                                        Swal.fire(
                                            'Error', res.message, 'error'
                                        );
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Ha ocurrido un error: " + error);
                                    Swal.fire(
                                        'Error', 'Ha ocurrido un error al guardar los el motivo de la consulta.', 'error'
                                    );
                                }
                            });
                        }
                    });
                });
            // Fin Guarda motivo de la consulta
            ///////////////////////////////////


            ///////////////////////////////////////
            // Guarda Edición Motivo de la consulta
            $("#btnGuardaEdicionMotivoConsulta").click(function() {
                    const params=new URLSearchParams(window.location.search)
                    const userid = <?php echo json_encode($userid); ?>;
                    var motivoConsulta = {
                        appoid: params.get('atention'),
                        pid: params.get('id'),
                        docid: userid,
                        descripcion: $("#motivoconsulta").val()
                    };

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Deseas guardar los cambios en el motivo de la consulta?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'updMotivoConsulta.php',
                                type: 'POST',
                                data: { recibe: motivoConsulta },
                                success: function(response) {
                                    let res = JSON.parse(response);
                                    if (res.status === 'success') {
                                        Swal.fire(
                                            '¡Guardado!', res.message, 'success'
                                        ).then(event => {
                                            if (event.isConfirmed) {
                                                activeTab('eOftalmologico', 'step-2');
                                            }
                                        });
                                    } else {
                                        Swal.fire(
                                            'Error', res.message, 'error'
                                        );
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Ha ocurrido un error: " + error);
                                    Swal.fire(
                                        'Error', 'Ha ocurrido un error al guardar los el motivo de la consulta.', 'error'
                                    );
                                }
                            });
                        }
                    });
                });
            // Fin Guarda Edición Motivo de la consulta
            ///////////////////////////////////////////



            ///////////////////////////////
            //Guarda Examen oftalmologico
            $("#btnGuardaExamOftalm").click(function() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                var appoid = params.get('atention');
                var pid = params.get('id');

                if (!appoid || !pid) {
                    Swal.fire(
                        'Error', 'No se pudo obtener el identificador de la cita o del paciente.', 'error'
                    );
                    return;
                }

                var resulExamOftalm = {
                    appoid: appoid,
                    pid: pid,
                    docid: userid,
                    oiSinCorrector: $("#oiSinCorrector").val(),
                    odSinCorrector: $("#odSinCorrector").val(),
                    oiConCorrector: $("#oiConCorrector").val(),
                    odConCorrector: $("#odConCorrector").val(),
                    oiAgujeroSteropertico: $("#oiAgujeroSteropertico").val(),
                    odAgujeroSteropertico: $("#odAgujeroSteropertico").val(),
                    oiParpados: $("#oiParpados").val(),
                    odParpados: $("#odParpados").val(),
                    oiViaLagrimal: $("#oiViaLagrimal").val(),
                    odViaLagrimal: $("#odViaLagrimal").val(),
                    oiConjuntiva: $("#oiConjuntiva").val(),
                    odConjuntiva: $("#odConjuntiva").val(),
                    oiCornea: $("#oiCornea").val(),
                    odCornea: $("#odCornea").val(),
                    oiCamaraAnterior: $("#oiCamaraAnterior").val(),
                    odCamaraAnterior: $("#odCamaraAnterior").val(),
                    oiCristalino: $("#oiCristalino").val(),
                    odCristalino: $("#odCristalino").val(),
                    oiAplanatico: $("#oiAplanatico").val(),
                    odAplanatico: $("#odAplanatico").val(),
                    oiPIntraocular: $("#oiPIntraocular").val(),
                    odPIntraocular: $("#odPIntraocular").val(),
                    oiRelacionCopa: $("#oiRelacionCopa").val(),
                    odRelacionCopa: $("#odRelacionCopa").val(),
                    oiVasos: $("#oiVasos").val(),
                    odVasos: $("#odVasos").val(),
                    oiBordesNervio: $("#oiBordesNervio").val(),
                    odBordesNervio: $("#odBordesNervio").val(),
                    oiAnilloNeuroretinal: $("#oiAnilloNeuroretinal").val(),
                    odAnilloNeuroretinal: $("#odAnilloNeuroretinal").val(),
                    oiRetina: $("#oiRetina").val(),
                    odRetina: $("#odRetina").val(),
                    oiVasosRetinales: $("#oiVasosRetinales").val(),
                    odVasosRetinales: $("#odVasosRetinales").val(),
                    oiMacula: $("#oiMacula").val(),
                    odMacula: $("#odMacula").val(),
                    oiRetinaPeriferica: $("#oiRetinaPeriferica").val(),
                    odRetinaPeriferica: $("#odRetinaPeriferica").val()
                };

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los datos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'saveExamOftalm.php',
                            type: 'POST',
                            data: { recibe: resulExamOftalm },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.status === 'success') {
                                    Swal.fire(
                                        '¡Guardado!', res.message, 'success'
                                    ).then(event => {
                                        if (event.isConfirmed) {
                                            activeTab('Refraccion', 'ODEsferaLejos');
                                        }
                                    });
                                } else {
                                    Swal.fire(
                                        'Error', res.message, 'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al guardar datos del examen oftalmologico.', 'error'
                                );
                            }
                        });
                    }
                });
            });
            //Fin examen oftalmologico
            ///////////////////////////////


            ///////////////////////////////
            //Guarda Edicion de Examen oftalmologico
            $("#btnGuardaEdicionExamOftalm").click(function() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                var appoid = params.get('atention');
                var pid = params.get('id');

                if (!appoid || !pid) {
                    Swal.fire(
                        'Error', 'No se pudo obtener el identificador de la cita o del paciente.', 'error'
                    );
                    return;
                }

                var resulExamOftalm = {
                    appoid: appoid,
                    pid: pid,
                    docid: userid,
                    oiSinCorrector: $("#oiSinCorrector").val(),
                    odSinCorrector: $("#odSinCorrector").val(),
                    oiConCorrector: $("#oiConCorrector").val(),
                    odConCorrector: $("#odConCorrector").val(),
                    oiAgujeroSteropertico: $("#oiAgujeroSteropertico").val(),
                    odAgujeroSteropertico: $("#odAgujeroSteropertico").val(),
                    oiParpados: $("#oiParpados").val(),
                    odParpados: $("#odParpados").val(),
                    oiViaLagrimal: $("#oiViaLagrimal").val(),
                    odViaLagrimal: $("#odViaLagrimal").val(),
                    oiConjuntiva: $("#oiConjuntiva").val(),
                    odConjuntiva: $("#odConjuntiva").val(),
                    oiCornea: $("#oiCornea").val(),
                    odCornea: $("#odCornea").val(),
                    oiCamaraAnterior: $("#oiCamaraAnterior").val(),
                    odCamaraAnterior: $("#odCamaraAnterior").val(),
                    oiCristalino: $("#oiCristalino").val(),
                    odCristalino: $("#odCristalino").val(),
                    oiAplanatico: $("#oiAplanatico").val(),
                    odAplanatico: $("#odAplanatico").val(),
                    oiPIntraocular: $("#oiPIntraocular").val(),
                    odPIntraocular: $("#odPIntraocular").val(),
                    oiRelacionCopa: $("#oiRelacionCopa").val(),
                    odRelacionCopa: $("#odRelacionCopa").val(),
                    oiVasos: $("#oiVasos").val(),
                    odVasos: $("#odVasos").val(),
                    oiBordesNervio: $("#oiBordesNervio").val(),
                    odBordesNervio: $("#odBordesNervio").val(),
                    oiAnilloNeuroretinal: $("#oiAnilloNeuroretinal").val(),
                    odAnilloNeuroretinal: $("#odAnilloNeuroretinal").val(),
                    oiRetina: $("#oiRetina").val(),
                    odRetina: $("#odRetina").val(),
                    oiVasosRetinales: $("#oiVasosRetinales").val(),
                    odVasosRetinales: $("#odVasosRetinales").val(),
                    oiMacula: $("#oiMacula").val(),
                    odMacula: $("#odMacula").val(),
                    oiRetinaPeriferica: $("#oiRetinaPeriferica").val(),
                    odRetinaPeriferica: $("#odRetinaPeriferica").val()
                };

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los datos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'updExamOftalm.php',
                            type: 'POST',
                            data: { recibe: resulExamOftalm },
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.status === 'success') {
                                    Swal.fire(
                                        '¡Guardado!', res.message, 'success'
                                    ).then(event => {
                                        if (event.isConfirmed) {
                                            activeTab('Refraccion', 'ODEsferaLejos');
                                        }
                                    });
                                } else {
                                    Swal.fire(
                                        'Error', res.message, 'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al intentar actualizar datos del examen oftalmologico.', 'error'
                                );
                            }
                        });
                    }
                });
            });
            //Fin Guarda Edicion de examen oftalmologico
            ///////////////////////////////


            /////////////////////
            // Registra Indice de Refraccion
            $("#btnGuardaIndiceRefraccion").click(function() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;

                var indicerefraccionmatriz = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    docid: userid,
                    ODRefraccionLejos: $("#ODRefraccionLejos").val(),
                    OIRefraccionLejos: $("#OIRefraccionLejos").val(),
                    ODEsferaLejos: $("#ODEsferaLejos").val(),
                    OIEsferaLejos: $("#OIEsferaLejos").val(),
                    ODCilindroLejos: $("#ODCilindroLejos").val(),
                    OICilindroLejos: $("#OICilindroLejos").val(),
                    ODEjeLejos: $("#ODEjeLejos").val(),
                    OIEjeLejos: $("#OIEjeLejos").val(),
                    DIPLejos: $("#DIPLejos").val(),
                    PrismaLejos: $("#PrismaLejos").val(),
                    ODRefraccionCerca: $("#ODRefraccionCerca").val(),
                    OIRefraccionCerca: $("#OIRefraccionCerca").val(),
                    ODEsferaCerca: $("#ODEsferaCerca").val(),
                    OIEsferaCerca: $("#OIEsferaCerca").val(),
                    ODCilindroCerca: $("#ODCilindroCerca").val(),
                    OICilindroCerca: $("#OICilindroCerca").val(),
                    ODEjeCerca: $("#ODEjeCerca").val(),
                    OIEjeCerca: $("#OIEjeCerca").val(),
                    DIPCerca: $("#DIPCerca").val(),
                    PrismaCerca: $("#PrismaCerca").val(),

                    checkAstismatigmo: $("#checkAstismatigmo").prop('checked')?1:0,
                    checkHipermetropia: $("#checkHipermetropia").prop('checked')?1:0,
                    checkMiopia: $("#checkMiopia").prop('checked')?1:0,
                    checkPresbicia: $("#checkPresbicia").prop('checked')?1:0,
                    checkCristalBlanco: $("#checkCristalBlanco").prop('checked')?1:0,
                    checkCristalPhotogray: $("#checkCristalPhotogray").prop('checked')?1:0,
                    checkCristalPhotobrown: $("#checkCristalPhotobrown").prop('checked')?1:0,
                    checkResinaBlanco: $("#checkResinaBlanco").prop('checked')?1:0,
                    checkResinaProteccionUV: $("#checkResinaProteccionUV").prop('checked')?1:0,
                    checkResinaTransition: $("#checkResinaTransition").prop('checked')?1:0,
                    checkResinaFotomatic: $("#checkResinaFotomatic").prop('checked')?1:0,
                    checkResinaUltralite: $("#checkResinaUltralite").prop('checked')?1:0,
                    checkPolicarbonato: $("#checkPolicarbonato").prop('checked')?1:0,
                    checkAntireflex: $("#checkAntireflex").prop('checked')?1:0,
                    checkFiltroAzul: $("#checkFiltroAzul").prop('checked')?1:0,
                    checkPCETermico: $("#checkPCETermico").prop('checked')?1:0,
                    checkPCEDuraquarz: $("#checkPCEDuraquarz").prop('checked')?1:0,
                    checkResinaEndurecido: $("#checkResinaEndurecido").prop('checked')?1:0,
                    txtProcesosObservacion: $("#txtProcesosObservacion").val(),
                    checkAdicMasReducDiametro: $("#checkAdicMasReducDiametro").prop('checked')?1:0,
                    checkAdicMenAltoIndice: $("#checkAdicMenAltoIndice").prop('checked')?1:0,
                    checkBifocalFlaptop: $("#checkBifocalFlaptop").prop('checked')?1:0,
                    checkBifocalInvisible: $("#checkBifocalInvisible").prop('checked')?1:0,
                    checkMultifocalVisionLCI: $("#checkMultifocalVisionLCI").prop('checked')?1:0
                };
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los datos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'saveIndiceDeRefraccion.php',
                            type: 'POST',
                            data: { recibe: indicerefraccionmatriz },
                            success: function(response) {
                                Swal.fire(
                                    '¡Guardado!', 'Los datos se han guardado con éxito.', 'success'
                                ).then(event=>{
                                    if(event.isConfirmed){
                                        activeTab('Imagenes','')   
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al guardar los datos.', 'error'
                                );
                            }
                        });
                    }
                });

            });
            //Fin Indice de Refraccion
            /////////////////////



            /////////////////////
            // Guarda Edicion Indice de Refraccion
            $("#btnGuardaEdicionIndiceRefraccion").click(function() {
                const params=new URLSearchParams(window.location.search)
                const userid = <?php echo json_encode($userid); ?>;

                var indicerefraccionmatriz = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    docid: userid,
                    ODRefraccionLejos: $("#ODRefraccionLejos").val(),
                    OIRefraccionLejos: $("#OIRefraccionLejos").val(),
                    ODEsferaLejos: $("#ODEsferaLejos").val(),
                    OIEsferaLejos: $("#OIEsferaLejos").val(),
                    ODCilindroLejos: $("#ODCilindroLejos").val(),
                    OICilindroLejos: $("#OICilindroLejos").val(),
                    ODEjeLejos: $("#ODEjeLejos").val(),
                    OIEjeLejos: $("#OIEjeLejos").val(),
                    DIPLejos: $("#DIPLejos").val(),
                    PrismaLejos: $("#PrismaLejos").val(),
                    ODRefraccionCerca: $("#ODRefraccionCerca").val(),
                    OIRefraccionCerca: $("#OIRefraccionCerca").val(),
                    ODEsferaCerca: $("#ODEsferaCerca").val(),
                    OIEsferaCerca: $("#OIEsferaCerca").val(),
                    ODCilindroCerca: $("#ODCilindroCerca").val(),
                    OICilindroCerca: $("#OICilindroCerca").val(),
                    ODEjeCerca: $("#ODEjeCerca").val(),
                    OIEjeCerca: $("#OIEjeCerca").val(),
                    DIPCerca: $("#DIPCerca").val(),
                    PrismaCerca: $("#PrismaCerca").val(),

                    checkAstismatigmo: $("#checkAstismatigmo").prop('checked')?1:0,
                    checkHipermetropia: $("#checkHipermetropia").prop('checked')?1:0,
                    checkMiopia: $("#checkMiopia").prop('checked')?1:0,
                    checkPresbicia: $("#checkPresbicia").prop('checked')?1:0,
                    checkCristalBlanco: $("#checkCristalBlanco").prop('checked')?1:0,
                    checkCristalPhotogray: $("#checkCristalPhotogray").prop('checked')?1:0,
                    checkCristalPhotobrown: $("#checkCristalPhotobrown").prop('checked')?1:0,
                    checkResinaBlanco: $("#checkResinaBlanco").prop('checked')?1:0,
                    checkResinaProteccionUV: $("#checkResinaProteccionUV").prop('checked')?1:0,
                    checkResinaTransition: $("#checkResinaTransition").prop('checked')?1:0,
                    checkResinaFotomatic: $("#checkResinaFotomatic").prop('checked')?1:0,
                    checkResinaUltralite: $("#checkResinaUltralite").prop('checked')?1:0,
                    checkPolicarbonato: $("#checkPolicarbonato").prop('checked')?1:0,
                    checkAntireflex: $("#checkAntireflex").prop('checked')?1:0,
                    checkFiltroAzul: $("#checkFiltroAzul").prop('checked')?1:0,
                    checkPCETermico: $("#checkPCETermico").prop('checked')?1:0,
                    checkPCEDuraquarz: $("#checkPCEDuraquarz").prop('checked')?1:0,
                    checkResinaEndurecido: $("#checkResinaEndurecido").prop('checked')?1:0,
                    txtProcesosObservacion: $("#txtProcesosObservacion").val(),
                    checkAdicMasReducDiametro: $("#checkAdicMasReducDiametro").prop('checked')?1:0,
                    checkAdicMenAltoIndice: $("#checkAdicMenAltoIndice").prop('checked')?1:0,
                    checkBifocalFlaptop: $("#checkBifocalFlaptop").prop('checked')?1:0,
                    checkBifocalInvisible: $("#checkBifocalInvisible").prop('checked')?1:0,
                    checkMultifocalVisionLCI: $("#checkMultifocalVisionLCI").prop('checked')?1:0
                };
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los datos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'updIndiceDeRefraccion.php',
                            type: 'POST',
                            data: { recibe: indicerefraccionmatriz },
                            success: function(response) {
                                Swal.fire(
                                    '¡Guardado!', 'Los datos se han actualizado con éxito.', 'success'
                                ).then(event=>{
                                    if(event.isConfirmed){
                                        activeTab('Imagenes','btnGuardaImagenesEquiposPropios')   
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al intentar actualizar los datos de índice de refracción.', 'error'
                                );
                            }
                        });
                    }
                });
            });
            //Fin Guarda Edicion Indice de Refraccion
            /////////////////////


            //////////////////////
            //Registra Diagnostico
            $("#btnGuardaDiagnostico").click(function() {
                const params=new URLSearchParams(window.location.search)
                const userid = <?php echo json_encode($userid); ?>;
                var diagnostico = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    docid: userid,
                    DiagnosticoPaciente: $("#DiagnosticoPaciente").val()
                };
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar los datos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'saveDiagnosticoPaciente.php',
                            type: 'POST',
                            data: { recibe: diagnostico },
                            success: function(response) {
                                Swal.fire(
                                    '¡Guardado!', 'El diagnostico se ha guardado con éxito.', 'success'
                                ).then(event=>{
                                    if(event.isConfirmed){
                                        activeTab('eExterno','descTomografCoherencia')
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error("Ha ocurrido un error: " + error);
                                Swal.fire(
                                    'Error', 'Ha ocurrido un error al guardar el diagnostico.', 'error'
                                );
                            }
                        });
                    }
                });
            });
            //Fin Registra Diagnostico
            //////////////////////////


            ///////////////////////////////
            // Guarda Imagenes y Guarda en la DB
            $("#btnGuardaImagenesEquiposPropios").click(function() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                const pid = params.get("id");
                const docid = userid;
                const appoid = params.get("atention");

                var pasaNombresImagenesVP = {
                    appoid: appoid,
                    pid: pid,
                    docid: docid,
                    checkImgVolkPictor: [], // Inicializa el array
                    checkImgTopCon: [], // Inicializa el array
                    checkImgAutoKerato: [] // Inicializa el array
                };

                // Recorre los checkboxes marcados del grupo Volk Pictor
                $('input[name="checkImgVolkPictor[]"]:checked').each(function() {
                    const checkbox = $(this);
                    const nombreImagen = checkbox.val();
                    pasaNombresImagenesVP.checkImgVolkPictor.push(nombreImagen);
                });

                // Recorre los checkboxes marcados del grupo TopCon
                $('input[name="checkImgTopCon[]"]:checked').each(function() {
                    const checkbox = $(this);
                    const nombreImagen = checkbox.val();
                    pasaNombresImagenesVP.checkImgTopCon.push(nombreImagen);
                });

                // Recorre los checkboxes marcados del grupo Auto Kerato
                $('input[name="checkImgAutoKerato[]"]:checked').each(function() {
                    const checkbox = $(this);
                    const nombreImagen = checkbox.val();
                    pasaNombresImagenesVP.checkImgAutoKerato.push(nombreImagen);
                });
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar las imágenes?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "saveimagenesequipospropios.php",
                            type: "POST",
                            data: { sMotivoConsulta: pasaNombresImagenesVP },
                            success: function(response) {
                                fnc_bca_registros_img(pid, docid, appoid);
                                Swal.fire(
                                    '¡Guardado!',
                                    'Se registraron las imágenes de la lista con éxito.',
                                    'success'
                                ).then(event => {
                                    if(event.isConfirmed){
                                        activeTab('Diagnosticodr','DiagnosticoPaciente');
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    "Error",
                                    "Ha ocurrido un error al guardar las imágenes.",
                                    "error"
                                );
                            },
                        });
                    }
                });
            });
            // Fin Guarda Imagenes y registra en la DB
            ////////////////////////////

            ///////////////////////////////
            // Guarda Imagenes de examenes externos y Guarda en la DB
            function guarda_orden_para_examen_externo() {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                const pid = params.get("id");
                const docid = userid;
                const appoid = params.get("atention");

                var sDataExamExterno = {
                    appoid: appoid,
                    pid: pid,
                    docid: docid,
                    ordenExamExt: $("#descTomografCoherencia").val(),
                    nTpExamenExt: $("#nTpExamExterno").val()
                };

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas guardar la orden para este examen externo?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "saveexamenesexternos.php",
                            type: "POST",
                            data: { sDataExamExt: sDataExamExterno },
                            success: function(response) {
                                //fnc_bca_registros_img(pid, docid, appoid);
                                Swal.fire(
                                    '¡Guardado!',
                                    'Se registro la orden de examen externo con éxito.',
                                    'success'
                                )
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    "Error",
                                    "Ha ocurrido un error al intentar guardar el examen externo.",
                                    "error"
                                );
                            },
                        });
                    }
                });
            };
            // Fin Guarda Imagenes de examenes externos y registra en la DB
            ////////////////////////////

            /////////////////////////////////////////////
            ////// GENERANDO EL PDF /////
                $(document).ready(function() {
                    $('#sel1').change(function() {
                        var id = $("#sel1").val();
                        var appoid = $(this).val();
                        window.open("historiaclinica.php?id=" + id, "_blank");

                        /* $.ajax({
                            url: 'historiaclinica.php', // Archivo PHP que generará el PDF
                            type: 'POST',
                            data: { appoid: appoid }, // Envía el ID de la cita seleccionada
                            success: function(response) {
                                // Maneja la respuesta del servidor (por ejemplo, abre el PDF en una nueva ventana)
                                //window.open(response, '_blank');
                                window.open("historiaclinica.php?id=" + id, "_blank");
                                Swal.fire(
                                        "Archivo!",
                                        "Se se envio a generar el pdf.",
                                        "success"
                                    );
                            },
                            error: function(xhr, status, error) {
                                // Maneja los errores de la solicitud AJAX
                                console.error(error);
                            }
                        }); */
                        
                    });
                });
            /////////////////////////////////////////////

            //Ahora procedemos a imprimir
            $("#btnImpReceta").click(function(event) {
                // Obtener el valor del campo txtIdPatient
                var id = $("#txtIdPatient").val();

                // Enviar el valor de id al formulario
                //$.post("formato_indicaciones_medicas.php", { id: id });
                window.open("formato_indicaciones_medicas.php?id=" + id, "_blank");
            });

            function  activeTab(tabId,inputIdFocus=""){
                $('.bar_tabs a[href="#'+tabId+'"]').tab('show')
                if(inputIdFocus!=""){
                    $('.bar_tabs a[data-toggle="tab"]').on('shown.bs.tab', function (event) {
                        $('#'+inputIdFocus).focus()
                    })
                }
            }

            $(document).ready(function() {
                // Muestra el formulario hijo
                $("#visor").show();
            });

            
            document.addEventListener('DOMContentLoaded', function() {
                const decimalInputs = document.querySelectorAll('.decimal-input');
                const alphanumericInputs = document.querySelectorAll('.alphanumeric-input');

                ///////////// VALIDADOR DE TEXTOS NUMERICOS ///////////
                decimalInputs.forEach(input => {
                    // Evento 'input' para manejar cambios en el valor del input
                    input.addEventListener('input', function() {
                        const regex = /^-?\d{0,3}(\.\d{0,2})?$/;

                        // Validar el valor actual
                        if (!regex.test(this.value)) {
                            // Si el valor no cumple con el formato, corregirlo
                            const match = this.value.match(/^-?\d{0,3}(\.\d{0,2})?/);
                            this.value = match ? match[0] : '';
                            // Mostrar alerta si se intenta ingresar un valor no permitido
                            Swal.fire({
                                icon: 'warning',
                                title: 'Formato incorrecto',
                                text: 'Solo se permiten hasta 3 dígitos enteros y 2 dígitos decimales.',
                            });
                        }
                    });

                    // Evento 'keypress' para permitir solo números y el punto decimal
                    input.addEventListener('keypress', function(e) {
                        const value = this.value;
                        const char = e.key;
                        if (!/[\d.-]/.test(char)) {
                            e.preventDefault(); // Evitar la entrada de caracteres no permitidos
                            return;
                        }
                        // Evitar más de un signo negativo
                        if (char === '-' && value.includes('-')) {
                            e.preventDefault();
                            return;
                        }
                        // El signo negativo solo puede estar al principio
                        if (char === '-' && this.selectionStart !== 0) {
                            e.preventDefault();
                            return;
                        }
                        // Evitar más de un punto decimal
                        if (char === '.' && value.includes('.')) {
                            e.preventDefault();
                            return;
                        }
                        // Evitar más de tres dígitos enteros
                        if (/\d/.test(char) && value.replace(/-|\./g, '').length >= 3 && !value.includes('.')) {
                            e.preventDefault();
                            return;
                        }
                        // Verificar la longitud máxima después del punto decimal
                        const decimalPart = value.split('.')[1];
                        if (decimalPart && decimalPart.length >= 2) {
                            e.preventDefault();
                            return;
                        }
                    });

                    // Evento 'paste' para evitar pegar texto que no cumpla con el formato
                    input.addEventListener('paste', function(e) {
                        const paste = (e.clipboardData || window.clipboardData).getData('text');
                        const regex = /^-?\d{0,3}(\.\d{0,2})?$/;
                        if (!regex.test(paste)) {
                            e.preventDefault(); // Evitar el pegado de texto no permitido
                            // Mostrar alerta
                            Swal.fire({
                                icon: 'warning',
                                title: 'Formato incorrecto',
                                text: 'Solo se permiten hasta 3 dígitos enteros y 2 dígitos decimales.',
                            });
                        }
                    });
                });
                //////////// VALIDADOR DE TEXTOS NUMERICOS ////////////


                //////////// VALIDADOR DE TEXTOS ALFANUMERICOS ///////
                alphanumericInputs.forEach(input => {
                    const maxLength = parseInt(input.getAttribute('data-max-length'), 10);

                    // Evento 'input' para manejar cambios en el valor del input
                    input.addEventListener('input', function() {
                        // Permitir solo caracteres alfanuméricos y limitar a maxLength caracteres
                        const regex = /^[a-zA-Z0-9\s]*$/;
                        if (!regex.test(this.value) || this.value.length > maxLength) {
                            // Eliminar caracteres no permitidos y limitar la longitud
                            this.value = this.value.slice(0, maxLength).replace(/[^a-zA-Z0-9\s]/g, '');
                            // Mostrar alerta
                            Swal.fire({
                                icon: 'warning',
                                title: 'Límite excedido',
                                text: `Has superado el máximo de ${maxLength} caracteres permitidos.`,
                            });
                        }
                    });

                    // Evento 'keypress' para permitir solo caracteres alfanuméricos y espacios
                    input.addEventListener('keypress', function(e) {
                        if (!/[a-zA-Z0-9\s]/.test(e.key)) {
                            e.preventDefault(); // Evitar la entrada de caracteres no permitidos
                        }

                        // Verificar la longitud máxima
                        if (this.value.length >= maxLength) {
                            e.preventDefault(); // Evitar entrada si excede el límite
                            // Mostrar alerta
                            Swal.fire({
                                icon: 'warning',
                                title: 'Límite excedido',
                                text: `Has superado el máximo de ${maxLength} caracteres permitidos.`,
                            });
                        }
                    });

                    // Evento 'paste' para evitar pegar texto que no cumpla con el formato o que exceda los maxLength caracteres
                    input.addEventListener('paste', function(e) {
                        const paste = (e.clipboardData || window.clipboardData).getData('text');
                        const regex = /^[a-zA-Z0-9\s]*$/;
                        if (!regex.test(paste) || (this.value.length + paste.length > maxLength)) {
                            e.preventDefault(); // Evitar el pegado de texto no permitido o demasiado largo
                            // Mostrar alerta
                            Swal.fire({
                                icon: 'warning',
                                title: 'Límite excedido',
                                text: `Has superado el máximo de ${maxLength} caracteres permitidos.`,
                            });
                        } else {
                            // Si el texto pegado es válido, asegurarse de que no exceda los maxLength caracteres
                            this.value = (this.value + paste).slice(0, maxLength);
                            e.preventDefault();
                        }
                    });
                });
                //////////// VALIDADOR DE TEXTOS ALFANUMERICOS ///////


                /////////////////// Usando JavaScript puro con el evento load o cuando cargue la pagina inicialmente /////////////////////
                function checkAndEnableEditButton(idPaciente, idMedico, numAtencion, btnGuardar, btnEditar, condicion) {
                    $.ajax({
                        url: 'valida_registros_guardados.php',
                        type: 'POST',
                        data: {
                            idPaciente: idPaciente,
                            idMedico: idMedico,
                            numAtencion: numAtencion,
                            condicion: condicion
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.status === 'success') {
                                if (res.count > 0) {
                                    document.getElementById(btnGuardar).style.display = 'none';
                                    document.getElementById(btnEditar).style.display = 'block';
                                } else {
                                    document.getElementById(btnGuardar).style.display = 'block';
                                    document.getElementById(btnEditar).style.display = 'none';
                                }
                            } else {
                                document.getElementById(btnGuardar).style.display = 'block';
                                document.getElementById(btnEditar).style.display = 'none';
                                console.error("Error en la respuesta: " + res.message);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error inesperado',
                                    text: `Sucedió un error inesperado, vuelva a intentar con la comunicación al servidor. ${res.message}`,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error al verificar registros: " + error);
                        }
                    });
                }

                window.addEventListener('load', function() {
                    // Obtener los parámetros actuales de la URL
                    const params = new URLSearchParams(window.location.search);

                    // Obtener valores de los parámetros
                    const idPaciente = params.get('id'); // Id del paciente
                    const idMedico = <?php echo json_encode($userid); ?>; // Id del médico
                    const numAtencion = params.get('atention'); // Número de atención

                    // Ejecutar la función de verificación al cargar la página
                    checkAndEnableEditButton(idPaciente, idMedico, numAtencion, 'btnGuardaAntecedentes', 'btnGuardaEdicionAntecedentes', 'antecedentes');
                    checkAndEnableEditButton(idPaciente, idMedico, numAtencion, 'btnGuardaMotivoConsulta', 'btnGuardaEdicionMotivoConsulta', 'motivoconsulta');
                    checkAndEnableEditButton(idPaciente, idMedico, numAtencion, 'btnGuardaExamOftalm', 'btnGuardaEdicionExamOftalm', 'examoftalmologico');
                    checkAndEnableEditButton(idPaciente, idMedico, numAtencion, 'btnGuardaIndiceRefraccion', 'btnGuardaEdicionIndiceRefraccion', 'indicerefraccion');
                    checkAndEnableEditButton(idPaciente, idMedico, numAtencion, 'btnGuardaDiagnostico', 'btnGuardaEdicionDiagnostico', 'diagnostico');
                    
                    fnc_bca_registros_img(idPaciente, idMedico, numAtencion);
                });
                /////////////////// Usando JavaScript puro con el evento load o cuando cargue la pagina inicialmente /////////////////////
            });


            function fnc_bca_registros_img(idPaciente, idMedico, numAtencion){
                $.ajax({
                    url: 'bca_imagenes.php', // Reemplaza con la ruta a tu script PHP
                    type: 'POST',
                    data: {
                        idPaciente: idPaciente, // Reemplaza con el ID del paciente
                        idMedico: idMedico, // Reemplaza con el ID del médico
                        numAtencion: numAtencion // Reemplaza con el número de atención
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            //console.log('Registros encontrados:', response.data);
                            
                            // Resetear los valores y ocultar los elementos
                            $('#volkPictorBadge').text(0).hide();
                            $('#TopConBadge').text(0).hide();
                            $('#AutoKeratoBadge').text(0).hide();

                            response.data.forEach(item => {
                                if (item.examid == 5) {
                                    $('#volkPictorBadge').text(item.total);
                                    if (item.total > 0) {
                                        $('#volkPictorBadge').show();
                                    }
                                } else if (item.examid == 10) {
                                    $('#TopConBadge').text(item.total);
                                    if (item.total > 0) {
                                        $('#TopConBadge').show();
                                    }
                                } else if (item.examid == 11) {
                                    $('#AutoKeratoBadge').text(item.total);
                                    if (item.total > 0) {
                                        $('#AutoKeratoBadge').show();
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error inesperado',
                                text: `Sucedió un error inesperado, vuelva a intentar con la comunicación al servidor. ${response.message}`,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error inesperado',
                            text: `Sucedió un error inesperado, vuelva a intentar con la comunicación al servidor. ${error}`,
                        });
                    }
                });
            }

            ///////////// AVATAR volkPictorBadge
            document.getElementById('volkPictorBadge').addEventListener('click', function() {
                var modal = document.getElementById('id01');
                modal.style.display = 'block';
                fetchAvatars(5, 'avatarList');
            });

            ///////////// AVATAR volkTopConBadge
            document.getElementById('TopConBadge').addEventListener('click', function() {
                var modal = document.getElementById('id02');
                modal.style.display = 'block';
                fetchAvatars(10, 'avatarListTP');
            });
            
            ///////////// AVATAR volkAutoKeratoBadge
            document.getElementById('AutoKeratoBadge').addEventListener('click', function() {
                var modal = document.getElementById('id03');
                modal.style.display = 'block';
                fetchAvatars(11, 'avatarListAK');
            });

            function openCity(evt, cityName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("w3-light-grey");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.classList.add("w3-light-grey");
            }

            function fetchAvatars(exam_id, tpAvatar) {
                const params = new URLSearchParams(window.location.search);
                const userid = <?php echo json_encode($userid); ?>;
                const pid = params.get("id");
                const docid = userid;
                const appoid = params.get("atention");
                var pasaRequisitos = {
                    appoid: appoid,
                    pid: pid,
                    docid: docid,
                    exam_id: exam_id,
                    estado: 1
                };
                $.ajax({
                    url: "fetch_avatars.php",
                    type: "POST",
                    data: { sMotivoConsulta: pasaRequisitos },
                    dataType: "json",
                    success: function(response) {
                        //console.log(pasaRequisitos);
                        if (response.status === 'success') {
                            var avatarList = document.getElementById(tpAvatar);
                            avatarList.innerHTML = '';
                            response.data.forEach(function(avatar) {
                                var img = document.createElement('img');
                                img.src = avatar.urlfile;
                                //img.alt = avatar.nuevaimagen;
                                img.alt = avatar.nuevaimagen.split('/').pop().split('.').shift();
                                img.className = 'avatar';
                                img.onclick = function() {
                                    showImageModal(this.src, this.alt);
                                };
                                avatarList.appendChild(img);
                            });
                        } else {
                            Swal.fire(
                                "Error",
                                response.message,
                                "error"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            "Error",
                            "Ha ocurrido un error al cargar las imágenes.",
                            "error"
                        );
                    },
                });
            }

            function showImageModal(src, alt) {
                var modal = document.getElementById("imageModal");
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");

                modal.style.display = "block";
                modalImg.src = src;
                captionText.innerHTML = alt;

                var span = document.getElementsByClassName("close")[0];
                span.onclick = function() { 
                    modal.style.display = "none";
                }
            }

            window.onclick = function(event) {
                var modal = document.getElementById("imageModal");
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            ///////// FIN DEL AVATAR




            </script>
</body>
</html>

<?php
    function encrypt($data, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }
?>