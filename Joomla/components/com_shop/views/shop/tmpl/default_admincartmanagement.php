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
				$url="index.php?view=shop&layout=userlogout&tipo=2";
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
        if(isset($_GET["cartId"]))
        	$cartId = $_GET["cartId"];
        else
        	$cartId = 0;

        if(isset($_POST['submitted']))
        {
            if($DEBUG_STATUS)
            {
                echo "Inside submitted check<br>";
            }
            
            $st_cll = 0;
            $st_dis = 0;
            $st_del = 0;
            //echo $_POST['rn_status_call'].'<br>'.$_POST['rn_status_dispatch'].'<br>'.$_POST['rn_status_delivery'].'<br>';
            
            $updateSql = "update rn_order_management set status_call=".$_POST['rn_status_call'].",
                status_dispatch=".$_POST['rn_status_dispatch'].",status_delivery=".$_POST['rn_status_delivery']; 
            if($_POST['rn_status_call']==1)
                $updateSql = $updateSql." ,registration_call=now()";    
            if($_POST['rn_status_dispatch']==1)
                $updateSql = $updateSql." ,registration_dispatch=now()";    
            if($_POST['rn_status_delivery']==1)
                $updateSql = $updateSql." ,registration_delivery=now()";    

            $updateSql = $updateSql." where order_num=".$cartId;
            if(mysqli_query($dbcon,$updateSql))
            {
                $messsage="All status updated successfully";
                $err_code=2;
            }
            else
            {
                $messsage="Status updation failed.Please try later.";
                $err_code=1;
            }
        }

    }

   
    include_once('default_guestmainfilterpanel2.php');
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
			        	<li><a href='index.php?view=shop&amp;layout=userhome' class="userMenu-link"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
                        <li><a href='index.php?view=shop&amp;layout=userprofile' class="userMenu-link"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
                        <li><a href='index.php?view=shop&layout=managecart' class="userMenu-link"><span class='glyphicon glyphicon-shopping-cart'></span> CHECKOUT</a></li>
                          <li><a href='index.php?view=shop&layout=orderhistory' class="userMenu-link"><span class='glyphicon glyphicon-list-alt'></span> ORDERS</a></li>
			        </ul>
			    </div>	    
			</div>
        </div>
    </div>
</div>     
<?php
} 
else if (($err_code==0 or $err_code==2) and $_SESSION['userRole']==99)
{
    ?>    
    <div class="container">  
        <div class="row">
            <div class="col-sm-12">
                <div class="header">        
                    <div class="alert loginRegister">
    			        <ul>
    			        	<li class="userMenu-active"><a href="index.php?view=shop&layout=adminorderhistory" class="userMenu-link-active"><span class='glyphicon glyphicon-tag'></span> Orders</a></li>
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
				<div class="row order">
					<div class="col-sm-12 order_title">
						<b>ORDER-ID:</b>
						<?php echo $cartId;?>
					</div>
				</div><!-- 
				<div class="row order">
					<div class="col-sm-12 order_title">
						<b>DATE:</b>
						<?php echo date('D d-m-Y H:i:s');?>
					</div>
				</div> -->
				<div class="table-responsive">
					<table class="table" id="t0">
				    	<thead class="order_item">
							<tr>
								<th class="order_item_title">ITEM ID</th>
								<th class="order_item_title">ITEM NAME</th>
								<th class="order_item_title">CLIENT ID</th>
								<th class="order_item_title">CLIENT NAME</th>
								<th class="order_item_title">PRICE/QTY</th>
								<th class="order_item_title">QTY</th>
								<th class="order_item_title">TOTAL PRICE</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
								$sqlSelect = "SELECT status_portal,status_call,status_dispatch,status_delivery,
                                    item_id,item_name,client_id,client_name,price_per_unit, total_units,
									total_price FROM rn_order_management WHERE order_num=".$cartId;
									$resultSelect = mysqli_query($dbcon,$sqlSelect);
									if(mysqli_num_rows($resultSelect) > 0)  
									{
										while($rowSelect = mysqli_fetch_assoc($resultSelect)) 
										{	

                                            $status_portal=$rowSelect['status_portal'];
                                            $status_call=$rowSelect['status_call'];
                                            $status_dispatch=$rowSelect['status_dispatch'];
                                            $status_delivery=$rowSelect['status_delivery'];
							?>
							<tr>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['item_id'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" value="<?php echo $rowSelect['item_name'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['client_id'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" value="<?php echo $rowSelect['client_name'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" value="<?php echo $rowSelect['price_per_unit'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="3" value="<?php echo $rowSelect['total_units'];?>" readonly></td>
								<td><input type="text" class="form-control text_style_02" size="5" style="text-align:right" value="<?php echo $rowSelect['total_price'];?>" readonly></td>
							</tr>
							<?php
										}
									}
								//}
							?>
						</tbody>
					</table>
				</div>
				<div class="row order">
					<div class="col-sm-12 order_title">
						<input type="text" class="form-control text_style_02" size="10" id="total" style="text-align:right;font-weight:bold" readonly>
					</div>
				</div>

                <?php
                    if ($_SESSION['userRole']==2 or $_SESSION['userRole']==99)
                    {
                ?>
                <div class="row order">
                    <div class="col-sm-4">
                        <p class="sectionHeader" style="font-size:13px;margin:10px -12px;">DELIVERY ADDRESS</span></p>
                    </div>
                    <div class="col-sm-8">
                        
                    </div>
                </div>
                <?php
                    $sqlDir = "select rn_user_name,rn_contact_number,rn_calle_principal,rn_numeration_casa,rn_intersection,rn_referencia,rn_cuidad
                                from rn_order_address where rn_order_id=".$cartId;

                    $resultDirQuery = mysqli_query($dbcon,$sqlDir);

                    $rn_calle_principal="";
                    $rn_numeration_casa="";
                    $rn_intersection="";
                    $rn_referencia="";
                    $rn_cuidad="";
                    if(mysqli_num_rows($resultDirQuery) > 0)  
                    {
                        while($rowDirQuery = mysqli_fetch_assoc($resultDirQuery)) 
                        {  
                            $rn_user_name=$rowDirQuery["rn_user_name"];
                            $rn_contact_number=$rowDirQuery["rn_contact_number"];
                            $rn_calle_principal=$rowDirQuery["rn_calle_principal"];
                            $rn_numeration_casa=$rowDirQuery["rn_numeration_casa"];
                            $rn_intersection=$rowDirQuery["rn_intersection"];
                            $rn_referencia=$rowDirQuery["rn_referencia"];
                            $rn_cuidad=$rowDirQuery["rn_cuidad"];
                        }
                    }

                    if(!isset($rn_user_name))
                        $rn_user_name = $_SESSION['userName'];
                    if(!isset($rn_contact_number))
                        $rn_contact_number = $_SESSION['userContact'];
                    
                ?>

                <div class="row">
                    <div class="col-sm-8 itemDtl">
                        <label for="rn_user_name">Nombre</label>
                        <input type="text" class="form-control" maxlength=50 name="rn_user_name" value="<?php echo $rn_user_name; ?>" readonly="true">
                    </div>

                    <div class="col-sm-4 itemDtl">
                        <label for="rn_contact_number">Telefono</label>
                        <input type="text" class="form-control" maxlength=15 name="rn_contact_number" value="<?php echo $rn_contact_number; ?>" readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 itemDtl">
                        <label for="rn_calle_principal">Calle Principal</label>
                        <input type="text" class="form-control" maxlength=25 name="rn_calle_principal" value="<?php echo $rn_calle_principal; ?>" readonly="true">
                    </div>

                    <div class="col-sm-4 itemDtl">
                        <label for="rn_numeration_casa">Numeracion</label>
                        <input type="text" class="form-control" maxlength=10 name="rn_numeration_casa" value="<?php echo $rn_numeration_casa; ?>" readonly="true">
                    </div>
                    <div class="col-sm-4 itemDtl">
                        <label for="rn_intersection">Interseccion</label>
                        <input type="text" class="form-control" maxlength=25 name="rn_intersection" value="<?php echo $rn_intersection; ?>" readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 itemDtl">                        
                        <label for="rn_referencia">Referencia</label>
                        <input type="text" class="form-control" maxlength=50 name="rn_referencia" value="<?php echo $rn_referencia; ?>" readonly="true">
                    </div>
                    <div class="col-sm-4 itemDtl">
                        <label for="rn_cuidad">Cuidad</label>
                        <input type="text" class="form-control" name="rn_cuidad" value="QUITO" readonly="true">
                    </div>
                </div>
                <br>
                <form method="post" action=index.php?view=shop&layout=admincartmanagement&cartId=<?php echo $cartId;?> enctype="multipart/form-data">
                    <input type="hidden" name="submitted" value="true" />
                        <div class="row">
                            <div class="col-sm-4">
                                
                                    <?php 
                                        
                                        if(strcmp($status_call,"0")==0) 
                                        {
                                    ?>
                                        <label for="rn_enable">Confirmation</label>
                                            <input type="radio" name="rn_status_call" value="0" checked="true">Pending
                                            <input type="radio" name="rn_status_call" value="1">Confirmed
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <label for="rn_enable">Confirmation</label> : Confirmed<input type="hidden" name="rn_status_call" value="1">
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="col-sm-4">
                                
                                    <?php 
                                        
                                        if(strcmp($status_dispatch,"0")==0) 
                                        {
                                    ?>
                                        <label for="rn_enable">Dispatch</label>
                                            <input type="radio" name="rn_status_dispatch" value="0" checked="true">Pending
                                            <input type="radio" name="rn_status_dispatch" value="1">Confirmed
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <label for="rn_enable">Dispatch</label> : Confirmed<input type="hidden" name="rn_status_dispatch" value="1">
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="col-sm-4">
                                
                                    <?php 
                                        
                                        if(strcmp($status_delivery,"0")==0) 
                                        {
                                    ?>
                                        <label for="rn_enable">Delivery</label>
                                            <input type="radio" name="rn_status_delivery" value="0" checked="true">Pending
                                            <input type="radio" name="rn_status_delivery" value="1">Confirmed
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <label for="rn_enable">Delivery</label> : Confirmed<input type="hidden" name="rn_status_delivery" value="1">
                                    <?php
                                        }
                                    ?>
                            </div>                
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-success btn-success_style">Submit</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div>
                    </form>



				<?php
                }
                ?>
			</div>

		<br>
		<br>
	
    <?php
}
?>

