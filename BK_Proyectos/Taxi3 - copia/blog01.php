<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        //echo 'inside<br>';
        $url="userlogin.php";
        $_SESSION["last_url"]='mispublicaciones.php';
        //echo $_SESSION["last_url"];
        header("Location:$url"); 
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }    
    include_once('header.php');
?>
<br>

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
            <form action="addBlog.php" method="post" enctype="multipart/form-data">
                <div class="row">                
                    <div id="message"></div>                
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src=images/imageNotAvailable.png id="uploadImg" style="width:100%;max-height:350px;border:3px double #222;"/>
                        <center><input type="file" name="fileToUpload" id="fileToUpload"></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 planificarviaje text-center">
                        <h2><input type="text" name="blog_title" class="form-control text-uppercase" style="text-align:center;font-size:26px" placeholder="TITULO"></h2>
                    </div>
                </div>
                <div id="blog_part01">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title01" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para01" class="form-control" id="para01" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800 required></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part02">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title02" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para02" id="para02" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part03">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title03" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para03" id="para03" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part04">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title04" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para04" id="para04" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part05">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title05" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para05" id="para05" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part06">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title06" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para06" id="para06" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part07">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title07" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para07" id="para07" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part08">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title08" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para08" id="para08" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part09">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title09" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para09" id="para09" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="blog_part10">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><input type="text" class="form-control text-uppercase" name="title10" placeholder="TITULO"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <textarea class="form-control" name="para10" id="para10" value="" rows="10" placeholder="Puedes ingresar texto de 800 caracteres" maxlength=800></textarea> 
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-12 planificarviaje">
                        <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <br>
</div>



<?php
    include_once('container_footer.php');
?>