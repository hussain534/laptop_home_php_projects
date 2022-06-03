<?php
    session_start();
    include_once('util.php');
    include_once('header.php');    
?>

<div class="container" style="min-height:700px;">
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
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="loginController.php?task=2">
                        <input type="hidden" name="submitted" value="true" /> 
                        <h3 class="modal-title text-center">RECOVER PASSWORD</h3>
                        <input type="email" class="form-control navbar-btn" id="user_email" placeholder="Email" name="user_email" required>
                        <br>                        
                        <center>
                            <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">RECOVER PASSWORD<span class="glyphicon glyphicon-chevron-right"></span></button>
                            <br>
                            <br>
                            You have an account. Click here to <a href="index.php">LOGIN</a>
                        </center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>