<?php
  defined('__JEXEC') or ('Access denied');
  //session_start();
?>

<div class="container header-01">
	<div class="row">
        <div class="col-sm-12">
            <div class="panel" style="margin-bottom:0px; height:16px;line-height:16px;background:#000;">
                <div class="panel-heading" style="margin-bottom:0px; height:16px;padding:0;float:right;font-size:12px;">
                    <ul class="menu_header">
                        <?php
                        if(!isset($_SESSION['userid']))
                        {
                        ?>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> BUSCAR VIAJE <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="iniciarviaje.php">AEROPUERTO</a></li>
                                    <li><a href="iniciarviajenacional.php">NACIONAL</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> PUBLICAR VIAJE <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="publicarviaje.php">AEROPUERTO</a></li>
                                    <li><a href="publicarviajenacional.php">NACIONAL</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if(isset($_SESSION['userid']))
                        {
                        ?>
                            <li><a href="#" style="color:#fbc96c;margin-left:10px"><?php echo strtoupper($_SESSION['userEmail']);?></a></li>
                            <li><a href="doLogout.php" style="color:#00b0f0;margin-left:10px">CERRAR SESIÓN</a></li>
                            <?php
                            }
                            else
                            {
                            ?>
                            <li><a href="userlogin.php" style="color:#00b0f0;margin-left:10px">INICIAR SESIÓN</a></li>
                            <li><a href="userregister.php" style="color:#00b0f0;margin-left:10px">REGISTRARSE</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>