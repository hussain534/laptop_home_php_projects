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
			<?php
					if(isset($_SESSION["user_name"]))
					{
			?>
			<a href="home.php" class="navbar-brand"><logo><span class="glyphicon glyphicon-home"></span> BUSHIDOAPP</logo></a>
			<?php
				}
					else
				{
			?>
			<a href="index.php" class="navbar-brand"><logo><span class="glyphicon glyphicon-home"></span> BUSHIDOAPP</logo></a>
			<?php		
				}
        	?>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<?php
					if(isset($_SESSION["user_name"]))
					{
				?>		
					<li><a href="#" id="menu02">NOMBRE : <?php echo $_SESSION["user_name"];?></a></li>
					<li><a href="logout.php">DESCONECTAR</a></li>
				<?php
					}
					else
					{
				?>
					<!-- <a href="recuperarClave.php"><button type="submit" class="btn btn-small btn_center">REGISTER<span class="glyphicon glyphicon-chevron-right"></span></button></a> -->
				<?php		
					}
            	?>
			</ul>
		</div>
	</div>
</nav>