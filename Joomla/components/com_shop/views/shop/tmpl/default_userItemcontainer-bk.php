<?php

defined('_JEXEC') or die('Restricted access');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
$dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db
$DEBUG_STATUS=false;
if(!isset($_SESSION["userid"]))
    {   
        if($DEBUG_STATUS)
        {
            echo "Invalid session<br>";    
        }
        
        $err_code=1;
        $messsage= "Invalid credentials or you are accessing this page directly. Try with correct login details.";
    }
    else
    {
        $err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        $messsage='User Name : '.$_SESSION['userName'];
    }
    if($DEBUG_STATUS)
    {
        echo 'Error code:'.$err_code.'<br>';
    }

	if(isset($_GET["itemId"]))
        $itemId=$_GET["itemId"];
    else
        $itemId=0;
    if($DEBUG_STATUS)
    {
        echo 'Item Id::'.$itemId.'<br>';    
    } 
    include_once('default_guestMainFilterPanel2.php');
?>

<div class="container">  
	<div class="row">
        <div class="col-sm-12">
        <?php 
            echo "<div class='alert alert-success shopAlert'>";
            ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $messsage;
            echo "</div>";
        if($DEBUG_STATUS)
        {
        	echo '<br>err_code::'.$err_code;	
        }
        

        if ($err_code==1)
        {                          
        ?>
        <div class='alert alert-danger shopAlert'>              
            <a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a>
        </div>
        </div>
    </div>
</div>
        <?php
        }
        if ($err_code==0)
        {
        ?>
        </div>
    </div>
</div>
<?php
if ($err_code==0 and $_SESSION['userRole']==2)
{
	?>  
	<div class="container">  
	    <div class="row">
	        <div class="col-sm-12">
		        <div class="header">	    
				    <div class="alert alert-info loginRegister">
				        <ul>
				        	<li style="line-height:25px !important;" class="userMenu"><a href='index.php?view=shop&amp;layout=userHome' style="padding:3px 5px !important;"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
	                        <li style="line-height:25px !important;font-weight:bold;" class="userMenu"><a href='index.php?view=shop&amp;layout=userProfile' style="padding:3px 5px !important;"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
				        </ul>
				    </div>	    
				</div>
	        </div>
	    </div>
	</div>     
	<?php
} 
else if ($err_code==0 and $_SESSION['userRole']==3)
{
    ?>    
    <div class="container">  
        <div class="row">
            <div class="col-sm-12">
                <div class="header">        
                    <div class="alert alert-info loginRegister">
    			        <ul>
    			        	<li style="line-height:25px !important;" class="userMenu"><a href="index.php?view=shop&layout=userHome" style="padding:3px 5px !important;"><span class='glyphicon glyphicon-home'></span> Home</a></li>
    			            <li style="line-height:25px !important;font-weight:bold;" class="userMenu"><a href="index.php?view=shop&layout=userProfile" style="padding:3px 5px !important;"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
    			            <li style="line-height:25px !important;" class="userMenu"><a href="index.php?view=shop&layout=clientProfile" style="padding:3px 5px !important;"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
    			            <li style="line-height:25px !important;" class="userMenu"><a href="index.php?view=shop&layout=manageItems&pagecount=0" style="padding:3px 5px !important;"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
    			        </ul>
    			    </div>	    
    			</div>
            </div>
        </div>
    </div>     
    <?php
}       
?>



<div class="container"> 
	<div class="row">
		<br>
		<?php 
            $sql="select ri.rn_id,rc.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_rate,ri.rn_price,rc.rn_phone,rc.rn_mobile,
						rc.rn_tollFree,rc.rn_address,ri.rn_item_desc,rn_offer,rn_offer_start_dt,rn_offer_end_dt from rn_items ri, rn_clients rc where ri.rn_id=".$itemId."
						and ri.rn_client_id=rc.rn_client_id";
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                 while($row = mysqli_fetch_assoc($result)) 
                {
                ?>
                	<div class="col-sm-4">
                		<div class="row">
		                	<div class="col-sm-12 itemDtl">
		                		<img src=<?php echo JURI::root().'media/com_shop/';?>images/clients/<?php echo $row["rn_client_id"].'/'.$row["rn_client_id"].'-'.$row["rn_id"].'.jpg'; ?> />
		                	</div>
		                	<div class="col-sm-12 itemDtl">
		                		<p class="container-item-name" style="color:black;"><?php echo $row["rn_item_name"];?></p>
	                        </div>
	                        <div class="col-sm-12 itemDtl">
	                			<p class="container-item-price" style="color:black;">$ <?php echo $row["rn_price"];?></p>
	                        </div>
	                        <div class="col-sm-12">
		                        <p class="container-item-rating">
		                          <?php 
		                            $rating_value =$row["rn_rate"];
		                            $rating_star_def=0.5;
		                            $rating_inicial = 0;                            
		                          	while($rating_value > ($rating_star_def*$rating_inicial))
		                            {
		                              if($rating_inicial%2==0)
		                                echo "<img src='".JURI::root()."media/com_shop/images/star_left_fill.png' />";
		                              else
		                                echo "<img src='".JURI::root()."media/com_shop/images/star_right_fill.png' />";
		                              $rating_inicial = $rating_inicial+1;
		                            }
		                            while($rating_inicial<10)
		                            {
		                              if($rating_inicial%2==0)
		                                echo "<img src='".JURI::root()."media/com_shop/images/star_left_empty.png' />";
		                              else
		                                echo "<img src='".JURI::root()."media/com_shop/images/star_right_empty.png' />";
		                              $rating_inicial = $rating_inicial+1;  
		                            } 
		                          ?>
		                        </p>
		                    </div>	
		                </div>
		            </div>
                	<div class="col-sm-4 itemDtl">
                		<label for="rn_item_desc">Description</label>
                		<textarea class="form-control" rows="23" readonly="true"><?php echo $row["rn_item_desc"]; ?></textarea>
                	</div>
                	<div class="col-sm-4">
                		<div class="row">
	                        <div class="col-sm-12 itemDtl">
	                			<label for="rn_client_name">Client</label>
	                        	<input type="text" class="form-control" name="rn_client_name" value="<?php echo $row["rn_client_name"]; ?>" readonly="true">
	                        </div>	                        
	                         <div class="col-sm-12 itemDtl">
	                			<label for="rn_phone">Phone</label>
	                        	<input type="text" class="form-control" name="rn_phone" value="<?php echo $row["rn_phone"]; ?>" readonly="true">
	                        </div>
	                         <div class="col-sm-12 itemDtl">
	                			<label for="rn_mobile">Celular</label>
	                        	<input type="text" class="form-control" name="rn_mobile" value="<?php echo $row["rn_mobile"]; ?>" readonly="true">
	                        </div>
	                         <div class="col-sm-12 itemDtl">
	                			<label for="rn_tollFree">TollFree</label>
	                        	<input type="text" class="form-control" name="rn_tollFree" value="<?php echo $row["rn_tollFree"]; ?>" readonly="true">
	                        </div>
	                        <div class="col-sm-12 itemDtl">
	                			<label for="rn_address">Address</label>
	                        	<input type="text" class="form-control" name="rn_address" value="<?php echo $row["rn_address"]; ?>" readonly="true">
	                        </div>
	                        <div class="col-sm-12 itemDtl">
	                			<label for="rn_offer">Offer Details</label>
                				<textarea class="form-control" rows="3" readonly="true"><?php echo $row["rn_offer"]; ?></textarea>
	                        </div>
	                        <div class="col-sm-12 itemDtl">
	                			<label for="rn_offer_start_dt">Offer Valid from</label>
                				<input type="text" class="form-control" name="rn_offer_start_dt" value="<?php echo $row["rn_offer_start_dt"]; ?>" readonly="true">
	                        </div>
	                        <div class="col-sm-12 itemDtl">
	                			<label for="rn_offer_end_dt">Offer Valid Upto</label>
                				<input type="text" class="form-control" name="rn_offer_end_dt" value="<?php echo $row["rn_offer_end_dt"]; ?>" readonly="true">
	                        </div>
	                    </div>
                	</div>
                <?php
                }
            }
        ?>
	    
	</div>
</div>



<?php

}
?>