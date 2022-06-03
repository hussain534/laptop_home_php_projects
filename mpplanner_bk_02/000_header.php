<div class="container">
	<div class="row">
		<div class="col-sm-12 navbar_panel">
            <nav class="navbar navbar-inverse">
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
                            <a href="001_dashboard.php" class="navbar-brand"><logo>MPPLANNER !!</logo></a>
                        <?php
                            }
                            else
                            {
                        ?>
                            <a href="index.php" class="navbar-brand"><logo>MPPLANNER !!</logo></a>
                        <?php
                            }
                        ?>            
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <?php
                            if(isset($_SESSION["user_id_profile"]))
                            {
                        ?>      
                        <?php
                            $con=mysqli_connect('localhost','merakiprod01',base64_decode('bWVyYWtpcHJvZDAx'),'mpplanner');
                            if (mysqli_connect_errno())
                            {
                              echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }

                            function get_menu_tree($id_padre) 
                            {
                                global $con;
                                $menu = "";
                                $sqlquery=" SELECT m.* FROM menu m,profile p, profile_menu_rn pm where m.enabled=1 and p.enabled=1 and pm.enabled=1 and m.url!='#' 
                                            and m.id=pm.id_menu and p.id=pm.id_profile and p.id=".$_SESSION["user_id_profile"]." order by m.id_menu";
                                $res=mysqli_query($con,$sqlquery);
                                while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
                                {
                                    $menu .="<li><a href='".$row['url']."'>".$row['menu_name']."</a>";
                                    $menu .= "</li>";
                                }
                                return $menu;
                            } 
                        ?>
                        <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog" style="font-size:large;color:ivory;"></span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="001_dashboard.php">DASHBOARD</a></li>                
                                <?php echo get_menu_tree(0);?>
                                <li><a href="000_logout.php">LOGOUT</a></li>
                            </ul>
                          </li>        
                        </ul>        
                        <?php
                            }
                        ?>
                    </div>                
                </div>
            </nav>			
		</div>
	</div>
</div>