<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;
	

	if(isset($_SESSION["userid"]))
    {
    	$session_time=$session_expirry_time;
    	if(isset($_SESSION['LAST_ACTIVITY']))
	    {
			if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
			{
				$url="index.php?view=shop&layout=userLogout&tipo=2";
				header("Location:$url"); 
			}
            else
                $_SESSION['LAST_ACTIVITY'] = time();
		}
		else
			$_SESSION['LAST_ACTIVITY'] = time();
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
    }

    if(isset($_GET['itemId']))
    	$imageCode = $_GET['itemId'];
   	else
   		$imageCode = 0;
    #include_once('default_guestMainFilterPanel2.php');
?>



<div class="container">  
	<div class="row">
        <div class="col-sm-12">
        <?php 
           if ($err_code==2)
        {
            echo "<div class='alert alert-success shopAlert'>";
            ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $messsage;
            echo "</div>";
        }
        if($DEBUG_STATUS)
        {
        	echo '<br>err_code::'.$err_code;	
        }
        

        if ($err_code==1)
        {                          
        ?>
        <div class='alert alert-danger shopAlert'> 
            <?php
            echo $messsage;
            ?>             
            
        </div>
        </div>
    </div>
</div>
        <?php
        }
        if ($err_code==0 or $err_code==2)
        {
        ?>
        </div>
    </div>
</div>
<br>
<br>                                          
<div class="container" style="min-height:500px">            
	<div class="row">
		<div class="col-sm-4 itemDtl">
      		<div class="row">
      			<div class="col-sm-12 itemDtl">
                    <div class="row">
		                <?php
		                 	$filePattern='media/com_shop/images/clients/'.$_GET["clientCode"].'/'.$_GET["clientCode"].'-'.$imageCode.'*.jpg';
								//echo $filePattern;
								$imgid=0;
							foreach (glob($filePattern) as $filename) 
							{
								$imgid=$imgid+1;
						?>								
								<div class="imageClipBar" style="border:1px solid #9d9d9d;padding:0 2px;margin:1px;">
		                			<img class="img-responsive img-rounded imgClips" src= <?php echo $filename; ?> id=img<?php echo $imgid;?> onclick="changeImgInWindow(<?php echo $imgid;?>);"/>
								</div>
						<?php							    
							}
						?>
					</div>
				</div>
			</div>
	  	</div>
		<div class="col-sm-8 profileDtl"  id="magid" style="padding:10px;margin:0 auto;border-radius:5px;">			
			<!-- <span class='glyphicon glyphicon-zoom-in'  style="padding:0;margin:10px;"></span> -->
			<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $_GET["clientCode"].'/'.$_GET["clientCode"].'-'.$imageCode; ?>.jpg id="uploadImg1" class="profileImageInWindow" />
        </div>
		
    </div>
</div>
<br>
<br>
<?php
}
?>

