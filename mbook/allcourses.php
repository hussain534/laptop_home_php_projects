<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    $nombre_pagina='allcourses.php';
    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;

    require 'dbcontroller.php';
    $controller = new controller();
    $dataLoop = $controller->getAllCourses($databasecon,0,$current_page,$pagination_count,$DEBUG_STATUS);
    $data = $controller->getAllCourses($databasecon,1,$current_page,$pagination_count,$DEBUG_STATUS);
    if(isset($_GET["err"]))
    {
        if($_GET["err"]==1)
            $msg='<center> Successfully enrolled in course</center>';
        else if($_GET["err"]==2)
            $msg='<center> Enrolled course disactivated / activated successfully</center>';
        else if($_GET["err"]==7)
            $msg='<center> You are already enrolled in course</center>';
        else if($_GET["err"]==8)
            $msg='<center> Error while registering the course</center>';
        else if($_GET["err"]==9)
            $msg='<center> Error while disactivating / activating enrolled course</center>';
        else
            $msg='';
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
            <a href="allcourses.php"> <span class="glyphicon glyphicon-chevron-right"></span> All Courses</a>
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
        <div class="col-sm-12 text-center"><h1>All Courses</h1></div>
    </div>
    <br>
    <br>

    <!-- <div class="row">
        <div class="col-sm-12 text-right">
            <a href="allcourses.php">
                <button type="button" class="btn btn-primary" style="letter-spacing:1px">View All Course</button>
            </a>
        </div>
    </div> -->
    <?php
        if(isset($dataLoop) && count($dataLoop)>0)
        {
            $total_pages=ceil(count($dataLoop)/$pagination_count);
            $last_page = $total_pages-1;
            include('configPagination.php');
        }
    ?>
    <div class="row table_back">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>NAME</td>
                            <td style="width:250px">DESCRIPTION</td>
                            <td>STARTS ON</td>
                            <td>ENDS ON</td>
                            <td>CAPACITY</td>
                            <td>ENROLLED</td>
                            <td>COURSE TYPE</td>
                            <td>STATUS</td>
                            <td style="text-align:center;width:120px">ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($data);$x++)
                {
            ?>
                        <tr>
                            <td><?php echo $data[$x][0];?></td>
                            <td><?php echo $data[$x][1];?></td>
                            <td style="text-align: justify;"><?php echo $data[$x][2];?></td>
                            <td><?php echo $data[$x][3];?></td>
                            <td><?php echo $data[$x][4];?></td>
                            <td><?php if($data[$x][7]<0) echo 'UNLIMITED'; else echo $data[$x][7];?></td>
                            <td><?php echo $data[$x][8];?></td>
                            <td><?php echo $data[$x][6];?></td>
                            <td><?php if($data[$x][5]==0) echo 'INACTIVE'; else echo 'ACTIVE';?></td>
                            <td style="text-align: center;">
                                <?php
                                    if($data[$x][5]==0)
                                    {
                                ?>
                                    <a href=controller.php?controller=8&task=1&id=<?php echo $data[$x][0];?> class="linkBtn"><span class="glyphicon glyphicon-arrow-down1">EXIT</span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href=controller.php?controller=8&task=1&id=<?php echo $data[$x][0];?> class="linkBtn"><span class="glyphicon glyphicon-arrow-up1">ENROLL</span></a>
                                <?php
                                    }
                                ?>
                                
                                <!-- <a href=courses-classroom-admin-edit.php?id=<?php echo $data[$x][0];?> class="linkBtn"><span class="glyphicon glyphicon-pencil"></span></a> -->
                            </td>
                        </tr>
                    
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
</div>