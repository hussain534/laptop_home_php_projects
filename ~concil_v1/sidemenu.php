<div class="collapse navbar-collapse" id="myNavbar">
        <?php
            if(isset($_SESSION["user_perfil"]))
            {
        ?>      
        <?php
            //local
            //$con=mysqli_connect("localhost","sitadmin","sitadmin534","concil");
            //prod
            $con=mysqli_connect("localhost","merakiad_concil","concil534","merakiad_concil");
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            // Perform queries 
            function get_menu_tree1($id_padre) 
            {
                global $con;
                $menu = "";
                $sqlquery = " SELECT * FROM c_menu where habilitado='1' and id_padre='".$id_padre."' ";
                $res=mysqli_query($con,$sqlquery);
                while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
                {
                  $menu .="<li><a href='".$row['url']."'>".$row['nombre_menu']."</a>";
                      $menu .= "<ul>".get_menu_tree1($row['id_menu'])."</ul>"; //call  recursively
                      $menu .= "</li>";
                }
                return $menu;
            } 
        ?>
        <ul class="main-navigation">
        <?php echo get_menu_tree1(0);//start from root menus having parent id 0 ?>
        </ul>        
        <?php
            }
        ?>
    </div>