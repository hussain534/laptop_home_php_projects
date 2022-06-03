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
            <?php
            if($_SESSION["user_perfil"]==2)
            {
            ?>
            <a href="home.php">Home</a>
            <a href="mycourses.php"> <span class="glyphicon glyphicon-chevron-right"></span> My Courses</a>
            <?php    
            }
            else
            {
            ?>
            <a href="home.php">Home</a>
            <a href="courses.php"> <span class="glyphicon glyphicon-chevron-right"></span> Courses</a>
            <a href="courses-online-admin.php"> <span class="glyphicon glyphicon-chevron-right"></span> Online</a>
            <?php
            }
            ?>
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
        <div class="col-sm-12 text-center"><h1>Add New Online Course</h1></div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="controller.php?controller=4&task=0" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="name">Course Name (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Course Name" required>
                        <div class="errmsg" id="error_userName"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 inputData">
                        <label for="capacity">Capacity (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Capacity" required>
                        <div class="errmsg" id="error_userContact"></div>
                    </div>
                    <div class="col-sm-3 inputData">
                        <label for="start_from">Starts On (<span class="mandatoryCheck">*</span>)</label>
                        <input type="date" class="form-control" id="start_from" name="start_from" placeholder="Course Start From" required>
                        <div class="errmsg" id="error_userContact"></div>
                    </div>
                    <div class="col-sm-3 inputData">
                        <label for="ends_on">Ends On (<span class="mandatoryCheck">*</span>)</label>
                        <input type="date" class="form-control" id="ends_on" name="ends_on" placeholder="Course Ends On" required>
                        <div class="errmsg" id="error_userContact"></div>
                    </div>
                    <div class="col-sm-3 inputData">
                        <label for="teacher_id">Teacher (<span class="mandatoryCheck">*</span>)</label>
                        <?php
                        if($_SESSION["user_perfil"]==2)
                        {
                        ?>
                        <input type="text" class="form-control" id="teacher_id" name="teacher_id" value="<?php echo $_SESSION["user_id"];?>"placeholder="Teacher Id" required readonly="true">
                        <?php    
                        }
                        else
                        {
                        ?>
                        <select class="form-control" id="teacher_id" name="teacher_id">
                            <?php
                                $teacherDtl = $controller->getAllTeachers($databasecon,0,0,0,$DEBUG_STATUS);
                                for($x=0;$x<count($teacherDtl);$x++)
                                {
                            ?>
                            <option value="<?php echo $teacherDtl[$x][0];?>"><?php echo $teacherDtl[$x][1];?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <?php    
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="description">Description (<span class="mandatoryCheck">*</span>)</label>
                        <textarea class="form-control" rows="6" id="description" name="description" placeholder="Course Description" required></textarea>
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
    </div>
</div>