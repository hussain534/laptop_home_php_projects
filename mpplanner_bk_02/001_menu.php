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

    if(isset($_GET["mid"]))
    {
        $menu = $securityDBController->getMenuList($databasecon,$_GET["mid"],$DEBUG_STATUS);
        $id=$menu[0][0];
        $id_menu=$menu[0][1];
        $menu_name=$menu[0][2];
        $url=$menu[0][3];
    }
    else
    {
        $id=0;
        $id_menu=null;
        $menu_name='';
        $url='';
    }

    $menu = $securityDBController->getMenuList($databasecon,0,$DEBUG_STATUS);
        

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
            MENU
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
            <form method="post" action="001_loginController.php?task=4">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>MENU ID</label>
                        <input type="RUC" class="form-control navbar-btn" id="id_menu" placeholder="SECUENCIAL" name="id_menu" value="<?php echo $id_menu;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>MENU NAME</label>
                        <input type="nombre" class="form-control navbar-btn" id="menu_name" placeholder="NOMBRE" name="menu_name" value="<?php echo $menu_name;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>URL</label>
                        <input type="contacto" class="form-control navbar-btn" id="url" placeholder="URL" name="url" value="<?php echo $url;?>"required>
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
        if(isset($menu))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>SEQUENCE</td>
                            <td>MENU NAME</td>
                            <td>URL</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($menu);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $menu[$x][1];?></td> 
                            <td><?php echo $menu[$x][2];?></td>
                            <td><?php echo $menu[$x][3];?></td>
                            <td>
                                <a href="menu.php?mid=<?php echo $menu[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <?php
                                    if($menu[$x][4]==1)
                                    {
                                ?>
                                    <a href="loginController.php?task=5&id=<?php echo $menu[$x][0];?>&disval=1"><span class="glyphicon glyphicon-arrow-up" style="font-size:x-large;color:#00b0f0;"></span></a>                                
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href="loginController.php?task=5&id=<?php echo $menu[$x][0];?>&disval=0"><span class="glyphicon glyphicon-arrow-down" style="font-size:x-large;color:red;"></span></a>
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