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
			<a href="index.php" class="navbar-brand"><logo><img src="images/logo1.png"> iCONTROL</logo></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">				
                <?php
                if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]==1)
                {
                ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">TRABAJOS<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="mostrarTrabajos.php">MOSTRAR TRABAJO</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php" id="menu02">CERRAR SESION</a></li>
                <?php
                }
                else if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]==2)
                {
                ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">TRABAJOS<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="registerNewWork.php">REGISTRAR NUEVO TRABAJO</a></li>
                            <li><a href="mostrarTrabajos.php">MOSTRAR TRABAJO</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php" id="menu02">CERRAR SESION</a></li>
                <?php
                }
                /*else
                {
                ?>
                    <li><a href="home.php" id="menu02">NOSOTROS</a></li>                
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">SERVICES<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">PICKUP</a></li>
                            <li><a href="#">HOME DELIVERY</a></li>
                        </ul>
                    </li>
                <?php
                }*/
                ?>
			</ul>
		</div>
	</div>
</nav>