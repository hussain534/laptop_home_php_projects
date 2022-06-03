<?php
  defined('__JEXEC') or ('Access denied');
?>

<nav class="navbar navbar-inverse" id="top">
	<div class="container-fluid">
		<div class="navbar-header" style="padding: 2px 5px 5px;margin: 5px;">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
            <?php
                if(isset($_SESSION["user_id"]))
                {
            ?>
                <a href="dashboard.php" class="navbar-brand"><logo>M360-HD</logo></a>
            <?php
                }
                else
                {
            ?>
                <a href="index.php" class="navbar-brand"><logo>M360-HD</logo></a>
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
                <?php 
                    if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=4)
                    {
                ?>
                        <li><a href="asignarTrabajo.php">ASIGNAR TRABAJO</a></li>
                <?php
                    }
                ?>
                <?php 
                    if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=1)
                    {
                ?>
                        <li><a href="exportFullTaskReport.php">EXPORTAR REPORTE</a></li>
                <?php
                    }
                ?>                
                <li><a href="mostrarTodoTrabajo.php">MOSTRAR TRABAJO</a></li>
                <li><a href="logout.php">CERRAR SESION</a></li>
            </ul>
        </div>
        <?php
                    }
                ?>
	</div>
</nav>