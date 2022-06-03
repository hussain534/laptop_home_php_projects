<?php
    session_start();

    if(!isset($_SESSION['LAST_LOGIN_TIME']))
    {
        session_destroy();
        $url='index.php';
        $_SESSION["res_code"]=$res_code_9998;
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'securityDBController.php';
    $securityDBController = new securityDBController();

    if(isset($_GET["pid"]))
    {
        $client = $securityDBController->getClientList($databasecon,$_GET["pid"],$DEBUG_STATUS);
        $id=$client[0][0];
        $client_name=$client[0][1];
        $client_website=$client[0][2];
        $client_unique_id=$client[0][3];
    }
    else
    {
        $id=0;
        $client_name='';
        $client_website='';
        $client_unique_id='';
    }

    $client = $securityDBController->getClientList($databasecon,0,$DEBUG_STATUS);
        

?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            CLIENT
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
            <form method="post" action="loginController.php?task=11">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>COMPANY NAME</label>
                        <input type="text" class="form-control navbar-btn" id="client_name" placeholder="COMPANY NAME" name="client_name" value="<?php echo $client_name;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>COMPANY WEBSITE</label>
                        <input type="text" class="form-control navbar-btn" id="client_website" placeholder="COMPANY WEBSITE" name="client_website" value="<?php echo $client_website;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>COMPANY UNIQUE ID</label>
                        <input type="text" class="form-control navbar-btn" id="client_unique_id" placeholder="COMPANY REG NUMBER" name="client_unique_id" value="<?php echo $client_unique_id;?>"required>
                    </div>
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
        if(isset($client))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>COMPANY NAME</td>
                            <td>COMPANY WEBSITE</td>
                            <td>COMPANY REG ID</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($client);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $client[$x][0];?></td> 
                            <td><?php echo $client[$x][1];?></td>
                            <td><?php echo $client[$x][2];?></td>
                            <td><?php echo $client[$x][3];?></td>
                            <td>
                                <a href="client.php?pid=<?php echo $client[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <?php
                                    if($client[$x][4]==1)
                                    {
                                ?>
                                        <a href="loginController.php?task=12&id=<?php echo $client[$x][0];?>&disval=1"><span class="glyphicon glyphicon-arrow-up" style="font-size:x-large;color:#00b0f0;"></span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <a href="loginController.php?task=12&id=<?php echo $client[$x][0];?>&disval=0"><span class="glyphicon glyphicon-arrow-down" style="font-size:x-large;color:red;"></span></a>
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