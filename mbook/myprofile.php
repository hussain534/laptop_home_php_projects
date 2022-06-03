<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();
    $students = $controller->getUserDtlById($databasecon,$_GET["id"],$DEBUG_STATUS);
    if(isset($_GET["err"]))
    {
        if($_GET["err"]==1)
            $msg='<center> Profile details modified successfully</center>';
        else
            $msg='<center> Error while modifying profile details</center>';
    }
    else 
        $msg='';

?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10  links text-right">
            <a href="home.php">Home</a>
            <a href="myprofile.php?id=<?php echo $_SESSION["user_id"];?>"> <span class="glyphicon glyphicon-chevron-right"></span> Profile</a>
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
        <div class="col-sm-12 text-center"><h1>My Profile</h1></div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-1 text-center"></div>
        <div class="col-sm-10">
            <form method="post" action="controller.php?controller=6&task=0" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="userId" name="userId" value="<?=$students[0][0];?>">
                <div class="row">
                    <div class="col-sm-4 inputData">
                        <label for="userName">Full Name (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="userName" name="userName" value="<?=$students[0][1];?>" placeholder="Full Name" required>
                        <div class="errmsg" id="error_userName"></div>
                    </div>
                    <div class="col-sm-4 inputData">
                        <label for="userEmail">Email (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="userEmail" name="userEmail" value="<?=$students[0][2];?>" placeholder="Email" required>
                        <div class="errmsg" id="error_userEmail"></div>
                    </div>
                    <div class="col-sm-4 inputData">
                        <label for="userContact">Contact Number (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="userContact" name="userContact" value="<?=$students[0][3];?>" placeholder="Contact Number" required>
                        <div class="errmsg" id="error_userContact"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 inputData">
                        <label for="userPwd">Password (<span class="mandatoryCheck">*</span>)</label>
                        <input type="password" class="form-control" id="userPwd" name="userPwd" value="<?=$students[0][4];?>" placeholder="Password" required>
                        <div class="errmsg" id="error_userName"></div>
                    </div>
                    <div class="col-sm-3 inputData">
                        <label for="userStatus">ENABLE / DISABLE (<span class="mandatoryCheck">*</span>)</label>
                        <select name="userStatus" class="form-control" id="userStatus" required>
                            <option value="1" <?php if($students[0][5]==1) echo 'selected';?>>YES</option>
                            <option value="0" <?php if($students[0][5]==0) echo 'selected';?>>NO</option>
                        </select>
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