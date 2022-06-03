<?php
    session_start();
    include_once('000_util.php');
    //include_once('header.php');
?>


<div class="container index" style="min-height:800px;">
    <br>
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <center><logo>MPPLANNER !!</logo></center>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="000_loginController.php?task=1">
                        <input type="hidden" name="submitted" value="true" /> 
                        <h3 class="modal-title text-center">LOGIN</h3>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" name="userEmail" required>
                        <input type="password" class="form-control navbar-btn" id="pwd" placeholder="Clave" name="userPwd" required>
                        <br>                        
                        <center>
                            <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">LOGIN<span class="glyphicon glyphicon-chevron-right"></span></button>
                            <br>
                            <br>
                            Forgot Password <a href="000_recoverPassword.php">RECOVER PASSWORD</a>
                        </center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

    <?php
        include_once('000_footer.php');
    ?>
