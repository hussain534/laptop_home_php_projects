<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    $err_code=0;

	if(!isset($_SESSION["userid"]))
    {   
        if($DEBUG_STATUS)
        {
            echo "Invalid session<br>";    
        }        
        $err_code=1;
        $messsage= "Invalid credentials or you are accessing this page directly. Try with correct login details.<a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a>";
    }
    else
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
        if(isset($_SESSION["message"]))
        {
            $messsage=$_SESSION["message"];
            $err_code=2;
            unset($_SESSION["message"]);
        }
    }

   
    include_once('default_guestMainFilterPanel2.php');
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

<?php
if (($err_code==0 or $err_code==2) and $_SESSION['userRole']==2)
{
?>  
<div class="container">  
    <div class="row">
        <div class="col-sm-12">
	        <div class="header">	    
			    <div class="alert loginRegister">
			        <ul>
			        	<li><a href='index.php?view=shop&amp;layout=userHome' class="userMenu-link"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
                        <li><a href='index.php?view=shop&amp;layout=userProfile' class="userMenu-link"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
                        <li><a href='index.php?view=shop&layout=manageCart' class="userMenu-link"><span class='glyphicon glyphicon-shopping-cart'></span> CHECKOUT</a></li>
                        <li class="userMenu-active"><a href='index.php?view=shop&layout=orderHistory' class="userMenu-link"><span class='glyphicon glyphicon-list-alt'></span> ORDERS</a></li>
			        </ul>
			    </div>	    
			</div>
        </div>
    </div>
</div>     
<?php
} 
else if (($err_code==0 or $err_code==2) and $_SESSION['userRole']==3)
{
    ?>    
    <div class="container">  
        <div class="row">
            <div class="col-sm-12">
                <div class="header">        
                    <div class="alert loginRegister">
    			        <ul>
    			        	<!-- <li><a href="index.php?view=shop&layout=userHome" class="userMenu-link"><span class='glyphicon glyphicon-home'></span> Home</a></li> -->
    			            <li><a href="index.php?view=shop&layout=userProfile" class="userMenu-link"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
    			            <li><a href="index.php?view=shop&layout=clientProfile" class="userMenu-link"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
    			            <li class="userMenu-active"><a href="index.php?view=shop&layout=manageItems&pagecount=0" class="userMenu-link-active"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
                            <li><a href="index.php?view=shop&layout=manageOffersForm" class="userMenu-link"><span class='glyphicon glyphicon-tag'></span> Offer</a></li>
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
					<div class="col-sm-12">
						<p class="sectionHeader">ORDER HISTORY</span></p>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table" id="t1" style="border:1px solid grey;">
				    	<thead class="order_item">
							<tr>
								<th class="order_item_title" style="text-align:center">ORDER NUM</th>
								<th class="order_item_title" style="text-align:center">RECIEVED</th>
                                <th class="order_item_title" style="text-align:center">RECIEVED DATE</th>
								<th class="order_item_title" style="text-align:center">CONFIRMATION</th>
								<th class="order_item_title" style="text-align:center">DISPATCH</th>
								<th class="order_item_title" style="text-align:center">DISPATCH DATE</th>
								<th class="order_item_title" style="text-align:center">DELIVERY</th>
                                <th class="order_item_title" style="text-align:center">ACTION</th>
								<!-- <th class="order_item_title" style="text-align:center">BILL NO</th> -->
							</tr>
						</thead>
						<tbody>
							
							<?php
								$sqlSelect = "select r.order_num, date_format(r.registration_portal,'%d-%m-%Y %H:%i') registration_portal,
								date_format(r.registration_call,'%d-%m-%Y %H:%i') registration_call,date_format(r.registration_dispatch,'%d-%m-%Y %H:%i') registration_dispatch,date_format(r.registration_delivery,'%d-%m-%Y %H:%i') registration_delivery,
								if(r.status_portal='1','OK','PENDING') status_portal,
								if(r.status_call='1','OK','PENDING') status_call,
								if(r.status_dispatch='1','OK','PENDING') status_dispatch,
								if(r.status_delivery='1','DONE','PENDING') status_delivery,r.factura from rn_order_management r 
								where r.user_id='".$_SESSION['userid']."' and r.status_portal=1 and order_status=0 group by r.order_num order by r.registration_portal desc";
								//echo $sqlSelect.'<br>';
								$resultSelect = mysqli_query($dbcon,$sqlSelect);
								if(mysqli_num_rows($resultSelect) > 0)  
								{
									while($rowSelect = mysqli_fetch_assoc($resultSelect)) 
									{	
							?>
							<tr>
								<td><a href=index.php?view=shop&layout=cartDetails&cartId=<?php echo $rowSelect['order_num'];?>><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['order_num'];?>" readonly></a></td>
                                <td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['status_portal'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['registration_portal'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['status_call'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['status_dispatch'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['registration_dispatch'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['status_delivery'];?>" readonly></td>
                                <?php
                                if(strcmp( $rowSelect['status_call'], "PENDING")==0)
                                {
                                ?>
								<td width="100px">
                                    <a href=index.php?view=shop&layout=orderCancel&orderId=<?php echo $rowSelect['order_num'];?> class="submit_button" onclick="return confirmDeleteOrder(<?php echo $rowSelect['order_num'];?>);"><button type="button" class="btn btn-success" title="Click to cancel your order"><span class='glyphicon glyphicon-remove'></span></button></a>
                                    <a href=index.php?view=shop&layout=orderEdit&orderId=<?php echo $rowSelect['order_num'];?> class="submit_button"><button type="button" class="btn btn-success" title="Click to modify your order"><span class='glyphicon glyphicon-pencil'></span></button></a>
                                </td>
                                <?php
                                }
                                else
                                    echo "<td></td>";
                                ?>
                                <!-- <td><input type="text" class="form-control text_style_03" value="<?php echo $rowSelect['factura'];?>" readonly></td>								 -->
							</tr>
							<?php
									}
								}
							?>
						</tbody>
					</table>
				</div>				
			</div>
		<br>
		<br>
        <script>
            function confirmDeleteOrder(ordId)
            {
                return confirm("Are you sure to delete order::"+ordId);
            }
        </script>
    <?php
}
?>

