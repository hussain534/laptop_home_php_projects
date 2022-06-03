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
	$controller = new controller();
	$miblogs=$controller->miBlogs($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
  include_once('header.php');

?>
<br>
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
        <div class="col-sm-10 bg-crimson">
            <br>
            <h3 style="text-align:center;color:#FFF;margin-top:1px">MI BLOGS</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10 inner_body-block">
			<div class="row">
				
				<div id="message"></div>
				<div class="col-sm-12 text-right">
					<a href="blog01.php" style="border:2px solid #00b0f0;padding:5px 8px;border-radius:5px"><span>CREAR BLOG</span></a>
				</div>
				<div class="col-sm-12">
				&nbsp;
				</div>
				<div class="col-sm-12">
					<div class="row">
						<?php
						for($x=0;$x<count($miblogs);$x++)
						{
						?>
						<div class="col-sm-4 text-justify blog">							
							<img src=<?php echo $miblogs[$x][2];?> style="width:100%;min-height:200px" />
							<h4><?php echo strtoupper($miblogs[$x][3]);?></h4>
							<strong><?php echo $miblogs[$x][1];?></strong>
							<br>
							<br>
							<!-- <h5><?php echo strtoupper($miblogs[$x][4]);?></h5> -->
							<p><?php echo $miblogs[$x][5];?></p><a href="verBlog.php?id=<?php echo $miblogs[$x][0];?>">VER ESTE BLOG</a>
						</div>
						<?php
						if(($x+1)%3==0)
							echo '</div><div class="row">'
						?>						
						<?php
						}
						?>
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