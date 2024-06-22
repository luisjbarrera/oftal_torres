<!DOCTYPE html>
<html lang="es">

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="../css/admin.css"> -->
    <link rel="stylesheet" type="text/css" href="css/stylestablet.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/IconoCentroOftalmologicoTorres.ico">
    <title>Citas</title>
    <style>
        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
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
    ?>
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
                                    <button type="button" class="btn btn-secondary" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        <i class="fa fa-arrow-left"></i> Volver
                                    </button>
                                </a>
                            </td>
                            <td width="25%">
                                <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Administrador de Citas</p>
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
                        <tr>
                            <td colspan="4" style="padding-top:10px;width: 100%;">
                                <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Mis Citas (<?php echo $list110->num_rows; ?>)</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-top:0px;width: 100%;">
                                <center>
                                    <form action="" method="post">
                                        <table class="filter-container" border="0">
                                            <tr>
                                                <td width="10%">
                                                </td>
                                                <td width="5%" style="text-align: center;">
                                                    Fecha:
                                                </td>
                                                <td width="30%">
                                                    <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">
                                                </td>
                                                <!-- <td width="12%">
                                                    < button type="submit" name="filter" style="padding: 15px; margin :0;width:100%"><i class="bi bi-filter"> Buscar</i></>
                                                </td> -->
                                                <td width="12%">
                                                    <button type="submit" id="filter" class="btn btn-primary">
                                                        <i class="fa fa-filter"></i> Buscar
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </center>
                            </td>
                        </tr>
                            <?php
                                $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  doctor.docid=$userid ";
                                if ($_POST) {
                                    //print_r($_POST);
                                    if (!empty($_POST["sheduledate"])) {
                                        $sheduledate = $_POST["sheduledate"];
                                        $sqlmain .= " and schedule.scheduledate='$sheduledate' ";
                                    };
                                    //echo $sqlmain;
                                }
                            ?>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <div class="abc scroll">
                                        <table width="93%" class="sub-table scrolldown" border="0">
                                            <thead>
                                                <tr>
                                                    <th class="table-headin">Nombre de Paciente</th>
                                                    <th class="table-headin">N&deg; de cita</th>
                                                    <th class="table-headin">Nombre Sesi&oacute;n</th>
                                                    <th class="table-headin">Fecha y hora de la sesi&oacute;n</th>
                                                    <th class="table-headin">Fecha de la Cita</th>
                                                    <th class="table-headin">Eventos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $result = $database->query($sqlmain);
                                                    if ($result->num_rows == 0) { ?>
                                                        <tr>
                                                            <td colspan="6"><br><br><br><br>
                                                                <center>
                                                                    <img src="../img/notfound.svg" width="25%"><br>
                                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">¡No pudimos encontrar nada relacionado con sus palabras clave!</p>
                                                                    <a class="non-style-link" href="appointment.php">
                                                                        <button class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Mostrar todas las citas &nbsp;</font></button>
                                                                    </a>
                                                                </center><br><br><br><br>
                                                            </td>
                                                        </tr> <?php
                                                    } else {
                                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                                            $row = $result->fetch_assoc();
                                                            $appoid = $row["appoid"];
                                                            $scheduleid = $row["scheduleid"];
                                                            $title = $row["title"];
                                                            $docname = $row["docname"];
                                                            $scheduledate = $row["scheduledate"];
                                                            $scheduletime = $row["scheduletime"];
                                                            $pname = $row["pname"];
                                                            $apponum = $row["apponum"];
                                                            $appodate = $row["appodate"];
                                                            ?> <tr>
                                                                    <td style="font-weight:600;">
                                                                        &nbsp;
                                                                        <?php echo substr($pname, 0, 25); ?>
                                                                    </td >
                                                                    <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                                                        <?php echo $apponum; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo substr($title, 0, 15); ?>
                                                                    </td>
                                                                    <td style="text-align:center;">
                                                                        <?php echo substr($scheduledate, 0, 10) . ' @' . substr($scheduletime, 0, 5); ?>
                                                                    </td>
                                                                    <td style="text-align:center;">
                                                                        <?php echo $appodate; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div style="display:flex;justify-content: center;">
                                                                            <!--<a href="?action=view&id=' . $appoid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Ver</font></button></a>&nbsp;&nbsp;&nbsp;-->
                                                                            <a href="?action=drop&id=' . $appoid . '&name=' . $pname . '&session=' . $title . '&apponum=' . $apponum . '" class="non-style-link">
                                                                                <button  class="btn-warning btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;">
                                                                                    <i class="fa fa-delete"></i> Anular                                               
                                                                                </button>
                                                                            </a>&nbsp;&nbsp;&nbsp;
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php
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
        </div>

        


<?php
    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
            if ($action == 'add-session') { ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="schedule.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                            <div class="abc">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                ""
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Agregar Nueva Sesión.</p><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="title" class="form-label">Nombre Sesión : </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="text" name="title" class="input-text" placeholder="Nombre de esta Sesión" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="docid" class="form-label">Selecciona Doctor: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <select name="docid" id="" class="box" >
                                                <option value="" disabled selected hidden>Escoger Doctor de la Lista</option><br/> <?php
                                                    $list11 = $database->query("select  * from  doctor;");
                                                    for ($y = 0; $y < $list11->num_rows; $y++) {
                                                        $row00 = $list11->fetch_assoc();
                                                        $sn = $row00["docname"];
                                                        $id00 = $row00["docid"];
                                                        echo "<option value=" . $id00 . ">$sn</option><br/>";
                                                    } ?>
                                                </select><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="nop" class="form-label">N&deg; de Pacientes/N&deg; de Citas: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="number" name="nop" class="input-text" min="0" placeholder="El n&uacute;mero de cita final para esta sesi&oacute;n depende de este n&uacute;mero" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="date" class="form-label">Fecha de Sesi&oacute;n: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="date" name="date" class="input-text" min="<?php echo date('Y-m-d'); ?>" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="time" class="form-label">Calendario Hora: </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="time" name="time" class="input-text" placeholder="Hora" required><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="reset" value="Limpiar" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" value="Inicia sesi&oacute;n" class="login-btn btn-primary btn" name="shedulesubmit">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </center><br><br>
                </div>
            </div>
        <?php
        } elseif ($action == 'session-added') {
            $titleget = $_GET["title"];
            ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center><br><br>
                            <h2>Sesión Placed.</h2>
                            <a class="close" href="schedule.php">&times;</a>
                            <div class="content">
                                <?php echo substr($titleget, 0, 40); ?> fue programado.<br><br>
                            </div>
                            <div style="display: flex;justify-content: center;">
                                <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a><br><br><br><br>
                            </div>
                        </center>
                    </div>
                </div>
            <?php
        } elseif ($action == 'drop') {
            $nameget = $_GET["name"];
            $session = $_GET["session"];
            $apponum = $_GET["apponum"];
            ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <h2>Estás segur@?</h2>
                            <a class="close" href="appointment.php">&times;</a>
                            <div class="content">
                                Deseas borrar este registro<br><br>
                                Nombre Paciente &nbsp;<b>' . substr($nameget, 0, 40) . '</b><br>
                                Número de cita &nbsp; : <b>' . substr($apponum, 0, 40) . '</b><br><br>
                            </div>
                            <div style="display: flex;justify-content: center;">
                                <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Si&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                                <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                            </div>
                        </center>
                    </div>
                </div>
            <?php
        } elseif ($action == 'view') {
            $sqlmain = "select * from doctor where docid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];

            $spcil_res = $database->query("select sname from specialties where id='$spe'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $nic = $row['docDNI'];
            $tele = $row['doctel'];
            ?>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <h2></h2>
                            <a class="close" href="doctors.php">&times;</a>
                            <div class="content">
                                Centro Oftalmol&oacute;gico Torres<br>
                            </div>
                            <div style="display: flex;justify-content: center;">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Ver Detalles</p><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Nombre: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $name; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Email" class="form-label">Correo: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $email; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">DNI: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $nic; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Teléfono: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $tele; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Especialidad: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <?php echo $spcil_name; ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </center><br><br>
                    </div>
                </div>
            <?php
        }
    } ?>

</body>
</html>