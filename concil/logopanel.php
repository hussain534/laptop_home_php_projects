<?php
  defined('__JEXEC') or ('Access denied');
?>



<nav class="navbar navbar-inverse" id="top">
	<div class="container-fluid">
		<div class="navbar-header" style="width:95%">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
            <?php
                if(isset($_SESSION["user_id"]))
                {
            ?>
                <!-- <a href="dashboard.php" class="navbar-brand"><logo><img src="images/background_sm_blue.png"> Smart-Concil</logo></a> -->
                <!-- <a href="dashboard.php" class="navbar-brand"><logo><img src="images/Mesa de trabajo 7-8.png"></logo></a><logo style="float:right"><img src="images/logo_dos_textoGris.png" style="width:80px !important;margin-left:20px"></logo> -->
                <a href="dashboard.php" class="navbar-brand"><logo><img src="images/Mesa de trabajo 7-8.png"></logo></a><logo style="float:right"><img src="images/Objeto inteligente vectorial-1.png" style="width:80px !important;margin-left:20px"></logo>
            <?php
                }
                else
                {
            ?>
                <!-- <a href="index.php" class="navbar-brand"><logo><img src="images/background_sm_blue.png"> Smart-Concil</logo></a> -->
                <!-- <a href="index.php" class="navbar-brand"><logo><img src="images/Mesa de trabajo 7-8.png"></logo></a><logo style="float:right"><img src="images/logo_dos_textoGris.png" style="width:80px !important;margin-left:20px"></logo> -->
                <a href="index.php" class="navbar-brand"><logo><img src="images/Mesa de trabajo 7-8.png"></logo></a><logo style="float:right"><img src="images/Objeto inteligente vectorial-1.png" style="width:80px !important;margin-left:20px"></logo>
            <?php
                }
            ?>			
		</div>  
		

    <div class="collapse navbar-collapse" id="myNavbar">
        <?php
            if(isset($_SESSION["user_perfil"]))
            {
        ?>      
        <?php
            //local
            //$con=mysqli_connect("localhost","sitadmin","sitadmin534","concil");
            //prod
            $con=mysqli_connect('104.209.173.99','admin_db_concil','uzeMsD3bW1','admin_etapa_concil');
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            function get_menu_tree($id_padre) 
            {
                global $con;
                $menu = "";
                $sqlquery=" SELECT cm.* FROM c_menu cm,c_perfil cp, c_permisos pm where cm.habilitado='1' and cp.habilitado=1 and pm.habilitado=1 and cm.url!='#' and cm.id=pm.id_menu and cp.id=pm.id_perfil and cp.id=".$_SESSION["user_perfil"]." order by cm.id_menu";
                //$sqlquery = " SELECT * FROM c_menu where habilitado='1' and url!='#' order by id_menu";
                $res=mysqli_query($con,$sqlquery);
                while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
                {
                  $menu .="<li><a href='".$row['url']."'>".$row['nombre_menu']."</a>";
                      //$menu .= "<ul>".get_menu_tree($row['id_menu'])."</ul>"; //call  recursively
                      $menu .= "</li>";
                }
                return $menu;
            } 
        ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog" style="font-size:x-large;color:ivory;"></span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="dashboard.php">DASHBOARD</a></li>                
                <?php echo get_menu_tree(0);?>
                <li><a href="logout.php">CERRAR SESION</a></li>
            </ul>
          </li>        
        </ul>        
        <?php
            }
        ?>
    </div>
    
	</div>
</nav>
<img src="images/Mesa de trabajo 13_1-8.png" style="height:50px;margin-top:-15px">