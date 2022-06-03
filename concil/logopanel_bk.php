<?php
  defined('__JEXEC') or ('Access denied');
?>

<nav class="navbar navbar-inverse" id="top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
            <?php
                if(isset($_SESSION["user_id"]))
                {
            ?>
                <a href="dashboard.php" class="navbar-brand"><logo><img src="images/background_sm_blue.png"> Smart-Concil</logo></a>
            <?php
                }
                else
                {
            ?>
                <a href="index.php" class="navbar-brand"><logo><img src="images/background_sm_blue.png"> Smart-Concil</logo></a>
            <?php
                }
            ?>			
		</div>  
        <?php
            if(isset($_SESSION["user_perfil"]))
            {
        ?>      
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <li><a href="proveedores.php">INTEGRADORES</a></li>
                <li><a href="canales.php">CANALES</a></li>
                <li><a href="formatos.php">FORMATO-ARCHIVOS</a></li>
                <li><a href="ubicacionArchivos.php">UBICACION-ARCHIVOS</a></li>
                <li><a href="conciliacion.php">CONCILIACION</a></li>
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">REPORTES<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="1">1</a></li>
                        <li><a href="#">1</a></li>
                    </ul>
                </li> -->
                <li><a href="logout.php">CERRAR SESION</a></li>
            </ul>
        </div>
        <?php
            }
        ?>
	</div>
</nav>