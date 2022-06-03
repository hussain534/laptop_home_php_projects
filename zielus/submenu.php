<?php
	defined('__JEXEC') or ('Access denied');
	//echo $_SESSION['userRole'];
?>
	<div class="row submenu">
		<div class="col-sm-12 text-center">
			<ul class="menu_inner">
				<li style="background:#fbc98c;"><a href="#" style="color:#222 !important;margin-left:10px"><?php echo strtoupper($_SESSION['userEmail']);?></a></li>
			</ul>
		</div>
		<div class="col-sm-12 text-center">
			<ul class="menu_inner">
				
				<?php
					if(isset($_SESSION['userRole']) and $_SESSION['userRole']==1)
					{
				?>
				<li><a href="perfilConductor.php">PERFIL</a></li>
				<li><a href="admincontrol.php">VERIFICAR DOCUMENTOS<span class="badge"><?php echo $_SESSION['DOCS_PEND'];?></span></a></li>
				<li><a href="adminPagos.php">VERIFICAR PAGOS<span class="badge"><?php echo $_SESSION['PAGOS_PEND'];?></span></a></li>
				<li><a href="asignarConductor.php">ASIGNAR CONDUCTOR<span class="badge"><?php echo $_SESSION['ASIG_PEND'];?></span></a></li>
				<li><a href="getConductorPerfil.php">PERFIL USUARIO</a></li>
				<li><a href="publicacionesConductor.php">VERIFICAR VIAJES</a></li>
				<li><a href="cuentabancaria.php">CUENTA BANCARIA</a></li>
				<?php
					}
					else
					{
				?>
				<li><a href="perfilConductor.php">PERFIL</a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> VIAJES <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">BUSCAR VIAJE</li>
						<li><a href="iniciarviaje.php">AEROPUERTO</a></li>
						<li><a href="iniciarviajenacional.php">NACIONAL</a></li>
						<li><a href="misreservas.php">MIS RESERVAS</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">PUBLICAR VIAJE</li>
						<!-- <li><a href="publicarviaje.php">AEROPUERTO</a></li>
						<li><a href="publicarviajenacional.php">NACIONAL</a></li> -->
						<li><a href="mispublicaciones.php">VIAJES ASIGNADOS</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> CUENTA <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">PAGOS</li>
						<li><a href="consultapagos.php">ESTADO PAGOS</a></li>
						<li><a href="cuentabancaria.php">CUENTA BANCARIA</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">OTROS</li>
						<li><a href="adminnotificacion.php">NOTIFICACIONES</a></li>
						<li><a href="adminpassword.php">CAMBIAR CONTRASENA</a></li>
						<li><a href="eliminarCuenta.php">ELIMINAR CUENTA</a></li>
					</ul>
				</li>							
				<li><a href="mensajes.php">MENSAJES</a></li>
				<li><a href="blogadmin.php">BLOGS</a></li>
				<?php
					}
				?>
				
			</ul>
		</div>
	</div>
