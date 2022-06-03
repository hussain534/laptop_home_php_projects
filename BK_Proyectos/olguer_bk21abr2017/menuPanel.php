<?php
  defined('__JEXEC') or ('Access denied');
  //session_start();
?>

<nav class="navbar navbar-inverse" id="top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<!-- <a href="index.php" class="navbar-brand"><logo>PMC</logo></a>
			<h5 style="margin:0;color:cornsilk">PLATAFORMA DE MANTENIMIENTO Y CONTROL</h5> -->
			<!-- <a href="index.php" class="navbar-brand"><logo><img src="images/logo1.jpg"></logo></a> -->
			<a href="#" class="navbar-brand"><logo><img src="images/logo.png"></logo></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<?php
					if(isset($_SESSION["user_name"]))
					{
				?>		
					<li><a href="logout.php" id="menu02">CERRAR SESION</a></li>
				<?php
					}
					else
					{
				?>
                <li><a href="registrar.php" id="menu02">REGISTRAR</a></li>
                <li><a href="login.php" id="menu02">INICIAR SESION</a></li>
                <?php
            		}
            	?>
			</ul>
		</div>
	</div>
</nav>