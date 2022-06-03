<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();
    $data = $controller->getSelfStudyCourseDtlById($databasecon,$_GET["id"],$DEBUG_STATUS);
    if(isset($_GET["err"]))
    {
        if($_GET["err"]==1)
            $msg='<center> Self Study course details modified successfully</center>';
        else
            $msg='<center> Error while modifying Self Study course details</center>';
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
            <a href="courses.php"> <span class="glyphicon glyphicon-chevron-right"></span> Courses</a>
            <a href="courses-selfstudy-admin.php"> <span class="glyphicon glyphicon-chevron-right"></span> Self Study</a>
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
        <div class="col-sm-12 text-center"><h1>Modify Self Study Course Details</h1></div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="controller.php?controller=5&task=2" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="userId" name="userId" value="<?=$data[0][0];?>">
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="name">Course Name (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?=$data[0][1];?>" placeholder="Course name" required>
                        <div class="errmsg" id="error_userName"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 inputData">
                        <label for="start_from">Starts From (<span class="mandatoryCheck">*</span>)</label>
                        <input type="date" class="form-control" id="start_from" name="start_from" value="<?=$data[0][3];?>" placeholder="Course starts on" required>
                        <div class="errmsg" id="error_userContact"></div>
                    </div>
                    <div class="col-sm-4 inputData">
                        <label for="ends_on">Ends On (<span class="mandatoryCheck">*</span>)</label>
                        <input type="date" class="form-control" id="ends_on" name="ends_on" value="<?=$data[0][4];?>" placeholder="Course ends on" required>
                        <div class="errmsg" id="error_userName"></div>
                    </div>
                    <div class="col-sm-4 inputData">
                        <label for="userStatus">ENABLE / DISABLE (<span class="mandatoryCheck">*</span>)</label>
                        <select name="userStatus" class="form-control" id="userStatus" required>
                            <option value="1" <?php if($data[0][5]==1) echo 'selected';?>>YES</option>
                            <option value="0" <?php if($data[0][5]==0) echo 'selected';?>>NO</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="description">Description (<span class="mandatoryCheck">*</span>)</label>
                        <textarea class="form-control" rows="6" id="description" name="description" placeholder="Course description" required><?=$data[0][2];?></textarea>
                        <div class="errmsg" id="error_userEmail"></div>
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