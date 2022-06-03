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

    if(isset($_GET["uid"]))
    {
        $users = $securityDBController->getUserList($databasecon,$_GET["uid"],$DEBUG_STATUS);
        $id=$users[0][0];
        $user_name=$users[0][1];
        $user_email=$users[0][2];
        $user_phone=$users[0][3];
        $user_mobile=$users[0][4];
        $user_address=$users[0][5];
        $user_profile_id=$users[0][6];
        $user_profile_name=$users[0][7];
        $user_client_id=$users[0][8];
        $user_client_name=$users[0][9];
        $user_cost_per_hour=$users[0][10];
        $user_joining_dt=$users[0][11];
        $user_red=$users[0][12];
    }
    else
    {
        $id=0;
        $user_name='';
        $user_email='';
        $user_phone='';
        $user_mobile='';
        $user_address='';
        $user_client_id=$_SESSION["user_id_company"];
        $user_profile_id=0;
        $user_cost_per_hour='';
        $user_red='';
    }

    $users = $securityDBController->getUserList($databasecon,0,$DEBUG_STATUS);
    if($user_client_id!=1)
    {
        echo '1<br>';
        $client = $securityDBController->getClientList($databasecon,$user_client_id,$DEBUG_STATUS);
        $profile = $securityDBController->getPerfilListByClient($databasecon,$user_client_id,$DEBUG_STATUS);
    }
    else
    {
        echo '2<br>';
        $client = $securityDBController->getClientList($databasecon,0,$DEBUG_STATUS);
        $profile = $securityDBController->getPerfilList($databasecon,0,$DEBUG_STATUS);
    }
        

?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container" style="min-height:700px">    
    <?php
    include_once('001_sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            USER
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
            <form method="post" action="002_aclController.php?task=7">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>USER NAME</label>
                        <input type="text" class="form-control navbar-btn" id="user_name" placeholder="USER NAME" name="user_name" value="<?php echo $user_name;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>USER EMAIL</label>
                        <input type="email" class="form-control navbar-btn" id="user_email" placeholder="USER EMAIL" name="user_email" value="<?php echo $user_email;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>USER PHONE</label>
                        <input type="text" class="form-control navbar-btn" id="user_phone" placeholder="USER PHONE" name="user_phone" value="<?php echo $user_phone;?>"required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>USER MOBILE</label>
                        <input type="text" class="form-control navbar-btn" id="user_mobile" placeholder="USER NAME" name="user_mobile" value="<?php echo $user_mobile;?>"required>
                    </div>
                    <div class="col-sm-8">
                        <label>USER ADDRESS</label>
                        <input type="text" class="form-control navbar-btn" id="user_address" placeholder="USER ADDRESS" name="user_address" value="<?php echo $user_address;?>"required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>COMPANY</label>
                        <select name="user_client_id" class="form-control navbar-btn" id="user_client_id" onChange="findProfileList()" required>
                            <?php 
                                //$client = $securityDBController->getClientList($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($client);$i++)
                                {
                                    /*if($user_client_id==$client[$i][0])
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
                                    }*/
                                    ?>
                                        <option value=<?php echo $client[$i][0];?>><?php echo '['.$client[$i][0].']:'.$client[$i][1];?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <label>USER PROFILE</label>
                        <select name="user_profile_id" class="form-control navbar-btn" id="user_profile_id" required>
                            <?php 
                                //$profile = $securityDBController->getPerfilList($databasecon,$_SESSION["user_id_company"],$DEBUG_STATUS);
                                for($i=0;$i<count($profile);$i++)
                                {
                                    if($$user_profile_id==$profile[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $profile[$i][0];?> selected="true"><?php echo '['.$profile[$i][0].']:'.$profile[$i][1]?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $profile[$i][0];?>><?php echo '['.$profile[$i][0].']:'.$profile[$i][1];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>USER COST/HOUR</label>
                        <input type="text" class="form-control navbar-btn" id="user_cost_per_hour" placeholder="USER COST/HER" name="user_cost_per_hour" value="<?php echo $user_cost_per_hour;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>USER JOINING DATE</label>
                        <input type="date" class="form-control navbar-btn" id="user_joining_dt" placeholder="USER JOINING DATE" name="user_joining_dt" value="<?php echo $user_joining_dt;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>USER RED</label>
                        <input type="text" class="form-control navbar-btn" id="user_red" placeholder="USER RED" name="user_red" value="<?php echo $user_red;?>">
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
        if(isset($users))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>NAME</td>
                            <td>EMAIL</td>
                            <td>PHONE</td>
                            <td>MOBILE</td>
                            <td>ADDRESS</td>
                            <td>COMPANY</td>
                            <td>PROFILE</td>
                            <td>COST/HOUR</td>
                            <td>JOINING DATE</td>
                            <td>RED</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($users);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $users[$x][0];?></td>
                            <td><?php echo $users[$x][1];?></td> 
                            <td><?php echo $users[$x][2];?></td>
                            <td><?php echo $users[$x][3];?></td>
                            <td><?php echo $users[$x][4];?></td>
                            <td><?php echo $users[$x][5];?></td>
                            <td><?php echo $users[$x][9];?></td>
                            <td><?php echo $users[$x][7];?></td>
                            <td><?php echo $users[$x][10];?></td>
                            <td><?php echo $users[$x][11];?></td>
                            <td><?php echo $users[$x][12];?></td>
                            <td>
                                <a href="002_user.php?uid=<?php echo $users[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <?php
                                    if($users[$x][13]==1)
                                    {
                                ?>
                                    <a href="002_aclController.php?task=8&id=<?php echo $users[$x][0];?>&disval=1"><span class="glyphicon glyphicon-arrow-up" style="font-size:x-large;color:#00b0f0;"></span></a>                                
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href="002_aclController.php?task=8&id=<?php echo $users[$x][0];?>&disval=0"><span class="glyphicon glyphicon-arrow-down" style="font-size:x-large;color:red;"></span></a>
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
<?php
    include_once('000_footer.php');
?>