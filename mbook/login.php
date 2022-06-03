<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    //include_once('header.php');

    $msg='';
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
    if($err==0)
    {
        $msg= "<center>USER NOT EXIST. WANT TO <a href=userRegister.php>SIGN UP?</a></center>";
    }
    else if($err==2)
    {
        $msg= "<center>ERROR IN LOGIN. TRY LATER</center>";
    }
    else if($err==3)
    {
        $msg= "<center>INVALID CREDENTIALS. TRY WITH CORRECT CREDENTIALS</center>";
    }
    else if($err==99)
    {
        $msg= "<center>USER LOGGED OFF AND SESSION DESTROYED SUCCESSFULLY.</center>";
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
            <div class="alert alert-success" role="alert">
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
    <div class="row">
        <a href="index.php"><div class="col-sm-12"><img src="images/logo.png" class="logo_img"></div></a>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <h3>LOGIN</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="controller.php?controller=0&task=1">
                        <input type="hidden" name="submitted" value="true" />
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email Id / User Id" name="userEmail" required>
                        <input type="password" class="form-control navbar-btn" id="pwd" placeholder="Password" name="userPwd" required>
                        <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">
                            LOGIN
                        </button>
                    </form>
                </div>
                <div class="col-sm-1"></div> 
            </div> 
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">Dont have an account? <a href="userRegister.php"><b>SIGN UP</b></a></div>
    </div>
</div>