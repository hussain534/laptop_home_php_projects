<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();
    //$student = $controller->getAllStudents($databasecon,$DEBUG_STATUS);
    if(isset($_SESSION["err"]))
        $msg='<center>'.$_GET["err"].'</center>';
    else 
        $msg='';

?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10  links text-right">
            <a href="home.php">Home</a>
            <a href="users.php"> <span class="glyphicon glyphicon-chevron-right"></span> Users</a>
            <a href="users-student-admin.php"> <span class="glyphicon glyphicon-chevron-right"></span> Students</a>
        </div>
        <div class="col-sm-1"></div>
    </div>     
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(strlen($msg)>0)
            {
            ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Add New Student</h1></div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-1 text-center"></div>
        <div class="col-sm-10">
            <form method="post" action="controller.php?controller=2&task=0" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-4 inputData">
                        <label for="userName">Full Name (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Full Name" required>
                        <div class="errmsg" id="error_userName"></div>
                    </div>
                    <div class="col-sm-4 inputData">
                        <label for="userEmail">Email (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="userEmail" name="userEmail" placeholder="Email" required>
                        <div class="errmsg" id="error_userEmail"></div>
                    </div>
                    <div class="col-sm-4 inputData">
                        <label for="userContact">Contact Number (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="userContact" name="userContact" placeholder="Contact Number" required>
                        <div class="errmsg" id="error_userContact"></div>
                    </div>
                </div>
                <br>
                <div class="row">                    
                    <div class="col-sm-12 inputData">
                        <button type="submit" class="btn btn-primary" style="letter-spacing:1px">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-1 text-center"></div>
    </div>
</div>