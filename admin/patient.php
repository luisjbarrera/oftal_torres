<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/patient_admin.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/IconoCentroOftalmologicoTorres.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Pacientes</title>
    
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }else{
            $aemail=$_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }



        //import database
        include("../connection.php");
        $userrow = $database->query("select webuserid, email, 
            CASE
            WHEN usertype = 'a' THEN 'Administrador'
            WHEN usertype = 'p' THEN 'Paciente'
            WHEN usertype = 'd' THEN 'Doctor'
            WHEN usertype = 't' THEN 'Asistente'
            END AS tipo_usuario from webuser where email='$aemail';");
        $userfetch = $userrow->fetch_assoc();
        $userid = $userfetch["webuserid"];
        $username = mb_substr($userfetch["email"], 0, strpos($userfetch["email"], "@") - 0);
        $tpusuario = $userfetch["tipo_usuario"];


    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/CentroOftalmologicoTorresIII.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                <p class="profile-title"><?php echo $tpusuario; ?></p>
                                    <p class="profile-subtitle"><?php echo $username; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Cerrar Sesión" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Inicio</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor ">
                <a href="doctors.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">Médicos</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-schedule">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Calendario</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Cita</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient  menu-active menu-icon-patient-active">
            <a href="patient.php" class="non-style-link-menu  non-style-link-menu-active">
                <div>
                    <p class="menu-text">Pacientes</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">

                    <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Volver</font>
                        </button></a>

                </td>
                <td>

                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" autocomplete="off" class="input-text header-searchbar" placeholder="Búsqueda por Nombres, apellidos, DNI o Email del paciente" list="patient">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="patient">';
                        $list11 = $database->query("SELECT pname, pemail, pDNI FROM patient;");
                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["pname"];
                                $c = $row00["pemail"];
                                $dc = $row00["pDNI"];
                                echo "<option value='$d'><br/>";
                                echo "<option value='$c'><br/>";
                                echo "<option value='$dc'><br/>";
                            };
                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Búsqueda" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                    </form>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Fecha
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set('America/Bogota');
                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>


            <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Todos los Pacientes (<?php echo $list11->num_rows; ?>)</p>
                </td>

            </tr>
            <?php
            if ($_POST) {
                $keyword = $_POST["search"];

                $sqlmain = "select pid, pname, pDNI, pFNac, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS edad, ptel, paddress, pemail FROM patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' or pDNI = '$keyword'";
            } else {
                $sqlmain = "select pid, pname, pDNI, pFNac, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS edad, ptel, paddress, pemail FROM patient order by pid desc";
            }



            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Nombre</th>
                                        <th class="table-headin">DNI</th>
                                        <th class="table-headin">Teléfono</th>
                                        <th class="table-headin">Email</th>
                                        <th class="table-headin">Edad</th>
                                        <th class="table-headin">Info</th>
                                        <th class="table-headin">Cita</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = $database->query($sqlmain);
                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                        <td colspan="4">
                                        <br><br><br><br>
                                        <center>
                                        <img src="../img/notfound.svg" width="25%">
                                        
                                        <br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">No pudimos encontrar nada relacionado con sus palabras clave. !</p>
                                        <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Pacientes &nbsp;</font></button>
                                        </a>
                                        </center>
                                        <br><br><br><br>
                                        </td>
                                        </tr>';
                                        } else {
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $pid = $row["pid"];
                                                $name = $row["pname"];
                                                $email = $row["pemail"];
                                                $nic = $row["pDNI"];
                                                $dob = $row["edad"];
                                                $tel = $row["ptel"];

                                                echo '<tr>
                                                        <td> &nbsp;' .
                                                                substr($name, 0, 35). '
                                                        </td>
                                                        <td>
                                                            ' . substr($nic, 0, 12) . '
                                                        </td>
                                                        <td>
                                                            ' . substr($tel, 0, 10) . '
                                                        </td>
                                                        <td>
                                                            ' . substr($email, 0, 20) . '
                                                        </td>
                                                        <td>
                                                            ' . substr($dob, 0, 10) . '
                                                        </td>
                                                        <td>
                                                            <div style="display:flex;justify-content: center;">
                                                                <a href="?action=view&id=' . $pid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Ver</font></button></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="display:flex;justify-content: center;">
                                                                <a href="?action=agendar&id=' . $pid . '"  class="non-style-link"><button  class="btn-primary-soft btn button-icon menu-icon-session-active"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Citas</font></button></a>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                            }
                                        }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>
    <?php
    if ($_GET) {
        if ($_GET["action"]=='view') {
            $id = $_GET["id"];
            $action = $_GET["action"];
            $sqlmain = "select * from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];
            $nic = $row["pDNI"];
            $dob = $row["pFNac"];
            $tele = $row["ptel"];
            $address = $row["paddress"];
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                            <center>
                                <a class="close" href="patient.php">&times;</a>
                                <div class="content"></div>
                                <div style="display: flex;justify-content: center;">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                    
                                        <tr>
                                            <td colspan="2">
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Informaci&oacute;n del paciente</p><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td">
                                                <label for="name" class="form-label">Nombre: </label>
                                                ' . $name . '<br><br>
                                            </td>
                                            <td class="label-td">
                                                <label for="nic" class="form-label">DNI: </label>
                                                ' . $nic . '<br><br>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="label-td">
                                                <label for="Email" class="form-label">Correo: </label>
                                                ' . $email . '<br><br>
                                            </td>
                                            <td class="label-td">
                                                    <label for="Tele" class="form-label">Teléfono: </label>
                                                    ' . $tele . '<br><br>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td">
                                                <label for="spec" class="form-label">Dirección: </label>
                                                ' . $address . '<br><br>
                                            </td>
                                            <td class="label-td">
                                                <label for="name" class="form-label">Fecha de Nacimiento: </label>
                                                ' . $dob . '<br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <a href="patient.php"><input type="button" value="Cerrar" class="login-btn btn-primary-soft btn" ></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </center>
                        <br><br>
                    </div>
                </div>
                ';
        }elseif ($_GET["action"]=='agendar') {
            $id = $_GET["id"];
            $action = $_GET["action"];
            $sqlmain = "select pid, pname, pemail, pDNI, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS edad, ptel, paddress from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];
            $nic = $row["pDNI"];
            $dob = $row["edad"];
            $tele = $row["ptel"];
            $address = $row["paddress"];
            unset($sqlmain);

            $sqlmain = "SELECT d.docid, d.docname, sh.scheduleid, sh.title, sh.scheduledate, sh.scheduletime FROM doctor d INNER JOIN schedule sh ON d.docid = sh.docid WHERE sh.scheduledate BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 5 DAY);";
            //$sqlmain ="";
            $datos = $database->query($sqlmain);
            unset($sqlmain);

            //Lista detalle de productos (Bienes o servicios)
            $sSqlProd = "SELECT id_prod, nombre_prod, abreviatura_prod, dcto_prod, precio_prod FROM producto WHERE estado_prod = 1;";
            $sProds = $database->query($sSqlProd);
            unset($sSqlProd);
            ?>
                <div id="popup2" class="overlay">
                        <div class="popup">
                            <center>
                                <a class="close" href="patient.php">&times;</a>
                                <div class="content"></div>
                                <div style="display: flex;justify-content: center;">
                                    <form action="patient.php?action=reserva" method="post">
                                        <table  class="sub-table scrolldown add-doc-form-container" border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Resevar cita</p><br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <input type="hidden" id="txtIdPaciente" value="<?php echo $id; ?>">
                                                    <input type="hidden" id="txtedad" value="<?php echo $dob; ?>">
                                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;"><?php echo $name; ?></p><br>
                                                </td>
                                            </tr>
                                            <tr class="form-check">
                                                <td class="label-td" colspan="2" onclick="consultarMonto()">
                                                    <label class="form-check-label" for="slectTipoAtencion">Atenci&oacute;n</label>
                                                    <select class="box" id="slectTipoAtencion" name="slectTipoAtencion">
                                                        <option>Seleccione una opción...</option>
                                                        <?php foreach($sProds as $rProd){ ?>
                                                            <option value="<?php echo $rProd["id_prod"]; ?>"><?php echo $rProd["nombre_prod"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" for="monto">Precio</label>
                                                    <input type="text" id="monto" placeholder="0.00" name="monto" class="input-text" oninput="formatCurrency(this, 'error-monto')">

                                                </td>
                                                <td>
                                                    <label class="form-check-label" for="txtDscto">Dscto</label>
                                                    <input type="text" id="txtDscto" placeholder="0.00" name="txtDscto" class="input-text" oninput="formatCurrency(this, 'error-txtDscto')">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" colspan="3">
                                                    <label for="idListaMedico" class="form-label">M&eacute;dico: </label>
                                                    <select class="box" id="idListaMedico" name="nameListaMedico">
                                                    <option>Seleccione una opción</option>
                                                        <?php foreach($datos as $row){ ?>
                                                            <option value="<?php echo $row["scheduleid"]; ?>"><?php echo $row["title"].' '.$row["docname"]. ' '.$row["scheduledate"].' '.$row["scheduletime"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td class="label-td">
                                                    <label for="openSwalButton" class="form-label">New</label>
                                                    <button id="openSwalButton" name="openSwalButton">+</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-td">
                                                    <label for="dateMedico" class="form-label">F.Programada:</label>
                                                    <input type="date" id="dateMedico" name="dateMedico" min="' . date('Y-m-d') . '" class="input-text" readonly>
                                                </td>
                                                <td class="label-td">
                                                    <label for="fechacita" class="form-label">F.Cita:</label>
                                                    <input type="date" id="fechacita" name="fechacita" min="' . date('Y-m-d') . '" class="input-text" required>
                                                </td>
                                                <td colspan="2" rowspan="3" class="label-td" style="vertical-align: top;">
                                                    <div class="table-container">
                                                        <table class="mis-citas-table">
                                                            <caption>Mis citas</caption>
                                                            <thead>
                                                                <tr>
                                                                    <th>Orden N&deg;</th>
                                                                    <th>Hora</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Las filas se generarán dinámicamente aquí -->
                                                            </tbody>
                                                            <tfoot>
                                                                <!-- El Footer se creará aquí -->
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="vertical-align: top;">
                                                    <label for="timeMedico" class="form-label">H.Programada:</label>
                                                    <input type="time" id="timeMedico" name="timeMedico" class="input-text" placeholder="Hora" readonly>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <label for="horacita" class="form-label">H.Cita:</label>
                                                    <input type="time" id="horacita" name="horacita" class="input-text" placeholder="Hora" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" colspan="4" style="text-align: center;">
                                                    <button id="btnAgendar" class="btn-primary-soft btn button-icon menu-icon-session-active" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Agendar</font></button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </center>
                        <br><br>
                    </div>
                </div>
            <?php
        };
    };

    ?>
    </div>


    <script>


        $("#btnAgendar").click(function(event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente

            // Obtiene la fecha de cita y la convierte a formato adecuado
            var pacienteid = $("#txtIdPaciente").val();
            var tipoatencion = $("#slectTipoAtencion").val();
            var programacionmedid = $("#idListaMedico").val();
            var edad = $("#txtedad").val();
            var fechaCita = new Date($("#fechacita").val());
            var fechaProgramada = $("#dateMedico").val();
            var horacita = $("#horacita").val();
            var timemedico = $("#timemedico").val();
            var scheduleTime = new Date($("#dateMedico").val());

            if (fechaCita.getFullYear() === scheduleTime.getFullYear() &&
                fechaCita.getMonth() === scheduleTime.getMonth() &&
                fechaCita.getDate() === scheduleTime.getDate()) {
                // Si la fecha de cita es posterior a la hora de $row["scheduletime"]
                // Puedes realizar alguna acción, como mostrar un mensaje de error
                //console.log('Las fechas son iguales');
                $.ajax({
                    url: 'booking-complete.php',
                    type: 'POST',
                    data: {
                        pacienteid: pacienteid,
                        programacionmedid: programacionmedid,
                        edad: edad,
                        tipoatencion: tipoatencion,
                        fechaprogramada: fechaProgramada,
                        horaprogramada: horacita
                    },
                    success: function(response) {
                        // Si la respuesta es éxito, puedes realizar alguna acción adicional, como redireccionar
                        //if (data.status === 'success') {
                            // Muestra el mensaje de éxito
                            Swal.fire({
                                title: 'Mensaje de confirmación',
                                html: 'Cita programada.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                // Redirecciona a otra página después de que el usuario haga clic en "Aceptar"
                                Swal.fire({
                                    title: 'Redireccionando...',
                                    html: '<img src="../img/cargando.gif" style="width: 50px; height: 50px;" />',
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });

                                if (result.isConfirmed) {
                                    setTimeout(function() {
                                        window.location.href = 'patient.php';
                                    }, 2000);
                                }
                            });
                        //}
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores de la llamada AJAX
                        Swal.fire({
                            title: 'Error',
                            html: 'Sucedió un error al intentar registrar la cita;<br>por favor, vuelva a intentarlo, caso contrario notifique al desarrollador del sistema.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });

            } else {
                //console.log('Las fechas son diferentes');
                Swal.fire({
                    title: 'Advertencia',
                    html: 'Esta intentando programar una cita cuando el m&eacute;dico no cuenta con programamci&oacute;n para la fecha intenta agendar. <br> Por favor, seleccione una fecha en la que el m&eacute;dico tenga programaci&oacute;n asignada.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });

            }
        });


        // Lista fecha y hora programada del medico
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('idListaMedico').addEventListener('change', function() {
                var pid = document.getElementById('txtIdPaciente').value;
                var selectedOption = this.options[this.selectedIndex];
                var scheduleId = selectedOption.value; // Capturar el valor de scheduleid
                var parts = selectedOption.textContent.split(' ');

                var penultimate = parts[parts.length - 2];
                var last = parts[parts.length - 1];

                // Calculamos las horas y minutospara el elemento date y time
                var now = new Date();
                var year = now.getFullYear();
                var month = (now.getMonth() + 1).toString().padStart(2, '0');
                var day = now.getDate().toString().padStart(2, '0');
                var hour = now.getHours().toString().padStart(2, '0');
                var minute = now.getMinutes().toString().padStart(2, '0');

                // Establecer la fecha y hora actual como valor predeterminado
                var today = year + '-' + month + '-' + day;
                var currentTime = hour + ':' + minute;

                //document.getElementById('titleMedico').value = title;
                document.getElementById('dateMedico').value = penultimate;
                document.getElementById('timeMedico').value = last;
                document.getElementById('fechacita').value = penultimate;
               

                // Crear un objeto FormData con el scheduleid
                var formData = new FormData();
                formData.append('scheduleid', scheduleId);
                formData.append('pid', pid);
                formData.append('tipoConsulta', 'ListaMedicos'); // Agregar parámetro adicional
                formData.append('FechaProgMedico', penultimate);

                // Realizar la llamada AJAX
                var xhrLista = new XMLHttpRequest();
                xhrLista.open('POST', 'consulta-citasmedico.php', true);
                xhrLista.onload = function() {
                    if (xhrLista.status === 200) {
                        //console.log('Respuesta: ' + xhr.responseText);
                        // Procesar la respuesta si es necesario
                        var response = JSON.parse(xhrLista.responseText);

                        // Generar el contenido del tbody con los resultados
                        var tbodyContent = $('.mis-citas-table tbody')
                        var nCont = 0;
                        tbodyContent.empty();
                        response.forEach(function(row) {
                            var datosSql = $('<tr></tr>');
                            datosSql.append($('<td></td>').text(row.apponum));
                            datosSql.append($('<td></td>').text(row.appohour));
                            tbodyContent.append(datosSql);
                            nCont++;
                        });

                        var tfootContent = $('.mis-citas-table tfoot')
                        tfootContent.empty();
                        var estructuraFoot = $('<tr></tr>');
                        estructuraFoot.append($('<td colspan="2"></td>').html('N&uacute;mero total de citas para hoy: '+nCont));
                        tfootContent.append(estructuraFoot);
                    }
                };
                xhrLista.send(formData);

                // Crear un objeto FormData para la Cita con 20 minutos de adelanto
                var formDataHCPlus = new FormData();
                //console.log('scheduleId: ', scheduleId);
                formDataHCPlus.append('scheduleid', scheduleId);
                //console.log('pid: ', pid);
                formDataHCPlus.append('pid', pid);
                formDataHCPlus.append('tipoConsulta', 'HoraMax'); // Agregar parámetro adicional
                //console.log('Fecha Prog. Medico: ', penultimate);
                formDataHCPlus.append('FechaProgMedico', penultimate);
                var hourMax; // Declarar la variable fuera de la función forEach

                // Realizar la llamada AJAX
                var xhrHora = new XMLHttpRequest();
                xhrHora.open('POST', 'consulta-citasmedico.php', true);
                xhrHora.onload = function() {
                    if (xhrHora.status === 200) {
                        // Procesar la respuesta si es necesario
                        var response = JSON.parse(xhrHora.responseText);
                        response.forEach(function(row) {
                            var fullTime = row.plusminutes; // Obtiene la hora completa
                            var timeParts = fullTime.split(':'); // Divide la hora en partes (horas, minutos, segundos)
                            var formattedTime = timeParts[0] + ':' + timeParts[1];
                            hourMaxValue = formattedTime;
                        });
                        //console.log(hourMaxValue);
                            if (hourMaxValue) {
                                document.getElementById('horacita').value = hourMaxValue;
                            } else {
                                console.log('hourMax no tiene un valor de hora válido:', hourMaxValue);
                            }
                    }
                };
                xhrHora.send(formDataHCPlus);
            });
        });


        function formatCurrency(input, errorId) {
            let value = input.value;

            // Verificar si el valor es un número válido
            if (!/^\d{1,4}(\.\d{0,2})?$/.test(value)) {
                // Mostrar un mensaje de error
                let errorElement = document.getElementById(errorId);
                if (!errorElement) {
                    errorElement = document.createElement('div');
                    errorElement.id = errorId;
                    errorElement.classList.add('error-message'); // Añadir la clase de estilo
                    input.parentNode.appendChild(errorElement);
                }
                errorElement.textContent = 'Solo se permiten valores numéricos.';
                
                // Borrar el contenido del input
                input.value = '';
                
                // Alertar al usuario
                /* Swal.fire({
                    title: 'Cuidado..!',
                    html: 'Ingrese solo valores numéricos',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }); */
                
                return;
            }

            // Si el valor es válido, eliminar el mensaje de error si existe
            let errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.remove();
            }

            // Resto de la función para formatear el valor como moneda
            let parts = value.split('.');
            if (parts.length > 1) {
                parts[0] = parts[0].slice(0, 4);
                parts[1] = parts[1].slice(0, 2);
                value = parts.join('.');
            } else {
                value = parts[0].slice(0, 4);
            }
            
            // Formatear como un valor de moneda
            input.value = value;
        }



        function consultarMonto() {
            var idProd = $("#slectTipoAtencion").val();

            $.ajax({
                type: "POST",
                url: "consultar_monto.php", // Ruta de tu archivo PHP que ejecuta la consulta MySQL
                data: { id_prod: idProd },
                success: function(response) {
                    // Convertir la respuesta JSON a un objeto JavaScript
                    var data = JSON.parse(response);
                    
                    // Actualizar el valor del elemento "monto" con el precio obtenido
                    $("#monto").val(data[0].precio_prod);
                },
                error: function(xhr, status, error) {
                    console.error("Error al consultar el monto:", error);
                    // Puedes mostrar un mensaje de error al usuario si lo deseas
                }
            });
        }


        ////// AGREGANDO UNA NUEVA PROGRAMACION AL MEDICO
        document.getElementById('openSwalButton').addEventListener('click', function() {
            var myopenSwalButton = document.getElementById('openSwalButton');
            if (myopenSwalButton) {
                $.ajax({
                    type: "POST",
                    url: "consultar_medicos.php", // Ruta de tu archivo PHP que ejecuta la consulta MySQL
                    success: function(response) {
                        // Convertir la respuesta JSON a un objeto JavaScript
                        var data = JSON.parse(response);
                        // Obtener la fecha actual en formato YYYY-MM-DD
                        var today = new Date().toISOString().slice(0, 10);
                        // Crear el contenido HTML para el select con los datos obtenidos
                        var selectHTML = '<select id="docid" name="docid" class="box">';
                        selectHTML += '<option value="" disabled selected hidden>Escoge Nombre Doctor</option>';
                        data.forEach(function(row) {
                            selectHTML += '<option value="' + row.docid + '">' + row.docname + '</option>';
                        });
                        selectHTML += '</select><br>';
                        Swal.fire({
                            title: 'Programar atención médica',
                            html:
                                '<input id="txtSesion" class="swal2-input" placeholder="nombre de la sesion" required>' +
                                '<input type="date" id="date" name="date" class="swal2-input" min="' + today + '" value="' + today + '" required><br>' + 
                                '<input type="time" id="time" name="time" class="swal2-input" placeholder="Hora" required><br>' + 
                                selectHTML,
                            showCancelButton: true,
                            confirmButtonText: 'Programar médico',
                            cancelButtonText: 'Cancelar',
                            didOpen: () => {
                                document.getElementById('txtSesion').focus();
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const inputSesion = document.getElementById('txtSesion').value;
                                const inputDate = document.getElementById('date').value;
                                const inputTime = document.getElementById('time').value;
                                const inputDocId = document.getElementById('docid').value;
                                    $.ajax({
                                        type: "POST",
                                        url: "add-session.php",
                                        data: {title: inputSesion, 
                                                docid: inputDocId,
                                                nop: 20,
                                                date: inputDate,
                                                time: inputTime,
                                                nTypeRegist: 1
                                                },
                                    });
                                Swal.fire('Programación realizada con éxito. ', inputSesion, 'success');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al listar los médicos:", error);
                        // Puedes mostrar un mensaje de error al usuario si lo deseas
                    }
                });
            }
        });
        ////// AGREGANDO UNA NUEVA PROGRAMACION AL MEDICO



    </script>
</body>

</html>