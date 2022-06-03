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

    if(isset($_SESSION["ACCESS_IDPROFILE"]))
        $id_profile=$_SESSION["ACCESS_IDPROFILE"];
    else
        $id_profile=0;

    if(isset($_SESSION["ACCESS_IDMENU"]))
        $idMenu=$_SESSION["ACCESS_IDMENU"];
    else
        $idMenu=0;    

    $access = $securityDBController->obtainAccessList($databasecon,$id_profile,$idMenu,$DEBUG_STATUS);
    //echo 'count::'.count($permisos);


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
            ACCESS
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
            <form method="post" action="002_aclController.php?task=4">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <label>PROFILE</label>
                        <select name="id_profile" class="form-control" id="id_profile" onChange="findAccessList()" required>
                            <option value=0><?php echo '[0]:TODO';?></option>
                            <?php 
                                $profile = $securityDBController->getPerfilList($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($profile);$i++)
                                {
                                    if($id_profile==$profile[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $profile[$i][0];?> selected="true"><?php echo '['.$profile[$i][0].']:'.$profile[$i][1].'_'.$profile[$i][3];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $profile[$i][0];?>><?php echo '['.$profile[$i][0].']:'.$profile[$i][1].'_'.$profile[$i][3];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>MENU</label>
                        <select name="idMenu" class="form-control" id="idMenu"  onChange="findAccessList()" required>
                            <option value=0><?php echo '[0][0]:TODO';?></option>
                            <?php 
                                $menu = $securityDBController->getMenuList($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($menu);$i++)
                                {
                                    if($idMenu==$menu[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $menu[$i][0];?> selected="true"><?php echo '['.$menu[$i][0].']['.$menu[$i][1].']:'.$menu[$i][2];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $menu[$i][0];?>><?php echo '['.$menu[$i][0].']['.$menu[$i][1].']:'.$menu[$i][2];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <br>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">ADD<span class="glyphicon glyphicon-chevron-right"></span></button>
                    
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>

    <?php
        if(isset($access))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>PROFILE NAME</td>
                            <td>MENU</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($access);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $access[$x][2];?></td> 
                            <td><?php echo $access[$x][4];?></td>
                            <td>
                                <?php
                                    if($access[$x][5]==1)
                                    {
                                ?>
                                    <a href="002_aclController.php?task=5&id=<?php echo $access[$x][0];?>&disval=1"><span class="glyphicon glyphicon-arrow-up" style="font-size:x-large;color:#00b0f0;"></span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href="002_aclController.php?task=5&id=<?php echo $access[$x][0];?>&disval=0"><span class="glyphicon glyphicon-arrow-down" style="font-size:x-large;color:red;"></span></a>
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