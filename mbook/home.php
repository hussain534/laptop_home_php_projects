<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 text-right">
            <a href="home.php">Home</a>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php
        if($_SESSION["user_perfil"]==1)
        {
    ?>
    <div class="row">
        <!-- <div class="col-sm-3"></div> -->
        <div class="col-sm-12">
            <div class="row text-center">
                <div class="menu_back">
                    <a href="dashboard.php" class="menu_icon"><img src="images/dashboard.png" class="logo_img_login"></a>
                    <br>
                    <p>Dashboard</p>
                </div>
                <div class="menu_back">
                    <a href="users.php" class="menu_icon"><img src="images/users.png" class="logo_img_login"></a>
                    <br>
                    <p>Users</p>
                </div>
                <div class="menu_back">
                    <a href="courses.php" class="menu_icon"><img src="images/courses.png" class="logo_img_login"></a>
                    <br>
                    <p>Courses</p>
                </div>
                <div class="menu_back">
                    <a href="reports.php" class="menu_icon"><img src="images/reports.png" class="logo_img_login"></a>
                    <br>
                    <p>Reports</p>
                </div>
                <div class="menu_back">
                    <a href="notifications.php" class="menu_icon"><img src="images/email.png" class="logo_img_login"></a>
                    <br>
                    <p>Notifications</p>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-3"></div> -->
    </div>
    <?php
        }
        else
        {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row text-center">
                <div class="menu_back">
                    <a href="mydashboard_user.php" class="menu_icon"><img src="images/dashboard.png" class="logo_img_login"></a>
                    <br>
                    <p>My Dashboard</p>
                </div>
                <div class="menu_back">
                    <a href="myprofile.php?id=<?php echo $_SESSION["user_id"];?>" class="menu_icon"><img src="images/manager.png" class="logo_img_login"></a>
                    <br>
                    <p>My Profile</p>
                </div>
                <div class="menu_back">
                    <a href="mycourses.php" class="menu_icon"><img src="images/courses.png" class="logo_img_login"></a>
                    <br>
                    <p>My Courses</p>
                </div>
                <div class="menu_back">
                    <a href="myreports.php" class="menu_icon"><img src="images/reports.png" class="logo_img_login"></a>
                    <br>
                    <p>My Reports</p>
                </div>
                <div class="menu_back">
                    <a href="mynotifications.php" class="menu_icon"><img src="images/email.png" class="logo_img_login"></a>
                    <br>
                    <p>My Notifications</p>
                </div>
            </div>
        </div>
    </div> 
    <?php
        }
    ?>
   
</div>