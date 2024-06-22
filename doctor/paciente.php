<!DOCTYPE html>
<html lang="es">

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <!-- <link rel="stylesheet" href="../css/admin.css"> -->
    <link rel="stylesheet" type="text/css" href="css/stylestablet.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/IconoCentroOftalmologicoTorres.ico">
    <title>Pacientes</title>
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
        
        include 'menuv.php'; ?>

        <div class="content" id="main">
            <div>
                <span style="font-size:30px;cursor:pointer">&#9776;</span>
                <!-- Aquí va el contenido específico de la página principal -->
                <div class="dash-body" style="margin-top: 15px">
                    <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
                        <tr>
                            <td width="13%" class="nav-bar">
                                <a href="index.php">
                                    <button class="btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                        <font class="tn-in-text">Volver</font>
                                    </button>
                                </a>
                            </td>
                            <td width="25%">
                                <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Atenci&oacute;n de mis pacientes</p>
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
            <?php
                $selecttype = "Mis";
                $current = "Solo mis Pacientes";
                if ($_POST) {
                    if (isset($_POST["search"])) {
                        $keyword = $_POST["search12"];
                        $sqlmain="SELECT ap.appoid ,ap.pid ,ap.apponum ,ap.scheduleid ,ap.appodate ,p.pid ,p.pemail ,p.pname ,p.ppassword ,p.paddress ,p.pDNI ,FORMAT(DATEDIFF(CURDATE(), p.pFNac)/365.25, 0) AS pFNac ,p.ptel ,sh.scheduleid ,sh.docid ,sh.title ,sh.scheduledate ,sh.scheduletime ,sh.nop   
                        FROM appointment ap INNER JOIN patient p ON p.pid=ap.pid INNER JOIN schedule sh ON sh.scheduleid=ap.scheduleid WHERE DATE(ap.appodate) = CURDATE() and (p.pemail='$keyword' or p.pname='$keyword' or p.pname like '$keyword%' or p.pname like '%$keyword' or p.pname like '%$keyword%')";
                        //$sqlmain = "select pid, pemail, pname, ppassword, paddress, pDNI, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS pFNac, ptel from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
                        $selecttype = "my";
                    }

                    if (isset($_POST["filter"])) {
                        if ($_POST["showonly"] == 'all') {
                            $sqlmain = "SELECT ap.appoid ,ap.pid ,ap.apponum ,ap.scheduleid ,ap.appodate ,p.pid ,p.pemail ,p.pname ,p.ppassword ,p.paddress ,p.pDNI ,FORMAT(DATEDIFF(CURDATE(), p.pFNac)/365.25, 0) AS pFNac ,p.ptel ,sh.scheduleid ,sh.docid ,sh.title ,sh.scheduledate ,sh.scheduletime ,sh.nop   
                            FROM appointment ap INNER JOIN patient p ON p.pid=ap.pid INNER JOIN schedule sh ON sh.scheduleid=ap.scheduleid WHERE DATE(ap.appodate) = CURDATE()";
                            //$sqlmain = "select pid, pemail, pname, ppassword, paddress, pDNI, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS pFNac, ptel from patient;";
                            $selecttype = "All";
                            $current = "All patients";
                        } else {
                            $sqlmain = "SELECT ap.appoid ,ap.pid ,ap.apponum ,ap.scheduleid ,ap.appodate ,p.pid ,p.pemail ,p.pname ,p.ppassword ,p.paddress ,p.pDNI ,FORMAT(DATEDIFF(CURDATE(), p.pFNac)/365.25, 0) AS pFNac ,p.ptel ,sh.scheduleid ,sh.docid ,sh.title ,sh.scheduledate ,sh.scheduletime ,sh.nop   
                            FROM appointment ap INNER JOIN patient p ON p.pid=ap.pid INNER JOIN schedule sh ON sh.scheduleid=ap.scheduleid WHERE DATE(ap.appodate) = CURDATE()and sh.docid=$userid;";
                            $selecttype = "Mis";
                            $current = "Solo mis Pacientes";
                        }
                    }
                } else {
                    $sqlmain = "SELECT ap.appoid ,ap.pid ,ap.apponum ,ap.scheduleid ,ap.appodate ,p.pid ,p.pemail ,p.pname ,p.ppassword ,p.paddress ,p.pDNI ,FORMAT(DATEDIFF(CURDATE(), p.pFNac)/365.25, 0) AS pFNac ,p.ptel ,sh.scheduleid ,sh.docid ,sh.title ,sh.scheduledate, sh.scheduletime, sh.nop, 
                    CASE ap.estadoattenc
                        WHEN 1 THEN 'Citado'
                        WHEN 2 THEN 'En atencion'
                        WHEN 3 THEN 'Atendido'
                        ELSE 'Desconocido'
                    END AS estadoatencion 
                    FROM appointment ap INNER JOIN patient p ON p.pid=ap.pid INNER JOIN schedule sh ON sh.scheduleid=ap.scheduleid WHERE sh.docid=$userid ORDER BY ap.apponum ASC, ap.estadoattenc ASC;";
                    //pid, pemail, pname, ppassword, paddress, pDNI, FORMAT(DATEDIFF(CURDATE(), pFNac)/365.25, 0) AS edad, ptel
                    $selecttype = "Mis";
                }
            ?>
            <div class="dash-body">
                <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                    <tr>
                        <td colspan="4">
                            <form action="" method="post" class="header-search" style="display: flex; align-items: center;">
                                <input type="search" name="search12" class="input-text header-searchbar" placeholder="Búsqueda Nombre de Paciente o Email" list="patient">
                                <input type="Submit" value="Búsqueda" name="search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                <?php
                                    echo '<datalist id="patient">';
                                    $list11 = $database->query($sqlmain);
                                    //$list12= $database->query("select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=1;");
                                    for ($y = 0; $y < $list11->num_rows; $y++) {
                                        $row00 = $list11->fetch_assoc();
                                        $d = $row00["pname"];
                                        $c = $row00["pemail"];
                                        echo "<option value='$d'><br/>";
                                        echo "<option value='$c'><br/>";
                                    };
                                    echo ' </datalist>';
                                ?>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-top: 10px;width: 100%;">
                            <center>
                                <table class="filter-container" border="0">
                                    <form action="" method="post">
                                        <td>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">
                                                <?php echo $selecttype . " Pacientes (" . $list11->num_rows . ")"; ?>
                                            </p>
                                        </td>
                                        <td style="text-align: right;">
                                            Mostrar Información de: &nbsp;
                                        </td>
                                        <td width="30%">
                                            <select name="showonly" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;">
                                                <option value="" disabled selected hidden><?php echo $current   ?></option><br />
                                                <option value="my">Solo mis Pacientes</option><br />
                                                <option value="all">Todos los Pacientes</option><br />
                                            </select>
                                        </td>
                                        <td width="12%">
                                            <input type="submit" name="filter" class="btn-primary-soft btn button-icon btn-filter" value="  Buscar" style="padding: 15px; margin :0;width:100%">
                                        </td>
                                    </form>
                                </table>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <center>
                                <div class="abc scroll">
                                    <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                                        <thead>
                                            <tr>
                                                <th class="table-headin">
                                                    Nombre
                                                </th>
                                                <th class="table-headin">
                                                    DNI
                                                </th>
                                                <th class="table-headin">
                                                    Teléfono
                                                </th>
                                                <th class="table-headin">
                                                    Email
                                                </th>
                                                <th class="table-headin">
                                                    Edad
                                                </th>
                                                <th class="table-headin">
                                                    Estado
                                                </th>
                                                <th class="table-headin">
                                                    Eventos
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = $database->query($sqlmain);
                                            //echo $sqlmain;
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
                                                    $dob = $row["pFNac"];
                                                    $tel = $row["ptel"];
                                                    $atention = $row["appoid"]; //IdCita
                                                    $estadoatencion = $row["estadoatencion"]; ?>
                                                        <tr>
                                                            <td>&nbsp;
                                                                <?php echo substr($name, 0, 35); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo substr($nic, 0, 12); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo substr($tel, 0, 10); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo substr($email, 0, 20); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo substr($dob, 0, 3); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $estadoatencion; ?>
                                                            </td>
                                                            <td>
                                                                <div style="display:flex;justify-content: center;">
                                                                    <!-- ATENCION MEDICA -->
                                                                    <a href="attention_patient_new.php?id=<?php echo $pid; ?>&atention=<?php echo $atention; ?>" 
                                                                    style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;" 
                                                                    title="Ver atención médica">
                                                                    <i class="fa fa-check-square-o" style="font-size:24px;color:blue"></i>
                                                                    </a>

                                                                    <!-- EDITAR ATENCION MEDICA -->
                                                                    <a href="attention_patient_new.php?id=<?php echo $pid; ?>&atention=<?php echo $atention; ?>" 
                                                                    style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;" 
                                                                    title="Editar atención médica">
                                                                    <i class="fa fa-edit" style="font-size:24px;color:darkgreen"></i>
                                                                    </a>

                                                                    <!-- ATENCION MEDICA -->
                                                                    <a href="attention_patient_new.php?id=<?php echo $pid; ?>&atention=<?php echo $atention; ?>" 
                                                                    style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;" 
                                                                    title="Detalles de atención médica">
                                                                    <i class="fa fa-clipboard" style="font-size:24px;color:red"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr><?php
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


</body>
</html>