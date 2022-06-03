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
    $controller = new controller();
    $blogDtl=$controller->getBlogById($databasecon,$_GET["id"],$DEBUG_STATUS);
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
                <div class="row">                
                    <div id="message"></div>                
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src=<?php echo $blogDtl[0][3];?> id="uploadImg" style="width:100%;max-height:350px;border:3px double #222;"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 planificarviaje text-center">
                        <h2><?php echo strtoupper($blogDtl[0][4]);?></h2>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-12 planificarviaje text-right">
                        <h5><?php echo $blogDtl[0][2];?>  <span class="glyphicon glyphicon-calendar"></span></h5>
                        <h5><?php echo strtoupper($blogDtl[0][1]);?>  <span class="glyphicon glyphicon-pencil"></span></h5>
                    </div>
                </div>
                <div id="blog_part01">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][5]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                             <p><?php echo $blogDtl[0][6];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part02">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][7]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][8];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part03">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][9]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][10];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part04">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][11]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][12];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part05">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][13]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][14];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part06">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][15]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][16];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part07">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][17]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][18];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part08">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][19]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][20];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part09">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][21]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][22];?></p>
                        </div>
                    </div>
                </div>
                <div id="blog_part10">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo strtoupper($blogDtl[0][23]);?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje text-justify">
                            <p><?php echo $blogDtl[0][24];?></p>
                        </div>
                    </div>
                </div>
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