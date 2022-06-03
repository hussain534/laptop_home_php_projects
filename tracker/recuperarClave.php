<?php
    session_start();
    include_once('util.php');
    include_once('header.php');
    $msg='';
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }
?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(strlen($msg)>0)
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="controladorProceso.php?proceso=0&task=2">
                        <input type="hidden" name="submitted" value="true" /> 
                        <h3 class="modal-title text-center">RECUPERAR CLAVE</h3>
                        <input type="email" class="form-control navbar-btn" id="user_email" placeholder="Email" name="user_email" required>
                        <br>                        
                        <center>
                            <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">RECUPERAR CLAVE<span class="glyphicon glyphicon-chevron-right"></span></button>
                            <br>
                            <br>
                            Tienes cuenta. Haz clic aqui para <a href="index.php">LOGIN</a>
                        </center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>