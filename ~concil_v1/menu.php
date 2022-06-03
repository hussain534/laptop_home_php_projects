<?php
    session_start();

    if(!isset($_SESSION['LAST_ACTIVITY']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();

    if(isset($_GET["mid"]))
    {
        $menu = $controladorDB->getMenuList($databasecon,$_GET["mid"],$DEBUG_STATUS);
        $id=$menu[0][0];
        $id_menu=$menu[0][1];
        $nombre_menu=$menu[0][2];
        $url=$menu[0][3];
    }
    else
    {
        $id=0;
        $id_menu=null;
        $nombre_menu='';
        $url='';
    }

    $menu = $controladorDB->getMenuList($databasecon,0,$DEBUG_STATUS);
        

?>

<div class="container" style="min-height:700px">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            MENU
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(isset($msg))
            {
            ?>
            <div class="alert alert-info" role="alert">
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
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form method="post" action="controladorProceso.php?proceso=4&task=0">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>ID MENU</label>
                        <input type="RUC" class="form-control navbar-btn" id="id_menu" placeholder="SECUENCIAL" name="id_menu" value="<?php echo $id_menu;?>"required>
                    </div>
                    <div class="col-sm-4">
                        <label>NOMBRE MENU</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="NOMBRE" name="nombre" value="<?php echo $nombre_menu;?>"required>
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
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">AGREGAR<span class="glyphicon glyphicon-chevron-right"></span>
                    <?php
                        }
                        else
                        {
                    ?>
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">ACTUALIZAR<span class="glyphicon glyphicon-chevron-right"></span>
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
                            <td>SECUENCIAL</td>
                            <td>NOMBRE</td>
                            <td>URL</td>
                            <td>ACCION</td>
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
                                <a href="controladorProceso.php?proceso=4&task=1&id=<?php echo $menu[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
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
    include_once('footer.php');
?>