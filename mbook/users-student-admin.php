<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    $nombre_pagina='users-student-admin.php';
    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;

    require 'dbcontroller.php';
    $controller = new controller();
    $dataLoop = $controller->getAllStudents($databasecon,0,$current_page,$pagination_count,$DEBUG_STATUS);
    $student = $controller->getAllStudents($databasecon,1,$current_page,$pagination_count,$DEBUG_STATUS);
    if(isset($_GET["err"]))
    {
        if($_GET["err"]==1)
            $msg='<center> Student details added successfully</center>';
        else if($_GET["err"]==2)
            $msg='<center> Student details disactivated / activated successfully</center>';
        else if($_GET["err"]==8)
            $msg='<center> Error while registering student details</center>';
        else if($_GET["err"]==9)
            $msg='<center> Error while disactivating / activating student details</center>';
        else if($_GET["err"]==-1)
            $msg='<center> Email already exist. Enter different email id</center>';
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
        <div class="col-sm-12 text-center"><h1>Manage Students</h1></div>
    </div>
    <br>
    <br>

    <div class="row add_new">
        <div class="col-sm-12 text-right">
            <a href="users-student-admin-add.php">
                <button type="button" class="btn btn-primary" style="letter-spacing:1px">Add new student</button>
            </a>
        </div>
    </div>
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
                            <td>EMAIL</td>
                            <td>CONTACT NO</td>
                            <td>STATUS</td>
                            <td style="text-align:center;width:120px">ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($student);$x++)
                {
            ?>
                        <tr>
                            <td><?php echo $student[$x][0];?></td>
                            <td><?php echo $student[$x][1];?></td>
                            <td><?php echo $student[$x][2];?></td>
                            <td><?php echo $student[$x][3];?></td>
                            <td><?php if($student[$x][4]==0) echo 'INACTIVE'; else echo 'ACTIVE';?></td>
                            <td style="text-align: right;">
                                <?php
                                    if($student[$x][4]==0)
                                    {
                                ?>
                                    <a href=controller.php?controller=2&task=1&id=<?php echo $student[$x][0];?> class="linkBtn"><span class="glyphicon glyphicon-arrow-up"></span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href=controller.php?controller=2&task=1&id=<?php echo $student[$x][0];?> class="linkBtn"><span class="glyphicon glyphicon-arrow-down"></span></a>
                                <?php
                                    }
                                ?>
                                
                                <a href=users-student-admin-edit.php?id=<?php echo $student[$x][0];?> class="linkBtn"><span class="glyphicon glyphicon-pencil"></span></a>
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