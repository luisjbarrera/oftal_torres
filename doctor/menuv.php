<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
    <div class="sidebar" id="mySidebar">
        <div class="profile">
            <img src="../img/CentroOftalmologicoTorresIII.png" alt="" width="70" >
            <div class="profile-info">
                <p class="profile-title">Doctor</p>
                <p class="profile-subtitle"><?php echo substr($username, 0, 13); ?></p>
            </div>
        </div>
        <a class="active" href="home.php" id="home-link"><i class="fa fa-fw fa-home"></i> Inicio</a>
        <a href="principal.php" id="principal-link"><i class="fa fa-fw fa-file"></i> Mis citas</a>
        <a href="programacion.php" id="programacion-link"><i class="fa fa-fw fa-calendar"></i> Mi programaci&oacute;n</a>
        <a href="paciente.php" id="paciente-link"><i class="fa fa-fw fa-group"></i> Mis pacientes</a>
        <a href="#" id="config-link"><i class='fa fa-fw fa-cogs'></i> Confirguraci&oacute;n</a>
        <a href="logout.php" id="logout-link"><i class='fa fa-fw fa-circle-o-notch'></i> Cerrar sesi&oacute;n</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentUrl = window.location.href;
            var homeLink = document.getElementById("home-link");
            var principalLink = document.getElementById("principal-link");
            var programacionLink = document.getElementById("programacion-link");
            var pacienteLink = document.getElementById("paciente-link");
            var configLink = document.getElementById("config-link");
            var logoutLink = document.getElementById("logout-link");

            if (currentUrl.includes("home.php")) {
                homeLink.classList.add("active");
                principalLink.classList.remove('active');
                programacionLink.classList.remove("active");
                pacienteLink.classList.remove("active");
                configLink.classList.remove("active");
                logoutLink.classList.remove("active");
            } else if (currentUrl.includes("principal.php")) {
                homeLink.classList.remove("active");
                principalLink.classList.add('active');
                programacionLink.classList.remove("active");
                pacienteLink.classList.remove("active");
                configLink.classList.remove("active");
                logoutLink.classList.remove("active");
            } else if (currentUrl.includes("programacion.php")) {
                homeLink.classList.remove("active");
                principalLink.classList.remove('active');
                programacionLink.classList.add("active");
                pacienteLink.classList.remove("active");
                configLink.classList.remove("active");
                logoutLink.classList.remove("active");
            } else if (currentUrl.includes("paciente.php")) {
                homeLink.classList.remove("active");
                principalLink.classList.remove('active');
                programacionLink.classList.remove("active");
                pacienteLink.classList.add("active");
                configLink.classList.remove("active");
                logoutLink.classList.remove("active");
            } else if (currentUrl.includes("configuracion.php")) {
                homeLink.classList.remove("active");
                principalLink.classList.remove('active');
                programacionLink.classList.remove("active");
                pacienteLink.classList.remove("active");
                configLink.classList.add("active");
                logoutLink.classList.remove("active");
            } else if (currentUrl.includes("logout.php")) {
                homeLink.classList.remove("active");
                principalLink.classList.remove('active');
                programacionLink.classList.remove("active");
                pacienteLink.classList.remove("active");
                configLink.classList.remove("active");
                logoutLink.classList.add("active");
            } else {
                homeLink.classList.remove("active");
                principalLink.classList.remove('active');
                programacionLink.classList.remove("active");
                pacienteLink.classList.remove("active");
                configLink.classList.remove("active");
                logoutLink.classList.remove("active");
            }
        });
    </script>
</body>
</html>