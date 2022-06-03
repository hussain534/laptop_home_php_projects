<?php
    //avoid direct access
    defined('__JEXEC') or ('Access denied');

    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
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
    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }

    include_once('header.php');
?>
<br>

<form method="post" action=insertDetallesAutomovil.php enctype="multipart/form-data">
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
            <div class="col-sm-10 inner_body-block">
                <div class="row">
                    <div class="col-sm-12" style="text-align:center">
                        <center><img src="images/icon_add.png"><img src="images/icon_taxi.png" class="sub-img"></center>
                        <h3 style="text-align:center;color:#222;margin-top:1px">PERFIL AUTOMOVIL</h3>
                    </div>
                </div>

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
                            <!-- <div class="row">
                                <div class="col-sm-12" style="text-align:center">
                                    <H3>LISTA DE AUTOMOVILES</H3>
                                </div>
                            </div> -->

                        <fieldset class="servicepanel">
                            <legend><h3>Detalle automovil</h3></legend>
                                <div class="row">
                                    <div class="col-sm-6">                                
                                        <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                        <p style="text-align:center">AUTOMOVIL</p>
                                        <center><input type="file" name="fileToUpload" id="fileToUpload" required>   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId" value="0" />                                       
                                    </div>
                                    <div class="col-sm-6">                                
                                        <center><img src=images/imageNotAvailable.png id="uploadImg2" class="docImage"/></center>
                                        <p style="text-align:center">MATRICULATION</p>
                                        <center><input type="file" name="fileToUpload2" id="fileToUpload2" required>   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId2" value="0" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">ID</span>
                                                    <input type="text" class="form-control" name="aid" value="0" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">MARCA</span>
                                                    <input type="text" class="form-control" name="marca" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">MODELO</span>
                                                    <input type="text" class="form-control" name="modelo" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">ANO</span>
                                                    <input type="text" class="form-control" name="ano" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">NRO ASIENTOS</span>
                                                    <input type="text" class="form-control" name="capacidad" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">NRO PLACA</span>
                                                    <input type="text" class="form-control" name="placa" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">NRO MATRICULA</span>
                                                    <input type="text" class="form-control" name="matriculation" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                </div>
                                <div class="row">                                
                                    <div class="col-sm-12 itemDtl">
                                        <button type="submit" class="btn btn-success btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                    </div>
                                </div>
                                <br><br>
                            
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