<!DOCTYPE html>
<html lang="es">

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/IconoCentroOftalmologicoTorres.ico">
    <link rel="stylesheet" type="text/css" href="css/stylestablet.css">
    <title>Inicio</title>
</head>
<body>
    <?php
        $useremail="leonardo@gmail.com";
        /* session_start();

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
                            <td colspan="1" class="nav-bar">
                                <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Inicio</p>
                            </td>
                            <td width="25%">

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
                                        $patientrow = $database->query("select  * from  patient;");
                                        $doctorrow = $database->query("select  * from  doctor;");
                                        $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                                        $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");
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
                            <td colspan="4">
                                <center>
                                    <table  style="border: none;width:95%" border="0">
                                        <tr>
                                            <td>
                                                <h3>Hola de nuevo!</h3>
                                                <h1><?php echo $username  ?>.</h1>
                                                <p>Gracias por unirte a nosotros. Siempre estamos tratando de brindarle un servicio completo.<br>
                                                    ¡Puede ver su horario diario, llegar a la cita de los pacientes en casa!<br><br>
                                                </p>
                                                    <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:30%">Ver Mis Citas</button></a>
                                                <br>
                                                <br>
                                            </td>
                                            <td class="right-div">
                                                <!-- Nuevo div con clase "right-div" para la imagen de fondo -->
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table border="0" width="100%"">
                                    <tr>
                                        <td width=" 50%">
                                            <center>
                                                <table class="filter-container" style="border: none;" border="0">
                                                    <tr>
                                                        <td colspan="4">
                                                            <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Dashboard</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%;">
                                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex">
                                                                <div>
                                                                    <div class="h1-dashboard">
                                                                        <?php echo $doctorrow->num_rows  ?>
                                                                    </div><br>
                                                                    <div class="h3-dashboard">
                                                                        Médicos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
                                                                <div>
                                                                    <div class="h1-dashboard">
                                                                        <?php echo $patientrow->num_rows  ?>
                                                                    </div><br>
                                                                    <div class="h3-dashboard">
                                                                        Todos los Pacientes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%;">
                                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                                <div>
                                                                    <div class="h1-dashboard">
                                                                        <?php echo $appointmentrow->num_rows  ?>
                                                                    </div><br>
                                                                    <div class="h3-dashboard">
                                                                        Nueva Reserva &nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                                                <div>
                                                                    <div class="h1-dashboard">
                                                                        <?php echo $schedulerow->num_rows  ?>
                                                                    </div><br>
                                                                    <div class="h3-dashboard" style="font-size: 15px">
                                                                        Sesiones Hoy
                                                                    </div>
                                                                </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </center>
                                        </td>
                                        <td>
                                            <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Sus próximas sesiones hasta la próxima semana</p>
                                            <center>
                                                <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                                    <table width="85%" class="sub-table scrolldown" border="0">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-headin">
                                                                    Nombre Sesión
                                                                </th>
                                                                <th class="table-headin">
                                                                    Fecha y Hora Cita
                                                                </th>
                                                                <th class="table-headin">
                                                                    Hora
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $nextweek = date("Y-m-d", strtotime("+1 week"));
                                                            $sqlmain = "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today' and schedule.scheduledate<='$nextweek' order by schedule.scheduledate desc";
                                                            $result = $database->query($sqlmain);
                        
                                                            if ($result->num_rows == 0) {
                                                                echo '<tr>
                                                                            <td colspan="4">
                                                                            <br><br><br><br>
                                                                            <center>
                                                                            <img src="../img/notfound.svg" width="25%">
                                                                            
                                                                            <br>
                                                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">No pudimos encontrar nada relacionado con sus palabras clave. !</p>
                                                                            <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Mostrar toda mi programación &nbsp;</font></button>
                                                                            </a>
                                                                            </center>
                                                                            <br><br><br><br>
                                                                            </td>
                                                                            </tr>';
                                                            } else {
                                                                for ($x = 0; $x < $result->num_rows; $x++) {
                                                                    $row = $result->fetch_assoc();
                                                                    $scheduleid = $row["scheduleid"];
                                                                    $title = $row["title"];
                                                                    $docname = $row["docname"];
                                                                    $scheduledate = $row["scheduledate"];
                                                                    $scheduletime = $row["scheduletime"];
                                                                    $nop = $row["nop"];
                                                                    ?>
                                                                        <tr>
                                                                            <td style="padding:20px;"> &nbsp;<?php echo substr($title, 0, 30); ?></td>
                                                                            <td style="padding:20px;font-size:13px;"><?php echo substr($scheduledate, 0, 10); ?></td>
                                                                            <td style="text-align:center;"><?php echo substr($scheduletime, 0, 5); ?></td>
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
                            </td>
                        <tr>
                    </table>
                </div>
            </div>
        </div>
    
</body>
</html>