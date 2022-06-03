<?php
    //avoid direct access
    defined('__JEXEC') or ('Access denied');

    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    //session_start();
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if($DEBUG_STATUS)
    {
        echo 'USERID::'.$_SESSION['userid'].'<br>';
        echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
        //echo 'ROLE::'.$_SESSION['userRole'].'<br>';
    }
    if(isset($_SESSION['LAST_ACTIVITY']))
    {
        if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
        {
            $url="index.php?view=shop&layout=userlogout&tipo=2";
            header("Location:$url"); 
        }
        else
              $_SESSION['LAST_ACTIVITY'] = time();
    }
    else
        $_SESSION['LAST_ACTIVITY'] = time();

    $controller = new controller();
    if(isset($_POST['submitted']))
    {
        //$userId = $_POST['user_id'];
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }
        $updStatus = $controller->updateProfileIntereses($databasecon,$_POST["intereses_p"],$_POST["intereses_n"],$DEBUG_STATUS);

        if($DEBUG_STATUS)
            echo $updStatus.'<br>';
        if($updStatus==0)
        {
            $_SESSION["session_msg"]= 'INTERESES GUARDADO CORRECTAMENTE';
        }
        else
        {
            $_SESSION["session_msg"]= 'ERROR EN GUARDAR INTERESES';
        }
    }
    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }

    include_once('header.php');
?>
<br>
<br>

<form method="post" action=editDetallesIntereses.php enctype="multipart/form-data">
    <input type="hidden" name="submitted" value="true" />  
    <div class="container inner_body">
        <br>
        <br>
        <?php
            if(isset($_SESSION['userid']))
                    include_once('submenu.php');
        ?>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 bg-crimson">
                <br>
                <h3 style="text-align:center;color:#FFF;margin-top:1px">EDITAR MI INTERESES</h3>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 inner_body-block">
                
                <?php
                    
                    $usrDtl = $controller->getPerfil($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
                ?>
                <?php  if(isset($message)) 
                    {
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class='alert alert-success shopAlert'>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php  echo $message; ?>
                         </div>
                    </div>
                </div>
                <?php
                    }
                ?>
                <div class="row">
                    <div class="col-sm-12">
                         <fieldset class="servicepanel">
                            <legend><h3>Editar Detalles Intereses</h3></legend>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">INTERESES PERSONAL</span>
                                                    <textarea class="form-control" name="intereses_p" id="intereses_p" value="" rows="10" placeholder="Puedes ingresar su intereses personal -1000 caracteres" maxlength=1000 required><?php echo $usrDtl[8];?></textarea> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">INTERESES DE NEGOCIOS</span>
                                                    <textarea class="form-control" name="intereses_n" id="intereses_n" value="" rows="10" placeholder="Puedes ingresar su intereses personal -1000 caracteres" maxlength=1000 required><?php echo $usrDtl[9];?></textarea> 
                                                </div>
                                            </div>                                       
                                        <div class="col-sm-12 planificarviaje">
                                            <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</form>



<?php
    include_once('container_footer.php');
?>
