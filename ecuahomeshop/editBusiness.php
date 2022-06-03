<?php

    session_start();
   
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    //session_start();
    
    require 'dbcontroller.php';
    $showListPanel=false;
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
            $url="index.php";
            session_start();
            session_destroy();
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


    if(isset($_GET['business_id']))
        $business_id=$_GET['business_id'];
    else
        $business_id='';
    include_once('util.php');    
    include_once('banner.php');
    include_once('menu.php');
    $_SESSION["currect_url"] = basename($_SERVER['REQUEST_URI']);


    $controller = new controller();
    $data = $controller->getBusinessData($databasecon,$business_id,$DEBUG_STATUS);
    
?>


<div class="container home-data">
    <br>
    <br>
    <div class="row">        
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 prolist">
            <?php
                include_once('listPanel.php');
            ?>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <div class="row">        
        <div class="col-sm-1">
        </div>
        <?php
            include_once('sidemenu.php');
        ?>
        <div class="col-sm-8 prolist">
            
            <?php
                include_once('listPanel.php');
            ?>
            <form method="post" action=datacontroller.php?job=21 enctype="multipart/form-data">
                <div class="home-data-panel">
                     <div class="row">
                         <div class="col-sm-12 text-right">
                            <?php 
                                if(isset($message))
                                    echo '<h3>'.$message.'</h3>';
                            ?>
                         </div>
                     </div>
                    <div class="row">                    
                        <div class="col-sm-2">
                            <div class="row">
                                <div class="col-sm-12 databox-img">
                                    <?php 
                                        if(isset($data[12]) && file_exists($data[12]))
                                        {
                                        ?>
                                            <center><img src=<?php echo $data[12].'?rand='.rand();?> id="uploadImg" class="profileImage" style="width:100%;"/></center>
                                        <?php
                                        }
                                        else
                                        {
                                            ?> 
                                            <center><img src=images/imageNotAvailable1.png id="uploadImg" style="width:100%;"/></center>
                                            <?php
                                        }   
                                    ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>                           
                        </div>
                        <div class="col-sm-10 databox-data">
                            <div class="row">
                                <div class="col-sm-3 text-right label-style-1"></div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="hidden" name="business_id" id="business_id" value="<?=$business_id;?>" class="form-control" readonly="true">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">NOMBRE</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_name" id="business_name" value="<?=$data[0];?>" class="form-control" placeholder="Ingresar nombre del negocio" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">CATEGORIA</div>
                                <div class="col-sm-9 databox-desc">
                                    <select name="business_category" class="form-control" id="business_category" required>
                                        <option value="0">Elige Tipo de negocio</option>
                                        <option value="1">GASTRONOMIA</option>
                                        <option value="2">ROPAS</option>
                                        <option value="3">EVENTOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">QUE ENCUENTRAS</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_hint" id="business_hint" value="<?=$data[2];?>" class="form-control" placeholder="Ingresar palabras claves de productos" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">DIRECCION</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_address" id="business_address" value="<?=$data[3];?>" class="form-control" placeholder="Ingresar su direccion" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">CELULAR</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_celular" id="business_celular" value="<?=$data[4];?>" class="form-control" placeholder="Ingresar su numero de celular" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">TELEFONO</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_tele" id="business_tele" value="<?=$data[5];?>" class="form-control" placeholder="Ingresar su numero convencional" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">EMAIL</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_email" id="business_email" value="<?=$data[6];?>" class="form-control" placeholder="Ingresar su correo electronico" required>
                                </div>
                            </div><!-- 
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">HORARIOS</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" class="form-control" placeholder="Ingresar su horarios">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">LATITUD</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_latitud" id="business_latitud" value="<?=$data[7];?>" class="form-control" placeholder="Ingresar su latitud">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">LONGITUD</div>
                                <div class="col-sm-9 databox-desc">
                                    <input type="text" name="business_longitud" id="business_longitud" value="<?=$data[8];?>" class="form-control" placeholder="Ingresar su longitud">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 databox-label text-right label-style-1">DESCRIPCION</div>
                                <div class="col-sm-9 databox-desc">
                                    <textarea name="business_desc" id="business_desc" value="" class="form-control" placeholder="Ingresar descripcion de su negocio" rows="10" required><?=$data[9];?></textarea>
                                </div>
                            </div>     
                        </div>                                         
                    </div>  
                    <br>                  
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary button-style">FINALIZAR</button>
                            </div>
                        </div>
                    </div>   
                </div>
            </form>

            <br>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
        include_once('footer.php');
    ?>
</div>