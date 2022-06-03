<?php
    session_start();

    if(!isset($_SESSION['LAST_LOGIN_TIME']))
    {
        session_destroy();
        $url='index.php';
        $_SESSION["res_code"]=$res_code_9998;
        header("Location:$url");
    }
    include_once('000_util.php');
    include_once('000_header.php');
    include_once('000_config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'securityDBController.php';
    $securityDBController = new securityDBController();

    if(isset($_GET["pid"]))
    {
        $profile = $securityDBController->getPerfilList($databasecon,$_GET["pid"],$DEBUG_STATUS);
        $id=$profile[0][0];
        $profile_name=$profile[0][1];
    }
    else
    {
        $id=0;
        $profile_name='';
    }

    if(isset($_GET["cid"]))
        $cid=$_GET["cid"];
    else
        $cid=1;

    $profile = $securityDBController->getPerfilList($databasecon,0,$DEBUG_STATUS);
        

?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">    
    <?php
    include_once('001_sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            PROFILES
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
                if(isset($_SESSION["res_code"]))
                {
            ?>
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION["res_code"];?>
                    </div>
            <?php
                    unset($_SESSION["res_code"]);
                }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form method="post" action="002_aclController.php?task=1">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <label>COMPANY</label>
                        <select name="id_company" class="form-control navbar-btn" id="id_company" required>
                            <?php 
                                $client = $securityDBController->getClientList($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($client);$i++)
                                {
                                    if($cid==$client[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $client[$i][0];?> selected="true"><?php echo '['.$client[$i][0].']:'.$client[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $client[$i][0];?>><?php echo '['.$client[$i][0].']:'.$client[$i][1];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>PROFILE NAME</label>
                        <input type="text" class="form-control navbar-btn" id="profile_name" placeholder="PROFILE NAME" name="profile_name" value="<?php echo $profile_name;?>"required>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row text-center">
                    <?php
                        if($id==0)
                        {
                    ?>
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">ADD<span class="glyphicon glyphicon-chevron-right"></span>
                    <?php
                        }
                        else
                        {
                    ?>
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">UPDATE<span class="glyphicon glyphicon-chevron-right"></span>
                    <?php

                        }
                    ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>

    <?php
        if(isset($profile))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>PROFILE NAME</td>
                            <td>CLIENT NAME</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($profile);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $profile[$x][0];?></td> 
                            <td><?php echo $profile[$x][1];?></td>
                            <td><?php echo $profile[$x][3];?></td>
                            <td>
                                <a href="002_profile.php?pid=<?php echo $profile[$x][0];?>&cid=<?php echo $profile[$x][2];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <?php
                                    if($profile[$x][4]==1)
                                    {
                                ?>
                                        <a href="002_aclController.php?task=2&id=<?php echo $profile[$x][0];?>&disval=1"><span class="glyphicon glyphicon-arrow-up" style="font-size:x-large;color:#00b0f0;"></span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <a href="002_aclController.php?task=2&id=<?php echo $profile[$x][0];?>&disval=0"><span class="glyphicon glyphicon-arrow-down" style="font-size:x-large;color:red;"></span></a>
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
            <?php
        }
    ?>
    <br>
</div>