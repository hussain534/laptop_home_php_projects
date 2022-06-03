<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Menu</title>
    <style>
        ul 
        {
          list-style: none;
          padding: 0;
          margin: 0;
          background: burlywood;
        }

        ul li 
        {
          display: block;
          position: relative;
          float: left;
          background: burlywood;
        }

        /* This hides the dropdowns */
        li ul 
        { 
          display: none; 
        }

        ul li a 
        {
          display: block;
          padding: 5px 15px;
          text-decoration: none;
          white-space: nowrap;
          color: #fff;
          width: 150px;
          text-align: center;
        }

        ul li a:hover 
        { 
          background: crimson; 
        }

        /* Display the dropdown */
        li:hover > ul 
        {
          display: block;
          position: absolute;
        }

        li:hover li 
        { 
          float: none; 
        }

        li:hover a 
        { 
          background: burlywood; 
        }

        li:hover li a:hover 
        { 
          background: crimson; 
        }

        .main-navigation li ul li 
        { 
          border-top: 0; 
        }

        /* Displays second level dropdowns to the right of the first level dropdown */
        ul ul ul 
        {
          left: 100%;
          top: 0;
        }

        /* Simple clearfix */
        ul:before,
        ul:after 
        {
          content: " "; /* 1 */
          display: table; /* 2 */
        }

        ul:after 
        { 
          clear: both; 
        }

    </style>
    </head>

    <body>
        <?php
            $con=mysqli_connect("localhost","sitadmin","sitadmin534","concil");
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            // Perform queries 
            function get_menu_tree($parent_id) 
            {
            	global $con;
            	$menu = "";
            	$sqlquery = " SELECT * FROM menu where status='1' and parent_id='".$parent_id."' ";
            	$res=mysqli_query($con,$sqlquery);
              while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
            	{
                  $menu .="<li><a href='".$row['link']."'>".$row['menu_name']."</a>";
            		  $menu .= "<ul>".get_menu_tree($row['menu_id'])."</ul>"; //call  recursively
            		  $menu .= "</li>";
                }
                return $menu;
            } 
        ?>
        <ul class="main-navigation">
        <?php echo get_menu_tree(0);//start from root menus having parent id 0 ?>
        </ul> 

    </body>
</html>
<?php mysqli_close($con); ?>