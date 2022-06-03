<?php

    defined('__JEXEC') or ('Access denied');
    session_start();
    
    /*

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }*/
    include_once('util.php');

?>


<div class="container">
    <div class="row data">
        <?php
            include_once('header.php');
        ?>
    </div>
    
    <div class="row data canvas backgrnd">
        <!-- <div class="col-sm-9 text-center backgrnd">
        </div> -->
        <br>
        <div class="col-sm-3 text-center "></div>
        <div class="col-sm-6 text-center ">
            <?php  
            if(isset($_GET["msgId"])) 
            {
            ?>
            <div class="row data">
                <br>
                <div class="col-sm-12 text-center">
                    <div class='alert alert-success shopAlert'>
                        <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                        <?php  
                            if($_GET["msgId"]==0)
                                echo 'USER LOGGED OUT SUCCESSFULLY'; 
                            else if($_GET["msgId"]==1)
                                echo 'INVALID CREDENTIALS';
                            else if($_GET["msgId"]==9)
                                echo 'SESSION EXPIRED. LOGIN AGAIN';
                            else
                                echo 'UNKNOWN ERROR'; 
                        ?>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <h1 style="color:black">LOGIN</h1>
                    <form method="post" action="datacontroller.php?dojob=0&metodo=0">
                        <input type="hidden" name="submitted" value="true">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input id="user_email" type="email" class="form-control" name="user_email" placeholder="ENTER USER EMAIL">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input id="user_pwd" type="password" class="form-control" name="user_pwd" placeholder="ENTER USER PASSWORD">
                        </div>

                        <div class="input-group">
                            <input type="submit" value="LOGIN" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row data">
        <?php
            include_once('footer.php');
        ?>
    </div>
</div>
