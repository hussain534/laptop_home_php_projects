<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    $nombre_pagina='courses-classroom-admin.php';
    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;

    require 'dbcontroller.php';
    $controller = new controller();

    if(isset($_GET["err"]))
    {
        if($_GET["err"]==1)
            $msg='<center> Content details added successfully</center>';
        else if($_GET["err"]==9)
            $msg='<center> Error while updating course content details</center>';
        else
            $msg='';
    }
    else 
        $msg='';

    $data = $controller->getCourseContentDtl($databasecon,$_GET["id"],0,$current_page,$pagination_count,$DEBUG_STATUS);
    //$data = $controller->getCourseContentDtl($databasecon,$_GET["id"],1,$current_page,$pagination_count,$DEBUG_STATUS);
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="home.php">Home</a>
            <a href="mycourses.php"> <span class="glyphicon glyphicon-chevron-right"></span> My Courses</a>
            <a href="content-design.php"> <span class="glyphicon glyphicon-chevron-right"></span> Content Design</a>
        </div>
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
        <div class="col-sm-12 content-panel">
            <div class="row">
                <div class="col-sm-12">
                    <form method="post" action="controller.php?controller=99&task=1" enctype="multipart/form-data"> 
                        <div class="row">                            
                            <div class="col-sm-12 inputData">                        
                                <input type="hidden" class="form-control" name="course_id" value=<?php echo $_GET["id"];?> readonly="true">
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-sm-3 inputData">
                                <label for="content-type">SELECT MEDIA (<span class="mandatoryCheck">*</span>)</label>                                
                                <select class="form-control" id="content-type" name="content-type">                                    
                                    <!-- <option value="1">MS WORD DOCUMENT</option>
                                    <option value="2">MS POWERPOINT DOCUMENT</option>
                                    <option value="3">MS EXCEL DOCUMENT</option> -->
                                    <option value="4">PDF DOCUMENT</option>
                                    <option value="5">IMAGE</option>
                                    <!-- <option value="6">VIDEO AND TEXT DOCUMENT</option> -->
                                </select>
                            </div>                            
                            <div class="col-sm-8 inputData">
                                <label for="content-media">FILE (<span class="mandatoryCheck">*</span>)</label>                                
                                <input type="file" name="fileToUpload" class="form-control">
                            </div>                  
                            <div class="col-sm-1 inputData">
                                <br>
                                <button type="submit" class="btn btn-primary" style="letter-spacing:1px">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 text-center"><p>------------- OR -------------</p></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form method="post" action="controller.php?controller=99&task=2" enctype="multipart/form-data">  
                        <div class="row">                            
                            <div class="col-sm-12 inputData">                         
                                <input type="hidden" class="form-control" name="course_id2" value=<?php echo $_GET["id"];?> readonly="true">
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-sm-12 inputData">                              
                                <input type="hidden" class="form-control" name="content-type2" value="6" readonly="true">
                            </div>               
                        </div>
                        <div class="row">             
                            <div class="col-sm-11 inputData">
                                <label for="content-media">EXTERNAL URL (<span class="mandatoryCheck">*</span>)</label>                                
                                <input type="text" name="fileToUpload2" class="form-control">
                            </div>                
                            <div class="col-sm-1 inputData">
                                <br>
                                <button type="submit" class="btn btn-primary" style="letter-spacing:1px">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br> 
            <div class="row paging_back">
                <div class="col-sm-12">
                    <?php        
                        if(isset($data))
                            echo '<b>Records Found : '.count($data).'</b>';
                    ?>
                </div>
            </div>
            <div class="row table_back">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>COURSE ID</td>
                                    <td>CONTENT TYPE</td>
                                    <td style="width:250px">CONTENT PATH</td>
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
                                    <td><?php echo $data[$x][2];?></td>
                                    <td><?php echo $data[$x][3];?></td>
                                    <td><?php if($data[$x][4]==0) echo 'INACTIVE'; else echo 'ACTIVE';?></td>
                                    <td style="text-align: right;">
                                        <?php
                                            if($data[$x][4]==0)
                                            {
                                        
                                            }
                                            else
                                            {
                                        ?>
                                            <a href=# onclick="window.open( 'doc_viewer.php?id=<?php echo $data[$x][0];?>', 'title', 'location=0,scrollbars=yes,status=no,toolbar=yes, menubar=no,resizable=yes' )" class="linkBtn"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <?php
                                            }
                                        ?>
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
    </div>
    
   
</div>


