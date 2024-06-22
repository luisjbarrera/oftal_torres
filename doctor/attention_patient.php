<?php
/*     session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }
 */    

    //import database
    include("../connection.php");
    /* if ($_GET) {
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
    } */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <!-- <link rel="stylesheet" href="../css/styles_tab.css"> -->
    <!-- <link rel="stylesheet" href="../css/styles_table_div.css"> -->

    <link rel="icon" type="image/png" sizes="16x16" href="../img/IconoCentroOftalmologicoTorres.ico">

    <title>Atenci&oacute;n</title>

            <!-- codigo incorporado de receta.html -->
                
                <!-- Font Awesome -->
                <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
                <!-- Switchery -->
                <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
                <!-- iCheck -->
                <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
                <!-- bootstrap-wysiwyg -->
                <!-- <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet"> -->
                <!-- Select2 -->
                <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
                <!-- starrr -->
                <!-- <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet"> -->
                <!-- NProgress -->
                <!--  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->

                <!-- Custom Theme Style -->
                <link href="../build/css/custom.min.css" rel="stylesheet">
  
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <meta charset="utf-8">
  

                <script src="script.js"></script>

                <style>
                    /* Estilos generales */
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }

                    /* Estilos para la tabla */
                    #medicinesTable {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    #medicinesTable th, #medicinesTable td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }

                    /* Estilos para formularios */
                    #searchForm {
                        margin-bottom: 20px;
                    }

                    #searchMedicine {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                    }


                    .container {
                        /* max-width: 600px; */ /* Ajusta esto según tus necesidades */
                        margin: auto;
                        padding: 20px;
                        /* background-color: #ffffff; */
                        border-radius: 8px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }

                    /* Estilos responsivos */
                    @media (max-width: 600px) {
                        #medicinesTable th, #medicinesTable td {
                            display: block;
                        }
                    }

                    /* Estilos adicionales para la lista de sugerencias */
                    #suggestions {
                        border: 1px solid #ddd;
                        border-top: none; /* Oculta el borde superior para que parezca parte del input */
                        list-style: none;
                        padding-left: 0;
                        margin-top: 0;
                        display: none; /* Inicia sin mostrar la lista */
                        position: absolute; /* Para que la lista se muestre sobre el contenido siguiente */
                        background-color: white;
                        width: calc(100% - 20px); /* Asume un padding en el input de 10px */
                        max-height: 300px; /* Puedes ajustar esto como lo veas necesario */
                        overflow-y: auto; /* Permite scroll si la lista es muy larga */
                        z-index: 1000; /* Asegura que la lista se muestre sobre otros elementos */
                    }
                    #suggestions li {
                        padding: 8px;
                        border-bottom: 1px solid #ddd;
                        cursor: pointer;
                    }
                    #suggestions li:hover {
                        background-color: #73aaf1;
                    }

                    /* Agregar tus estilos aquí */
                    .search-box {
                        position: relative;
                        /* display: inline-block; */
                        margin-bottom: 20px;
                    }

                    #searchMedicine {
                        width: 100%;
                        padding: 10px;
                        padding-right: 40px; /* Espacio para el botón 'X' */
                        border: 1px solid #ddd;
                        border-radius: 4px;
                    }

                    #clearSearch {
                    position: absolute;
                    right: 0px; /* Ajusta la posición derecha para que no sobresalga */
                    top:40%;
                    /* bottom: 0;*/
                    transform: translateY(-50%); /* Centrar verticalmente */
                    height: calc(100% - 0px); /* Ajusta la altura para que no sobresalga, resta los píxeles según el padding */
                    margin: auto;
                    padding: 0 0px;
                    border: none;
                    background-color: transparent;
                    cursor: pointer;
                    }

                    /* Estilos adicionales para el botón, si es necesario */
                    #clearSearch:hover {
                        background-color: rgba(255, 255, 255, 0.5); /* Blanco con 50% de transparencia */
                    }

                    .input-group {
                        margin-bottom: 15px;
                    }

                    .input-group label {
                        display: block;
                        margin-bottom: 5px;
                    }

                    .input-group input,
                    .input-group textarea {
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                    }

                    #btnAddToList {
                        margin-bottom: 20px;
                        padding: 10px 20px;
                        background-color: #5cb85c;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                    }

                    #btnAddToList:hover {
                        background-color: #4cae4c;
                    }

                    #medicinesList {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    #medicinesList thead {
                        background-color: #f1f1f1;
                    }

                    #medicinesList th,
                    #medicinesList td {
                        padding: 10px;
                        border: 1px solid #ddd;
                    }

                    #suggestions {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        right: 0;
                        z-index: 1000;
                        background-color: #ffffff;
                        border: 1px solid #ddd;
                        border-top: none;
                        list-style-type: none;
                        padding: 0;
                        margin: 0;
                        display: none; /* Ocultar hasta que haya sugerencias */
                    }

                    #suggestions li {
                        padding: 10px;
                        cursor: pointer;
                    }

                    #suggestions li:hover {
                        background-color: #efefef;
                    }
                </style>
            <!-- Fin codigo incorporado de receta.html -->

                <style>
                    .dashbord-tables {
                        animation: transitionIn-Y-over 0.5s;
                    }

                    .filter-container {
                        animation: transitionIn-X 0.5s;
                    }

                    .sub-table {
                        animation: transitionIn-Y-bottom 0.5s;
                    }
                </style>
</head>

<body>
    <?php
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];
    //echo $userid;
    //echo $username;

        //Extrayendo datos del paciente para ser mostrados en el titulo
        $patient = $database->query("select pname, pDNI, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS edad, ptel FROM patient where pid=$id");
        $userfetch = $patient->fetch_assoc();
        $PatientNombre = $userfetch["pname"];
        $PatientDNI = $userfetch["pDNI"];
        $PatientEdad = $userfetch["edad"];
        $PatientCelular = $userfetch["ptel"];

    ?>
    <div class="container">
        <div class="menu">
            <div style="padding:10px;">
                <div style="display:flex; align-items:center;">
                    <div style="padding-left:20px;">
                        <img src="../img/CentroOftalmologicoTorresIII.png" alt="" width="100%" style="border-radius:50%">
                    </div>
                    <div style="padding:0px; margin:0px;">
                        <p class="profile-title"><?php echo 'Doctor';  ?></p>
                        <p class="profile-subtitle"><?php echo substr($username, 0, 13);  ?></p>
                    </div>
                </div>
                <div style="text-align:right;">
                    <a href="../logout.php"><input type="button" value="Cerrar Sesión" class="logout-btn btn-primary-soft btn"></a>
                </div>
            </div>
            <div class="menu-row">
                <div class="menu-btn menu-icon-dashbord">
                    <a href="index.php" class="non-style-link-menu">
                        <div><p class="menu-text">Inicio</p></div>
                    </a>
                </div>
            </div>
            <div class="menu-row">
                <div class="menu-btn menu-icon-appoinment">
                    <a href="appointment.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Mis Citas</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="menu-row">
                <div class="menu-btn menu-icon-session">
                    <a href="schedule.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Mi Programación</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="menu-row">
                <div class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
                    <a href="patient.php" class="non-style-link-menu non-style-link-menu-active">
                        <div>
                            <p class="menu-text">Mis Pacientes</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="menu-row">
                <div class="menu-btn menu-icon-settings">
                    <a href="settings.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Configuración</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- Div Body -->
        <div class="dash-body" style="margin-top: 15px">
            <table style=" border-spacing: 0;margin:0;padding:0;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center;">
                        <label for="btnVerHistorial" style="font-size: 23px; font-weight: 600; margin-right: 20px;">Atenci&oacute;n del paciente</label>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalHistoriaClinica">Historia cl&iacute;nica</button>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <div style="text-align: right;">
                            <p style="font-size: 14px; color: rgb(119, 119, 119); margin: 0;">Fecha</p>
                            <p class="heading-sub12" style="margin: 0;">
                                <?php
                                date_default_timezone_set('America/Bogota');
                                $today = date('Y-m-d');
                                echo $today;
                                $patientrow = $database->query("select * from patient;");
                                $doctorrow = $database->query("select * from doctor;");
                                $appointmentrow = $database->query("select * from appointment where appodate>='$today';");
                                $schedulerow = $database->query("select * from schedule where scheduledate='$today';");
                                ?>
                            </p>
                        </div>
                        <div style="width: 10%; text-align: center;">
                            <button class="btn-label" style="display: flex; justify-content: center; align-items: center;">
                                <img src="../img/calendar.svg" alt="Calendario">
                            </button>
                        </div>
                    </div>
                </div>



                <div id="grupoPestanhas" style="display: block;">
                    <div colspan="4">
                        
                                <table>
                                    <tr>
                                        <td>
                                            <div style="font-size: 16px">
                                                <?php
                                                    //echo '<h6><div class="h-auto bg-warning">Paciente: '.$PatientNombre.', DNI N&deg;:'.$PatientDNI.', con '.$PatientEdad.' años y N&deg; Celular: '.$PatientCelular.'</div></h6>';
                                                    echo '<span class="badge bg-success rounded-pill">
                                                        <strong>Paciente:</strong> '.$PatientNombre.', <strong>DNI N&deg;:<strong>'.$PatientDNI.', con '.$PatientEdad.' años y <strong>N&deg; Celular:<strong> '.$PatientCelular.'
                                                        </span>';
                                                    
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="">
                                                <div class="col-md-12 col-sm-12  ">
                                                    <div class="x_panel">
                                                        <div class="x_title">
                                                            <h2><i class="fa fa-user-md"></i><small> Registrar atenci&oacute;n</small></h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <ul class="nav nav-pills" id="myTab">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="Antecedentes-tab" data-bs-toggle="pill" href="#Antecedentes" role="tab" aria-controls="Antecedentes" aria-selected="true"><small>Antecedentes</small></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="Consulta-tab" data-bs-toggle="pill" href="#Consulta" role="tab" aria-controls="Consulta" aria-selected="false"><small>Consulta</small></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="eOftalmologico-tab" data-bs-toggle="pill" href="#eOftalmologico" role="tab" aria-controls="eOftalmologico" aria-selected="false"><small>E-Oftalmol&oacute;g.</small></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="Refraccion-tab" data-bs-toggle="pill" href="#Refraccion" role="tab" aria-controls="Refraccion" aria-selected="false"><small>Refracci&oacute;n</small></a>
                                                                </li>
                                                                <li>
                                                                    <a class="nav-link" id="Imagenes-tab" data-bs-toggle="pill" href="#Imagenes" role="tab" aria-controls="Imagenes" aria-selected="false"><small>Im&aacute;genes</small></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="diagnostico-tab" data-bs-toggle="pill" href="#diagnostico" role="tab" aria-controls="diagnostico" aria-selected="false"><small>Diagn&oacute;stico</small></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="eExterno-tab" data-bs-toggle="pill" href="#eExterno" role="tab" aria-controls="eExterno" aria-selected="false"><small>E-Externo</small></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="Receta-tab" data-bs-toggle="pill" href="#Receta" role="tab" aria-controls="Receta" aria-selected="false"><small>Receta</small></a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane container active" id="Antecedentes" role="tabpanel" aria-labelledby="Antecedentes-tab">
                                                                    <div class="col-md-12 ">
                                                                        <div class="x_panel">
                                                                            <div class="x_title">
                                                                                <h4><small>Antecedentes</small></h4>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="x_content">
                                                                                <form class="form-horizontal form-label-left">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-4 col-sm-4 ">
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkDM" class="js-switch" /> DM
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkHTA" class="js-switch" /> HTA
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkalergias" class="js-switch" /> Alergias
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checksinOjoSeco" class="js-switch" /> Sin ojo seco
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkglaucoma" class="js-switch" /> Glaucoma
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkaltRetinales" class="js-switch" /> Alt. Retinales
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-4">
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checktraumaOcular" class="js-switch" /> Trauna ocular
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkqxOcularPrevia" class="js-switch" /> QX Ocular Previa
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkusaLC" class="js-switch" /> Usa LC tipo/tiempo
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkcolgenopatias" class="js-switch" /> Cologenopatias
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <label>
                                                                                                    <input type="checkbox" id="checkmedTopicos" class="js-switch" /> Med topicos que usa
                                                                                                </label>
                                                                                            </div>
                                                                                            <div>
                                                                                                <button type="button" id="btnGuardaAntecedentes" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Guardar</button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-4 ">
                                                                                            <label class="control-label col-md-12 col-sm-12 ">Descripci&oacute;n</label></br>
                                                                                            <div class="ln_solid"></div>
                                                                                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                                                                                <textarea id="descripcionatencion" style="height: 120px;" required="required" class="form-control" name="descripcionatencion" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="300" data-parsley-minlength-message="Debes ingresar un comentario de al menos 20 caracteres." data-parsley-validation-threshold="10" class="resizable_textarea form-control"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Fin Registra Atención-->
                                                                </div>

                                                                <!-- REGISTAR MOTIVO DE LA CONSULTA -->
                                                                <div class="tab-pane container fade" id="Consulta" role="tabpanel" aria-labelledby="Consulta-tab">
                                                                    <div class="col-md-12 ">
                                                                        <div class="x_panel">
                                                                            <div class="x_title">
                                                                                <h4><small>Registrar motivo de la consulta</small></h4>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="x_content">
                                                                                <br />
                                                                                <form class="form-horizontal form-label-left">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-12 col-sm-12 ">
                                                                                            <div class="col-md-9 col-sm-12  form-group has-feedback">
                                                                                                <textarea id="motivoconsulta"  style="height: 150px;" required="required" class="form-control txtmotivoconsulta" name="motivoconsulta" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="500" data-parsley-minlength-message="Debes ingresar un comentario de al menos 20 caracteres." data-parsley-validation-threshold="10" class="resizable_textarea form-control"></textarea>
                                                                                            </div>
                                                                                            <div class="col-md-3 col-sm-12 from-group has-feedback">
                                                                                            <button type="button" id="btnGuardaMotivoConsulta" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Guardar</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- FIN REGISTAR MOTIVO DE LA CONSULTA -->

                                                                <!-- EXAMEN OFTALMOLOGICO -->
                                                                <div class="tab-pane container fade" id="eOftalmologico" role="tabpanel" aria-labelledby="eOftalmologico-tab">
                                                                    <table class="default">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="seccion" colspan="7">Agudeza visual</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Vasos retinales</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiSinCorrector" name="oiSinCorrector" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odSinCorrector" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td colspan="3" rowspan="3">
                                                                                    <div style="display: flex; justify-content: center;">
                                                                                        <h3 style="text-decoration: underline;">Examen Oftalmol&oacute;gico</h3>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                            <td class="col-form-label label-align" for="first-name">Con correctores</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiConCorrector" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odConCorrector" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                            <td class="col-form-label label-align" for="first-name">Agujero esteroperco</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiAgujeroSteropertico" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odAgujeroSteropertico" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Biomicroscop&iacute;a</th>
                                                                            </tr>
                                                                            <tr>
                                                                            <td class="col-form-label label-align" for="first-name">P&aacute;rpados</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiParpados" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odParpados" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td class="col-form-label label-align" for="first-name">V&iacute;a lagrimal</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiViaLagrimal" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odViaLagrimal" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Conjuntiva</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiConjuntiva" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odConjuntiva" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td class="col-form-label label-align" for="first-name">C&oacute;rnea</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiCornea" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odCornea" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">C&aacute;mara anterior</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiCamaraAnterior" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odCamaraAnterior" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td class="col-form-label label-align" for="first-name">Cristalino</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiCristalino" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odCristalino" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Tonometr&iacute;a</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Aplan&aacute;tico</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiAplanatico" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odAplanatico" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td colspan="3" rowspan="2">
                                                                                    <div style="display: flex; justify-content: center;">
                                                                                        <button type="button" id="btnGuardaExamOftalm" class="btn btn-success pull-right">
                                                                                            <i class="fa fa-save"></i> Guardar
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Presi&oacute;n intraocular corregida</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiPIntraocular" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odPIntraocular" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Fondo de ojo</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Relación Copa/Disco</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiRelacionCopa" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odRelacionCopa" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td class="col-form-label label-align" for="first-name">Vasos</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiVasos" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odVasos" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Bordes del nervio &oacute;ptico</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiBordesNervio" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odBordesNervio" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td class="col-form-label label-align" for="first-name">Anillo neuroretinal</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiAnilloNeuroretinal" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odAnilloNeuroretinal" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Retina</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiRetina" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odRetina" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td colspan="3"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="7">Retina</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Vasos retinales</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiVasosRetinales" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odVasosRetinales" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                                <td colspan="3" rowspan="3">
                                                                                    <div style="display: flex; justify-content: center;">
                                                                                        
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">M&aacute;cula</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiMacula" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odMacula" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-form-label label-align" for="first-name">Retina perif&eacute;rica</td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control has-feedback-left" id="oiRetinaPeriferica" placeholder="OI">
                                                                                    <span class="fa fa-eye form-control-feedback left" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td class="col-md-6 col-sm-6 form-group has-feedback">
                                                                                    <input type="text" class="form-control text-center" id="odRetinaPeriferica" placeholder="OD">
                                                                                    <span class="fa fa-eye form-control-feedback right" aria-hidden="true"></span>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- FIN EXAMEN OFTALMOLOGICO -->
                                                                
                                                                <!-- INDICE DE REFRACCION -->
                                                                <div class="tab-pane container fade" id="Refraccion" role="tabpanel" aria-labelledby="Refraccion-tab">
                                                                    <div class="x_panel">
                                                                        <div class="x_title">
                                                                            <h4>&Iacute;ndice de refracci&oacute;n</h4>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group text-right">
                                                                                    <label for="ODRefraccion">Refracci&oacute;n</label>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group text-center">
                                                                                    <label for="ODRefraccion">Esfera</label>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group text-center">
                                                                                    <label for="ODRefraccion">Cilindro</label>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group text-center">
                                                                                    <label for="ODRefraccion">Eje</label>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group text-center">
                                                                                    <label for="ODRefraccion">D.I.P.</label>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group text-center">
                                                                                    <label for="ODRefraccion">Prisma</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-1 col-sm-12  form-group text-right">
                                                                                    <small class="text-navy">Lejos</small>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12 form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="ODRefraccionLejos" placeholder="OD">
                                                                                    <input type="text"class="form-control form-control-sm" id="OIRefraccionLejos" placeholder="OI">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="ODEsferaLejos" placeholder="OD" class="form-control">
                                                                                    <input type="text"class="form-control form-control-sm" id="OIEsferaLejos" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="ODCilindroLejos" placeholder="OD" class="form-control">
                                                                                    <input type="text"class="form-control form-control-sm" id="OICilindroLejos" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="ODEjeLejos" placeholder="OD" class="form-control">
                                                                                    <input type="text"class="form-control form-control-sm" id="OIEjeLejos" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="DIPLejos" placeholder="0.00" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="PrismaLejos" placeholder="0.00" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-1 col-sm-12  form-group text-right">
                                                                                    <small class="text-navy">Cerca</small>
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text"class="form-control form-control-sm" id="ODRefraccionCerca" placeholder="OD" class="form-control">
                                                                                    <input type="text"class="form-control form-control-sm" id="OIRefraccionCerca" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text" class="form-control form-control-sm" id="ODEsferaCerca" placeholder="OD" class="form-control">
                                                                                    <input type="text" class="form-control form-control-sm" id="OIEsferaCerca" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text" class="form-control form-control-sm" id="ODCilindroCerca" placeholder="OD" class="form-control">
                                                                                    <input type="text" class="form-control form-control-sm" id="OICilindroCerca" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text" class="form-control form-control-sm" id="ODEjeCerca" placeholder="OD" class="form-control">
                                                                                    <input type="text" class="form-control form-control-sm" id="OIEjeCerca" placeholder="OI" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text" class="form-control form-control-sm" id="DIPCerca" placeholder="0.00" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-1 col-sm-12  form-group">
                                                                                    <input type="text" class="form-control form-control-sm" id="PrismaCerca" placeholder="0.00" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                    DIAGNOSTICO  
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkAstismatigmo" class="js-switch" />  <span style="font-size: 14px;">Astigmatismo</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkHipermetropia" class="js-switch" />  <span style="font-size: 14px;">Hipermetropia</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkMiopia" class="js-switch" /> <span style="font-size: 14px;">Miopia</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkPresbicia" class="js-switch" />  <span style="font-size: 14px;">Presbicia</span>
                                                                                    </label>    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                    CRISTAL  
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkCristalBlanco" class="js-switch" />  <span style="font-size: 14px;">Blanco</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkCristalPhotogray" class="js-switch" />  <span style="font-size: 14px;">Photogray</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkCristalPhotobrown" class="js-switch" />  <span style="font-size: 14px;">Photobrown</span>
                                                                                    </label>    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                    RESINA  
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkResinaBlanco" class="js-switch" /> <span style="font-size: 14px;">Blanco</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkResinaProteccionUV" class="js-switch" /> <span style="font-size: 14px;">Protecci&oacute;n UV</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkResinaTransition" class="js-switch" /> <span style="font-size: 14px;">Transition</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkResinaFotomatic" class="js-switch" /> <span style="font-size: 14px;">Fotomatic</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkResinaUltralite" class="js-switch" /> <span style="font-size: 14px;">Ultralite</span>
                                                                                    </label>    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkPolicarbonato" class="js-switch" /> <span style="font-size: 14px;">Policarbonato</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkAntireflex" class="js-switch" /> <span style="font-size: 14px;">Antireflex</span>
                                                                                    </label>    
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkFiltroAzul" class="js-switch" /> <span style="font-size: 14px;">Filtro Azul</span>
                                                                                    </label>    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div>
                                                                                    <div class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                        PROCESOS
                                                                                    </div>
                                                                                    <div aria-rowspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                        
                                                                                        <div style="font-weight: bold;">
                                                                                            CRISTAL ENDURECIDO:
                                                                                        </div>
                                                                                        <div style="font-weight: bold;">
                                                                                            RESINA:
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-12  form-group">
                                                                                        <div>
                                                                                            <label>
                                                                                                <input type="checkbox" id="checkPCETermico" class="js-switch" /> <span style="font-size: 14px;">T&eacute;mico</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <label>
                                                                                                <input type="checkbox" id="checkPCEDuraquarz" class="js-switch" /> <span style="font-size: 14px;">Duraquarz</span>
                                                                                            </label>   
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-12  form-group">
                                                                                            <label>
                                                                                                <input type="checkbox" id="checkResinaEndurecido" class="js-switch" /> <span style="font-size: 14px;">Endurecido</span>
                                                                                            </label>
                                                                                    </div>
                                                                                    <div aria-colspan="2" aria-rowspan="2" class="col-md-2 col-sm-12  form-group">
                                                                                        <label for="txtObservaProceso">Observaci&oacute;n</label>
                                                                                        <textarea name="txtObservaProceso" id="txtProcesosObservacion" class="form-control form-control-sm" cols="8" rows="2"></textarea>   
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                    ADICIONALES:  
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    Lentes (+):
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkAdicMasReducDiametro" class="js-switch" /> <span style="font-size: 14px;">Reducci&oacute;n de di&aacute;metro</span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    Lentes (-):  
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-12  form-group">
                                                                                    <label>
                                                                                    <input type="checkbox" id="checkAdicMenAltoIndice" class="js-switch" /> <span style="font-size: 14px;">Alto &iacute;ndice</span>
                                                                                    </label>    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div aria-colspan="2" class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                    BIFOCAL:  
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkBifocalFlaptop" class="js-switch" /> <span style="font-size: 14px;">Flaptop</span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-12  form-group">
                                                                                    <label>
                                                                                        <input type="checkbox" id="checkBifocalInvisible" class="js-switch" /> <span style="font-size: 14px;">Invisible</span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-2 col-sm-12  form-group" style="font-weight: bold;">
                                                                                    MULTIFOCAL:  
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-12  form-group">
                                                                                    <label>
                                                                                    <input type="checkbox" id="checkMultifocalVisionLCI" class="js-switch" /> <span style="font-size: 14px;">Visi&oacute;n de lejos, cerca, intermedia</span>
                                                                                    </label>    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <button type="button" id="btnGuardaIndiceRefraccion" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Guardar</button>
                                                                                <button type="button" id="btnGuardaImprimeIndiceRefraccion" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Guardar e imprimir</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- FIN INDICE DE REFRACCION -->


                                                                <!-- CARGA DE IMAGENES  -->
                                                                <div class="tab-pane container fade" id="Imagenes" role="tabpanel" aria-labelledby="Imagenes-tab">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <div class="x_panel">
                                                                            <!-- Volk Pictor page content -->
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <div class="x_panel">
                                                                                    <div class="x_title">
                                                                                        <h2>Volk Pictor</h2>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                    <div class="x_content">
                                                                                    <?php
                                                                                        $from = './tomas/volkpictor/';
                                                                                        $to = './tomas';
                                                                                        $imageNamesVolkPictor = [];// Creamos un arreglo para almacenar las imágenes

                                                                                        // Recorremos el directorio de imágenes
                                                                                        foreach (scandir($from) as $file) {
                                                                                                /* // Validar tamaño
                                                                                                if ($_FILES["imagen"]["size"] > 500000) {
                                                                                                    echo "El archivo es demasiado grande.";
                                                                                                    exit;
                                                                                                }
                                                                                                // Validar tipo
                                                                                                $allowedTypes = array("image/jpeg", "image/png", "image/gif");
                                                                                                if (!in_array($_FILES["imagen"]["type"], $allowedTypes)) {
                                                                                                    echo "El tipo de archivo no es válido.";
                                                                                                    exit;
                                                                                                }
                                                                                                // Validar extensión
                                                                                                $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
                                                                                                if (!in_array($extension, array("jpg", "png", "gif"))) {
                                                                                                    echo "La extensión del archivo no es válida.";
                                                                                                    exit;
                                                                                                } */
                                                                                            // Si el archivo es una imagen, lo cargamos
                                                                                            if (is_file($from . '/' . $file) && exif_imagetype($from . '/' . $file)) {
                                                                                                $fromVolkPictor = opendir($from);
                                                                                                $imageNameVolkPictor=pathinfo($file,PATHINFO_FILENAME);
                                                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);// Obtenemos la extensión de la imagen
                                                                                                $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
                                                                                                $sNameOriginalImages = $imageNameVolkPictor.'.'.$extension;
                                                                                                $sRutaOrigenVolkPictor = $from.$file;
                                                                                                $sRutaDestinoVolkPictor = $to.'/';
                                                                                                $sNewNameImages = $sNameFileEnc.$file;
                                                                                                
                                                                                                ?>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="thumbnail">
                                                                                                                <div class="image view view-first">
                                                                                                                    <img class="img-fluid" style="width: 100%; display: block;" src="./tomas/volkpictor/<?php echo $imageNameVolkPictor.".".$extension; ?>" alt="image"/>                                                                                                                                    
                                                                                                                    <div class="mask">
                                                                                                                        <p><?php echo $imageNameVolkPictor; ?></p>
                                                                                                                        <div class="tools tools-bottom">
                                                                                                                        <a href="visor.php?TZS2C=<?php echo $i; ?>&TtS2c=<?php echo $f; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a>
                                                                                                                            <a href="#"><i class="fa fa-eye-slash"></i></a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="caption">
                                                                                                                    <label>
                                                                                                                        <input type="checkbox" id="checkImgVolkPictor<?php echo $imageNameVolkPictor; ?>" name="checkImgVolkPictor[]" value="<?php echo $from.$sNameOriginalImages.'|'. $to.'/'.$sNewNameImages.'|5'; ?>" class="js-switch" checked /> <strong> <?php echo $imageNameVolkPictor.".".$extension; ?></strong>
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /Volk Pictor page content -->

                                                                            <!-- TopCon DC-3 page content -->
                                                                            <div class="col-md-4 col-sm-12">
                                                                                <div class="x_panel">
                                                                                    <div class="x_title">
                                                                                        <h2>TopCon DC-3</h2>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                    <div class="x_content">
                                                                                        <?php
                                                                                            $fromTopCon = './tomas/topcon/';
                                                                                            $toTopCon = './tomas';
                                                                                            //$imageNamesTopCon = [];// Creamos un arreglo para almacenar las imágenes
                                                                                            unset($file);
                                                                                            // Recorremos el directorio de imágenes
                                                                                            foreach (scandir($fromTopCon) as $file) {
                                                                                                
                                                                                                $arryImg[]= $file;
                                                                                                // Si el archivo es una imagen, lo cargamos
                                                                                                if (is_file($fromTopCon . '/' . $file) && exif_imagetype($fromTopCon . '/' . $file)) {
                                                                                                    $fromTopC = opendir($fromTopCon);
                                                                                                    $imageNameTopCon = pathinfo($file,PATHINFO_FILENAME);
                                                                                                    $extensionTopCon = pathinfo($file, PATHINFO_EXTENSION);// Obtenemos la extensión de la imagen
                                                                                                    $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
                                                                                                    $sNameOriginalImagesTopCon = $imageNameTopCon.'.'.$extensionTopCon;
                                                                                                    $sRutaOrigenTopCon = $fromTopC.$file;
                                                                                                    $sRutaDestinoTopCon = $toTopCon.'/';
                                                                                                    $sNewNameImagesTopCon = $sNameFileEnc.$file;
                                                                                                        //echo $nX.' '.$sNameOriginalImagesTopCon;
                                                                                                    ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="thumbnail">
                                                                                                                    <div class="image view view-first">
                                                                                                                        <img class="img-fluid" style="width: 100%; display: block;" src="./tomas/topcon/<?php echo $sNameOriginalImagesTopCon; ?>" alt="image"/>
                                                                                                                        <div class="mask">
                                                                                                                            <p><?php echo $sNameOriginalImagesTopCon; ?></p>
                                                                                                                            <div class="tools tools-bottom">
                                                                                                                            <a href="visor.php?TZS2C=<?php echo $i; ?>&TtS2c=<?php echo $f; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a>
                                                                                                                                <a href="#"><i class="fa fa-eye-slash"></i></a>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="caption">
                                                                                                                        <label>
                                                                                                                            <!-- <input type="checkbox" id="checktraumaOcular" class="js-switch" checked /> <strong> <?php //echo $imageName.".".$extension; ?></strong> -->
                                                                                                                            <input type="checkbox" id="checkImgTopCon<?php echo $sNameOriginalImagesTopCon; ?>" name="checkImgTopCon[]" value="<?php echo $fromTopCon.$sNameOriginalImagesTopCon.'|'. $toTopCon.'/'.$sNewNameImagesTopCon.'|10'; ?>" class="js-switch" checked /> <strong> <?php echo $sNameOriginalImagesTopCon; ?></strong>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /TopCon DC-3 page content -->


                                                                            <!-- Auto Kerato page content -->
                                                                            <div class="col-md-4 col-sm-12">
                                                                                            <div class="x_panel">
                                                                                                <div class="x_title">
                                                                                                    <h2>Auto Kerato</h2>
                                                                                                    <div class="clearfix"></div>
                                                                                                </div>
                                                                                                <div class="x_content">
                                                                                                    <?php
                                                                                                        $fromAutoKerato = './tomas/autokerato/';
                                                                                                        $toAutoKerato = './tomas';
                                                                                                        unset($file);
                                                                                                        // Recorremos el directorio de imágenes
                                                                                                        foreach (scandir($fromAutoKerato) as $file) {                                                                                                                
                                                                                                            $arryImg[]= $file;
                                                                                                            // Si el archivo es una imagen, lo cargamos
                                                                                                            if (is_file($fromAutoKerato . '/' . $file) && exif_imagetype($fromAutoKerato . '/' . $file)) {
                                                                                                                $fromAK = opendir($fromAutoKerato);
                                                                                                                $imageNameAutoKerato = pathinfo($file,PATHINFO_FILENAME);
                                                                                                                $extensionAutoKerato = pathinfo($file, PATHINFO_EXTENSION);// Obtenemos la extensión de la imagen
                                                                                                                $sNameFileEnc=date('Y').date('m').date('d').date('h').date('m').date('s').rand(10,39);
                                                                                                                $sNameOriginalImagesAutoKerato = $imageNameAutoKerato.'.'.$extensionAutoKerato;
                                                                                                                $sRutaOrigenAutoKerato = $fromAK.$file;
                                                                                                                $sRutaDestinoAutoKerato = $toAutoKerato.'/';
                                                                                                                $sNewNameImagesAutoKerato = $sNameFileEnc.$file;
                                                                                                                ?>
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-md-12">
                                                                                                                            <div class="thumbnail">
                                                                                                                                <div class="image view view-first">
                                                                                                                                    <img class="img-fluid" style="width: 100%; display: block;" src="./tomas/autokerato/<?php echo $sNameOriginalImagesAutoKerato; ?>" alt="image"/>
                                                                                                                                    <div class="mask">
                                                                                                                                        <p><?php echo $sNameOriginalImagesAutoKerato; ?></p>
                                                                                                                                        <div class="tools tools-bottom">
                                                                                                                                        <a href="visor.php?TZS2C=<?php echo $i; ?>&TtS2c=<?php echo $f; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a>
                                                                                                                                            <a href="#"><i class="fa fa-eye-slash"></i></a>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="caption">
                                                                                                                                    <label>
                                                                                                                                        <input type="checkbox" id="checkImgTopCon<?php echo $sNameOriginalImagesAutoKerato; ?>" name="checkImgAutoKerato[]" value="<?php echo $fromAutoKerato.$sNameOriginalImagesAutoKerato.'|'. $toAutoKerato.'/'.$sNewNameImagesAutoKerato.'|11'; ?>" class="js-switch" checked /> <strong> <?php echo $sNameOriginalImagesAutoKerato; ?></strong>
                                                                                                                                    </label>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                <?php
                                                                                                            }
                                                                                                        }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        

                                                                                        <div class="row" style="display: flex; justify-content: center;">
                                                                                            <button type="button" id="btnGuardaImagenesEquiposPropios" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Guardar</button>
                                                                                        </div>
                                                                            </div>
                                                                            <!-- /Auto Kerato page content -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- FIN CARGA DE IMAGENES -->

                                                                <!-- Inicia Registro de diagnostico -->
                                                                <div class="tab-pane container fade" id="diagnostico" role="tabpanel" aria-labelledby="diagnostico-tab">
                                                                    <div class="col-md-12 ">
                                                                        <div class="x_panel">
                                                                            <div class="x_title">
                                                                                <h2><small>Registrar diagn&oacute;stico</small></h2>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="x_content">
                                                                                <br />
                                                                                <form class="form-horizontal form-label-left">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-12 col-sm-12 ">
                                                                                            <div class="col-md-10 col-sm-12  form-group has-feedback">
                                                                                                <textarea id="DiagnosticoPaciente" style="height: 150px;" required="required" class="form-control" name="diagnostico" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="500" data-parsley-minlength-message="Debes ingresar un comentario de al menos 20 caracteres." data-parsley-validation-threshold="10" class="resizable_textarea form-control"></textarea>
                                                                                            </div>
                                                                                            <div class="row" style="display: flex; justify-content: center;">
                                                                                                <button type="button" id="btnGuardaDiagnostico" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Guardar</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- Fin diagnostico -->

                                                                <!-- Examenes externos -->
                                                                <div class="tab-pane container fade" id="eExterno" role="tabpanel" aria-labelledby="eExterno-tab">
                                                                    <h2><i class="fa fa-medkit"></i> Solicitud de examenes externos</h2>
                                                                    <div class="row">
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descTomografCoherencia" placeholder="Tomograf&iacute;a coherencia &oacute;ptica" aria-label="Tomograf&iacute;a coherencia &oacute;ptica" aria-describedby="btndescTomografCoherencia">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescTomografCoherencia"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadTomografCoherencia"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descBiometriaInterferometria" placeholder="Biometr&iacute;a de interferometr&iacute;a" aria-label="Biometr&iacute;a de interferometr&iacute;a" aria-describedby="btndescBiometriaInterferometria">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescBiometriaInterferometria"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadBiometriaInterferometria"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descTomografiaCorneal" placeholder="Tomograf&iacute;a corneal (Pentacan)" aria-label="Tomograf&iacute;a corneal (Pentacan)" aria-describedby="btndescTomografiaCorneal">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescTomografiaCorneal"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadTomografiaCorneal"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descCampoVisualComp" placeholder="Campo visual computarizado" aria-label="Campo visual computarizado" aria-describedby="btndescCampoVisualComp">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescCampoVisualComp"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadCampoVisualComp"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descServicioDoce" placeholder="Servicio 12" aria-label="Servicio 12" aria-describedby="btndescServicioDoce">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescServicioDoce"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadServicioDoce"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descEcografiaOcular" placeholder="Ecograf&iacute;a ocular" aria-label="Ecograf&iacute;a ocular" aria-describedby="btndescEcografiaOcular">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescEcografiaOcular"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadEcografiaOcular"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descTonometriaNoCOntacto" placeholder="Tonometr&iacute;a de no contacto" aria-label="Tonometr&iacute;a de no contacto" aria-describedby="btndescTonometriaNoCOntacto">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescTonometriaNoCOntacto"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadTonometriaNoCOntacto"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                        <div class="input-group col-md-6 col-sm-6 form-group has-feedback">
                                                                            <input type="text" class="form-control" id="descMicroscopiaEspecular" placeholder="Microscop&iacute;a especular" aria-label="Microscop&iacute;a especular" aria-describedby="btndescMicroscopiaEspecular">
                                                                            <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btndescMicroscopiaEspecular"><i class="fa fa-save"></i></button></span>
                                                                            <span class="input-group-btn"><button class="btn btn-warning pull-right" type="button" id="uploadMicroscopiaEspecular"><i class="fa fa-upload"></i></button></span>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- Fin Examenes externos -->

                                                                <!-- Inicio GENERACION DE RECETA -->
                                                                <div class="tab-pane container fade" id="Receta" role="tabpanel" aria-labelledby="Receta-tab">
                                                                    <div class="col-md-12 ">
                                                                        <div class="x_panel">
                                                                            <div class="x_title">
                                                                                <h3><small>Generaci&oacute;n de receta</small></h3>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="x_content">
                                                                                <form class="form-horizontal form-label-left">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-12 col-sm-12  form-group has-feedback">
                                                                                            <!-- Codigo incertado de receta.html -->
                                                                                            <div class="container">
                                                                                                <div class="col-md-12 form-group has-feedback">
                                                                                                    <div class="col-md-9  search-box">
                                                                                                        <label for="quantity">* Medicamento:</label>
                                                                                                        <input type="text" id="searchMedicine" autocomplete="off" name="searchMedicine" placeholder="Buscar medicamento..." require>
                                                                                                        <!-- <button id="clearSearch">X</button> -->
                                                                                                        <ul id="suggestions"></ul>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 input-group">
                                                                                                        <label for="quantity">* Cantidad:</label>
                                                                                                        <input type="number" id="quantity" name="quantity" require>
                                                                                                    </div>
                                                                                                    <div class="col-md-9 input-group">
                                                                                                        <label for="description">* Descripción:</label>
                                                                                                        <input type="text" id="description" name="description" require></input>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 input-group">
                                                                                                        <!-- <button type ="button" id="btnAddToList">Agregar a la lista</button> -->
                                                                                                        <span class="input-group-btn"><button class="btn btn-primary pull-right" type="button" id="btnAddToList"><i class="fa fa-check"></i> Agregar</button></span>
                                                                                                        <!-- <button type="button" id="btnSavePrescription" disabled>Guardar Receta</button> -->
                                                                                                        <span class="input-group-btn"><button class="btn btn-success pull-right" type="button" id="btnSavePrescription" disabled><i class="fa fa-save"></i> Guardar</button></span>
                                                                                                    </div>
                                                                                                    <div class="col-md-12 input-group">
                                                                                                        <table id="medicinesList">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <th>Medicamento</th>
                                                                                                                    <th>Cantidad</th>
                                                                                                                    <th>Descripción</th>
                                                                                                                    <th>Acciones</th>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>
                                                                                                                <!-- Los elementos de la lista se cargarán aquí -->
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Fin codigo receta.html -->
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin GENERACION DE RECETA -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Fin DIV Body-->
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


<!-- Codigo insertado receta.html -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Asegúrate de que el DOM esté cargado
        $(document).ready(function() {
            // Puedes llamar a la función AJAX al cargar la página
            loadMedicines();
            // O cuando se realiza alguna acción, como clic en un botón
            $('#btnLoadMedicines').click(function() {
                loadMedicines();
            });
            function loadMedicines() {
                $.ajax({
                    url: 'searchMedicine.php', // URL al archivo PHP que devuelve los medicamentos
                    type: 'GET',
                    dataType: 'json', // Esperamos una respuesta en formato JSON
                    success: function(response) {
                        // Carga los medicamentos en la tabla
                        loadMedicinesIntoTable(response);
                    },
                    error: function(xhr, status, error) {
                        // Manejar el error
                        console.error("Ha ocurrido un error: " + error);
                    }
                });
            }
        
            function loadMedicinesIntoTable(medicines) {
                // Encuentra el cuerpo de la tabla donde se cargarán los medicamentos
                var tableBody = $('#medicinesTable tbody');
                // Vacía el cuerpo actual de la tabla para evitar duplicados
                tableBody.empty();
                // Itera a través de la lista de medicamentos y crea una fila por cada uno
                medicines.forEach(function(medicine) {
                    // Crea una fila de tabla y celdas para los detalles del medicamento
                    var row = $('<tr></tr>');
                    row.append($('<td></td>').text(medicine.id)); // Suponiendo que 'name' es una propiedad del objeto medicamento
                    row.append($('<td></td>').text(medicine.nombremed)); // Suponiendo 'dosage'
                    row.append($('<td></td>').text(medicine.formafarmaceutica)); // Suponiendo 'description'
                    // Agrega un botón o enlace para editar y eliminar si es necesario
                    //row.append($('<td><button class="editBtn">Editar</button></td>'));
                    row.append($('<td><button class="deleteBtn">Eliminar</button></td>'));
                    // Agrega la fila al cuerpo de la tabla
                    tableBody.append(row);
                });
            }

            // Otros manejadores de eventos y funciones aquí
            function clearSearchField() {
                document.getElementById('searchMedicine').value = ''; // Clear the input field
                // If you have a suggestions list, you might want to hide it too
                //document.getElementById('suggestionsList').style.display = 'none';
            }
        });

        $(document).ready(function() {
                $('#searchMedicine').keyup(function() {
                    var query = $(this).val();
                    if (query.length > 0) {
                        $.ajax({
                            url: 'searchMedicine.php',
                            type: 'GET',
                            data: { query: query },
                            dataType: 'json',
                            success: function(response) {
                                var suggestionsList = $('#suggestions');
                                suggestionsList.empty(); // Limpia las sugerencias anteriores
                                suggestionsList.show(); // Muestra la lista de sugerencias
                                response.forEach(function(item) {
                                    suggestionsList.append(
                                        $('<li></li>').text(item.nombremed).click(function() {
                                            // Completa el input al hacer clic en una sugerencia
                                            $('#searchMedicine').val(item.nombremed);
                                            suggestionsList.hide(); // Oculta la lista de sugerencias
                                        })
                                    );
                                });
                            }
                        });
                    } else {
                        $('#suggestions').hide(); // Oculta la lista si no hay entrada
                    }
                });
                
                // Ocultar sugerencias al hacer clic fuera
                $(document).click(function (e) {
                    if (!$(e.target).is('#searchMedicine, #suggestions, #suggestions *')) {
                        $('#suggestions').hide();
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var clearBtn = document.getElementById('clearSearch');
                var searchInput = document.getElementById('searchMedicine');
                if (clearBtn && searchInput) {
                    clearBtn.addEventListener('click', function() {
                        searchInput.value = ''; // Clear the input field
                        // Si tienes una lista de sugerencias, quizás también quieras ocultarla
                        // document.getElementById('suggestionsList').style.display = 'none';
                    });
                }
            });

            $("#btnSavePrescription").click(function() {
                var medicines = [];
                $("#medicinesList tbody tr").each(function() {
                    var row = $(this);
                    var medicine = {
                        medicine: row.find("td").eq(0).text(),
                        quantity: row.find("td").eq(1).text(),
                        description: row.find("td").eq(2).text()
                    };
                    medicines.push(medicine);
                });
                
                $("#medicinesList tbody").empty(); // Limpia la tabla antes de enviar los datos
                $.ajax({
                    url: 'savePrescription.php',
                    type: 'POST',
                    data: { prescription: medicines },
                    success: function(response) {
                        console.log(response);
                        //$("#medicinesList tbody").empty(); // Limpia la tabla
                        //alert('La receta se ha guardado con éxito.'); // Mensaje de confirmación
                        Swal.fire( // Mensaje de confirmación con SweetAlert2
                            '¡Guardado!', 'La receta se ha guardado con éxito.', 'success'
                        );
                    },
                    error: function(xhr, status, error) {
                        console.error("Ha ocurrido un error: " + error);
                    }
                });
            });


        //<!-- Guarda antecedentes -->
        $("#btnGuardaAntecedentes").click(function() {
            const params=new URLSearchParams(window.location.search)

            //console.log("IdPaciente ",params.get('id'))
            //console.log("IdCita ",params.get('atention'))

            var antecedentes = {
                appoid: params.get('atention'),
                pid: params.get('id'),
                DM: $("#checkDM").prop('checked')?1:0,
                HTA: $("#checkHTA").prop('checked')?1:0,
                alergias: $("#checkalergias").prop('checked')?1:0,
                sinOjoSeco: $("#checksinOjoSeco").prop('checked')?1:0,
                glaucoma: $("#checkglaucoma").prop('checked')?1:0,
                altRetinales: $("#checkaltRetinales").prop('checked')?1:0,
                traumaOcular: $("#checktraumaOcular").prop('checked')?1:0,
                qxOcularPrevia: $("#checkqxOcularPrevia").prop('checked')?1:0,
                usaLC: $("#checkusaLC").prop('checked')?1:0,
                colgenopatias: $("#checkcolgenopatias").prop('checked')?1:0,
                medTopicos: $("#checkmedTopicos").prop('checked')?1:0,
                descripcion: $("#descripcionatencion").val()
            };

            $.ajax({
                url: 'saveAntecedentes.php',
                type: 'POST',
                data: { recibe: antecedentes },
                success: function(response) {
                   
                    Swal.fire(
                        '¡Guardado!', 'Los antecedentes se han guardado con éxito.', 'success'
                    ).then(event=>{
                        if(event.isConfirmed){
                            activeTab('Consulta','motivoconsulta')   
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Ha ocurrido un error: " + error);
                    Swal.fire(
                        'Error', 'Ha ocurrido un error al guardar los antecedentes.', 'error'
                    );
                }
            });
        });
        //<!-- Fin Guarda Antecedentes -->


        ///////////////////////////////
        // Guarda Motivo de la consulta
            $("#btnGuardaMotivoConsulta").click(function() {
                const params=new URLSearchParams(window.location.search)

                //console.log("IdPaciente ",params.get('id'))
                //console.log("IdCita ",params.get('atention'))

                var motivoConsulta = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    descripcion: $("#motivoconsulta").val()
                };

                $.ajax({
                    url: 'saveMotivoConsulta.php',
                    type: 'POST',
                    data: { recibe: motivoConsulta },
                    success: function(response) {
                        Swal.fire(
                            '¡Guardado!', 'Se registro el motivo de la consulta con éxito.', 'success'
                        ).then(event=>{
                            if(event.isConfirmed){
                                activeTab('eOftalmologico','step-2')
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Ha ocurrido un error: " + error);
                        Swal.fire(
                            'Error', 'Ha ocurrido un error al guardar los el motivo de la consulta.', 'error'
                        );
                    }
                });
            });
        // Fin Guarda motivo de la consulta
        ////////////////////////////


        ///////////////////////////////
        //Guarda Examen oftalmologico
        $("#btnGuardaExamOftalm").click(function() {
            const params=new URLSearchParams(window.location.search)

            console.log("IdPaciente ",params.get('id'))
            console.log("IdCita ",params.get('atention'))
            console.log("Datos1 ", params.get('OiSinCorrector'))


            var resulExamOftalm = {
                appoid: params.get('atention'),
                pid: params.get('id'),
                OiSinCorrector: $("#OiSinCorrector").val(),
                OdSinCorrector: $("#OdSinCorrector").val(),
                OiConCorrector: $("#OiConCorrector").val(),
                OdConCorrector: $("#OdConCorrector").val(),
                OiAgujeroSteropertico: $("#OiAgujeroSteropertico").val(),
                OdAgujeroSteropertico: $("#OdAgujeroSteropertico").val(),
                OiParpados: $("#OiParpados").val(),
                OdParpados: $("#OdParpados").val(),
                OiViaLagrimal: $("#OiViaLagrimal").val(),
                OdViaLagrimal: $("#OdViaLagrimal").val(),
                OiConjuntiva: $("#OiConjuntiva").val(),
                OdConjuntiva: $("#OdConjuntiva").val(),
                OiCornea: $("#OiCornea").val(),
                OdCornea: $("#OdCornea").val(),
                OiCamaraAnterior: $("#OiCamaraAnterior").val(),
                OdCamaraAnterior: $("#OdCamaraAnterior").val(),
                OiCristalino: $("#OiCristalino").val(),
                OdCristalino: $("#OdCristalino").val(),
                OiAplanatico: $("#OiAplanatico").val(),
                OdAplanatico: $("#OdAplanatico").val(),
                OiPIntraocular: $("#OiPIntraocular").val(),
                OdPIntraocular: $("#OdPIntraocular").val(),
                OiRelacionCopa: $("#OiRelacionCopa").val(),
                OdRelacionCopa: $("#OdRelacionCopa").val(),
                OiVasos: $("#OiVasos").val(),
                OdVasos: $("#OdVasos").val(),
                OiBordesNervio: $("#OiBordesNervio").val(),
                OdBordesNervio: $("#OdBordesNervio").val(),
                OiAnilloNeuroretinal: $("#OiAnilloNeuroretinal").val(),
                OdAnilloNeuroretinal: $("#OdAnilloNeuroretinal").val(),
                OiRetina: $("#OiRetina").val(),
                OdRetina: $("#OdRetina").val(),
                OiVasosRetinales: $("#OiVasosRetinales").val(),
                OdVasosRetinales: $("#OdVasosRetinales").val(),
                OiMacula: $("#OiMacula").val(),
                odMacula: $("#odMacula").val(),
                OiRetinaPeriferica: $("#OiRetinaPeriferica").val(),
                odRetinaPeriferica: $("#odRetinaPeriferica").val()
            };

            $.ajax({
                url: 'saveExamOftalm.php',
                type: 'POST',
                data: { recibe: resulExamOftalm },
                success: function(response) {
                    Swal.fire(
                        '¡Guardado!', 'Se registraron los datos del examen oftalmologico con éxito.', 'success'
                    ).then(event=>{
                        if(event.isConfirmed){
                            activeTab('Refraccion','oiEsferaLejos')   
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Ha ocurrido un error: " + error);
                    Swal.fire(
                        'Error', 'Ha ocurrido un error al guardar datos del examen oftalmologico.', 'error'
                    );
                }
            });
        });
        //Fin examen oftalmologico
        ///////////////////////////////




            /////////////////////
            // Registra Indice de Refraccion
            $("#btnGuardaIndiceRefraccion").click(function() {
                const params=new URLSearchParams(window.location.search)

                //console.log("IdPaciente ",params.get('id'))
                //console.log("IdCita ",params.get('atention'))

                var indicerefraccionmatriz = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),

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
            });
            //Fin Indice de Refraccion
            /////////////////////



            //////////////////////
            //Registra Diagnostico
            $("#btnGuardaDiagnostico").click(function() {
                const params=new URLSearchParams(window.location.search)
                var diagnostico = {
                    appoid: params.get('atention'),
                    pid: params.get('id'),
                    DiagnosticoPaciente: $("#DiagnosticoPaciente").val()
                };

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
            });
            //Fin Registra Diagnostico
            //////////////////////////






            ///////////////////////////////
            // Guarda motivo de la consulta
            $("#btnGuardaMotivoConsulta").click(function() {
                    const params=new URLSearchParams(window.location.search)

                    //console.log("IdPaciente ",params.get('id'))
                    //console.log("IdCita ",params.get('atention'))

                    var motivoConsulta = {
                        appoid: params.get('atention'),
                        pid: params.get('id'),
                        descripcion: $("#motivoconsulta").val()
                    };

                    $.ajax({
                        url: 'saveMotivoConsulta.php',
                        type: 'POST',
                        data: { recibe: motivoConsulta },
                        success: function(response) {
                            Swal.fire(
                                '¡Guardado!', 'Se registro el motivo de la consulta con éxito.', 'success'
                            ).then(event=>{
                                if(event.isConfirmed){
                                    activeTab('eOftalmologico','step-2')
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Ha ocurrido un error: " + error);
                            Swal.fire(
                                'Error', 'Ha ocurrido un error al guardar los el motivo de la consulta.', 'error'
                            );
                        }
                    });
                });
            // Fin Guarda motivo de la consulta
            ////////////////////////////


            ///////////////////////////////
            // Guarda Imagenes y Guarda en la DB
            $("#btnGuardaImagenesEquiposPropios").click(function() {
                const params = new URLSearchParams(window.location.search);
                var pasaNombresImagenesVP = {
                    appoid: params.get("atention"),
                    pid: params.get("id"),
                    checkImgVolkPictor: [] // Inicializa el array
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
                    pasaNombresImagenesVP.checkImgVolkPictor.push(nombreImagen);
                });

                // Recorre los checkboxes marcados del grupo Auto Kerato
                $('input[name="checkImgAutoKerato[]"]:checked').each(function() {
                    const checkbox = $(this);
                    const nombreImagen = checkbox.val();
                    pasaNombresImagenesVP.checkImgVolkPictor.push(nombreImagen);
                });

                $.ajax({
                    url: "saveimagenesequipospropios.php",
                    type: "POST",
                    data: { sMotivoConsulta: pasaNombresImagenesVP,
                            from: '<?php echo $from; ?>',
                            to: '<?php echo $to; ?>' },
                    success: function(response) {
                        Swal.fire(
                            "¡Guardado!",
                            "Se registraron las imagenes de la lista con éxito.",
                            "success"
                        ).then((event) => {
                            if (event.isConfirmed) {
                                activeTab("diagnostico", "DiagnosticoPaciente");
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Ha ocurrido un error: " + error);
                        Swal.fire(
                            "Error",
                            "Ha ocurrido un error al guardar las imagenes.",
                            "error"
                        );
                    },
                });
            });
            // Fin Guarda Imagenes y registra en la DB
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
            
        </script>
<!-- Fin codigo insertado receta.html -->





        <!-- apertuta de un pdf -->
        <script>
/*             document.addEventListener("DOMContentLoaded", function() {
                document.querySelector("select").addEventListener("change", function() {
                    //console.log("Cambio detectado");
                    var selectedOption = this.options[this.selectedIndex];
                    var pdfUrl = selectedOption.getAttribute("data-pdf");
                    //console.log("PDF URL:", pdfUrl);
                    var appoid = selectedOption.value;

                    if (pdfUrl) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', pdfUrl, true); // Aquí se abre historiaclinica.php
                        xhr.send('appoid=' + appoid); // Envías el appoid a historiaclinica.php
                    }
                });
            }); */
        </script>
        <!-- Cierre en la generacion de un pdf --> 



        <!-- Abre nuevo formuario visor de imagenes -->
        <script>
            $(document).ready(function() {
                // Muestra el formulario hijo
                $("#visor").show();
            });
        </script>
        <!-- FIN Abre nuevo formuario visor de imagenes -->

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- jQuery Smart Wizard -->
        <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley -->
        <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="../vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="../vendors/starrr/dist/starrr.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>


</body>

</html>


<?php
    function encrypt($data, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }
?>
