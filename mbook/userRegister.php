<?php
    defined('__JEXEC') or ('Access denied');
    include_once('util.php');
    #include_once('header.php');

    $msg='';
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=99;
    if($err==1)    
    {
        $msg= '<center>USER REGISTERED SUCCESSFULLY. <a href="login.php">LOGIN NOW</a></center>';
    }
    else if($err==0)
    {
         $msg= '<center>ERROR OCCURED. TRY LATER.</center>';
    }
    else if($err<0)
    {
         $msg= '<center>USER EXIST. TRY WITH OTHER DATA</center>';
    }
    else if($err==9)
    {
         $msg= '<center>ERROR OCCURED WHILE SENDING EMAIL, BUT USER REGISTERED SUCCESSFULLY. <a href="index.php">LOGIN NOW</a</center>';
    }
    else if($err==8)
    {
         $msg= '<center>ERROR OCCURED IN USER REGISTRATION. TRY LATER</center>';
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
            <h3>SIGN UP</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="controller.php?controller=0&task=0">
                        <input type="hidden" name="submitted" value="true" />
                        <input type="text" class="form-control navbar-btn" id="name" placeholder="Full Name" maxlength=100 name="userName" required>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email Id" maxlength=50 name="userEmail" required>
                        <input type="text" class="form-control navbar-btn" id="contactNo" placeholder="Mobile Number" maxlength=50 name="userContact" required>
                        <input type="hidden" class="form-control navbar-btn" id="password" value="password" name="userPwd" required>
                        <select name="userProfile" class="form-control" id="userProfile" required>
                            <option value="2">Teacher</option>
                            <option value="3">Student</option>
                        </select>
                       <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">
                           SIGN UP
                        </button>
                    </form>
                </div>
                <div class="col-sm-1"></div> 
            </div>   
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><p>Already have a <span class="logoText">M</span>Book account? <a href="login.php"><b>SIGN IN.</b></a></p></div>
    </div>
</div>