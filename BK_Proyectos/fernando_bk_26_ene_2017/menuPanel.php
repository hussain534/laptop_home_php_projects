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
			<a href="index.php" class="navbar-brand"><logo><span class="glyphicon glyphicon-home"></span> BUSHIDOAPP</logo></a>
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
            	?>
			</ul>
		</div>
	</div>
</nav>