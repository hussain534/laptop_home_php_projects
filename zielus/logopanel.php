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
			<a href="index.php" class="navbar-brand"><logo>VECTIOS</logo></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">				
                <li><a href="#services" id="menu02">CONOCER MAS</a></li>
				<!-- <li><a href="#proximo_viajes" id="menu03">CONTACTENOS</a></li> -->
				<!-- 
				<li><input type="text" class="form-control navbar-btn" id="email" placeholder="Origen" maxlength=40 ame="userName"></li>
            	<li><input type="text" class="form-control navbar-btn" id="email" placeholder="Destino" maxlength=40 ame="userName"></li>
            	<li><button type="submit" class="btn btn-warning navbar-btn navbar-right" title="Click to enter our portal">BUSCAR <span class="glyphicon glyphicon-chevron-right"></span></button></li>
            	 -->
            	
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> PLANIFICAR VIAJE <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="iniciarviaje.php">AEROPUERTO</a></li>
                                    <li><a href="iniciarviajenacional.php">NACIONAL</a></li>
                                </ul>
                            </li>
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> PUBLICAR VIAJE <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="publicarviaje.php">AEROPUERTO</a></li>
                                    <li><a href="publicarviajenacional.php">NACIONAL</a></li>
                                </ul>
                            </li> -->
                       
                        <?php
                        if(isset($_SESSION['userid']))
                        {
                        ?>
                            <!-- <li><a href="#" style="color:#fbc96c;margin-left:10px"><?php echo strtoupper($_SESSION['userEmail']);?></a></li> -->
                            <li><a href="doLogout.php" style="color:#00b0f0;">CERRAR SESIÓN</a></li>
                            <?php
                            }
                            else
                            {
                            ?>
                            <li><a href="userlogin.php" style="color:#00b0f0;margin-left:10px">INICIAR SESIÓN</a></li>
                            <li><a href="userregister.php" style="color:#00b0f0;margin-left:10px">REGISTRAR</a></li>
                        <?php
                        }
                        ?>
			</ul>
		</div>
	</div>
</nav>