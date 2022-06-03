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
        //$err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        #$messsage='User ID : '.$_SESSION["userid"];
        //$messsage='User Name : '.$_SESSION['userName'];
    }

    if(isset($_SESSION["clientid"]))
    {
    	$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';
	    if($DEBUG_STATUS)
	    {
	        echo 'Error code:'.$err_code.'<br>';
	    }

	    if(isset($_SESSION["session_msg"]))
	    {
	    	$messsage= $_SESSION["session_msg"];
	    	$err_code=2;
	    	unset($_SESSION["session_msg"]);
	    }

	    /*Define select variables here*/
	    $rn_id=0;
	    $rn_client_id=0;
	    $rn_item_name="";
	    $rn_item_desc="";
	    $rn_rate=0;
	    $rn_price=0;
	    $rn_approved_by="";
	    $rn_is_approved="";
	    $rn_created_on="";
	    $rn_modified_on="";
	    $rn_created_by="";
	    $rn_modified_by="";
	    $rn_enable="";
	    $rn_lang_id=0;
	    $rn_subcategory="";
	    $rn_tags="";

	    if(isset($_SESSION["userid"]))
	    {
	        $userId= $_SESSION["userid"];
	        $clientId=$_SESSION["clientid"];

	        #echo $clientId;

	        $total_count=0;

	        $first_page=0;
	        $last_page=0;
	        $prev_page_count=0;
	        $next_page_count=0;
	        if(isset($_GET["pagecount"]))
	            $current_page=$_GET["pagecount"];
	        else
	            $current_page=0;
	        if($DEBUG_STATUS)
	        {
	            echo 'Current page no::'.$current_page.'<br>';    
	        }        
	        $sql = "SELECT rn_id, rn_client_id, rn_item_name, rn_item_desc, rn_rate, rn_price, rn_approved_by, rn_is_approved,
	                rn_created_on, rn_modified_on, rn_created_by, rn_modified_by, rn_enable, rn_lang_id,rn_item_category,rn_subcategory,rn_tags
	                FROM RN_ITEMS WHERE rn_client_id=".$clientId;
	        /*$result = mysqli_query($dbcon,$sql);
	        if(mysqli_num_rows($result) > 0)  
	        {
	             while($row = mysqli_fetch_assoc($result)) 
	            {
	                $err_code=0; 
	                $rn_id=$row["rn_id"];
	                $rn_client_id=$row["rn_client_id"];
	                $rn_item_name=$row["rn_item_name"];
	                $rn_item_desc=$row["rn_item_desc"];
	                $rn_rate=$row["rn_rate"];
	                $rn_price=$row["rn_price"];
	                $rn_approved_by=$row["rn_approved_by"];
	                $rn_is_approved=$row["rn_is_approved"];
	                $rn_created_on=$row["rn_created_on"];
	                $rn_modified_on=$row["rn_modified_on"];
	                $rn_created_by=$row["rn_created_by"];
	                $rn_modified_by=$row["rn_modified_by"];
	                $rn_enable=$row["rn_enable"];
	                $rn_lang_id=$row["rn_lang_id"];
	            } 
	        }   */
	        

	        if($result = mysqli_query($dbcon,$sql))
	        {
	            $total_count=mysqli_num_rows($result);                
	        }
	        else
	            $total_count=0;
	        
	        
	        $total_pages=ceil($total_count/$products_per_page);
	        $last_page = $total_pages-1;
	        if($DEBUG_STATUS)
	        {
	            echo 'total_count::'.$total_count.'<br>';
	            echo 'total_pages::'.$total_pages.'<br>';
	            echo 'first_page::'.$first_page.'<br>';
	            echo 'last_page::'.$last_page.'<br>';    
	        }       


	        $sql = "SELECT ri.rn_id, rn_client_id, rn_item_name, rn_item_desc, 
	        (select IFNULL(round((sum(rn_rating)/count(rn_item_id)),2),0)   from rn_ratings where rn_item_id=ri.rn_id group by rn_item_id) rn_rate,
	        rn_price, rn_approved_by, rn_is_approved,rn_stock_qty,rn_delivery_time,
	                rn_created_on, rn_modified_on, rn_created_by, rn_modified_by, rn_enable, rn_lang_id, rn_offer,
	                rn_offer_start_dt,rn_offer_end_dt,rn_item_category,rn_subcategory,rn_tags
	                FROM RN_ITEMS ri WHERE rn_client_id=".$clientId." order by rn_created_on desc limit ".$current_page*$products_per_page.",".$products_per_page;
	        if($DEBUG_STATUS)
	        {
	            echo '<br>$sql::'.$sql;    
	        }
	    }

	    $sqlGetCategory="SELECT id, description FROM RN_CATEGORY";
	    $resultCategory = mysqli_query($dbcon,$sqlGetCategory);
	    include_once('default_catalogs.php');
	    $subcategoryArray=$category_sucategory_catalog;
    }
    else
    {
    	$messsage= "No client details found. Please Complete client profile first to add products.<a href='index.php?view=shop&amp;layout=clientProfile'>CLIENT PROFILE</a>";
	    $err_code=1;
	    	
    }
    


    include_once('default_guestMainFilterPanel2.php');

?>


<input type="hidden" id="subcategoryarr" value="<?php echo $subcategoryArray;?>">
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
                          <li><a href='index.php?view=shop&layout=orderHistory' class="userMenu-link"><span class='glyphicon glyphicon-list-alt'></span> ORDERS</a></li>
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
	      	<a href="index.php?view=shop&layout=addNewItemForm" class="submit_button" style="float:right"><button type="button" class="btn btn-success" style="margin-top:5px;">Add New Product</button></a></a>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12">
	      	<div class="add_button" style="width:90%;">
	          	<p style="float:left;padding:0 15px;color:darkcyan;"><?php echo 'Showing('.($current_page+1).'/'.$total_pages.')';?></p>
	      	</div>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12">
	      	<div class="navi" style="width:90%;">
				<?php 
				if($current_page>0) 
				{ ?>
					<a href="index.php?view=shop&layout=manageItems&pagecount=0" style="float:left;padding:0 15px;margin: 0 0 10px;">First</a>
					<?php 
				}
				else 
				{ ?>
					<p style="float:left;padding:0 15px;margin: 0 0 10px;color:#ccc;cursor:default;">First</p>
					<?php 
				}
				if($current_page>0) 
				{ ?>
					<a href="index.php?view=shop&layout=manageItems&pagecount=<?php echo $current_page-1; ?>" style="float:left;padding:0 15px;margin: 0 0 10px;">Prev</a>
					<?php 
				} 
				else 
				{ ?>
					<p style="float:left;padding:0 15px;margin: 0 0 10px;color:#ccc;cursor:default;">Prev</p>
					<?php 
				}
				if($current_page<$last_page) 
				{ ?>
					<a href="index.php?view=shop&layout=manageItems&pagecount=<?php echo $current_page+1; ?>" style="float:left;padding:0 15px;margin: 0 0 10px;">Next</a>
					<?php 
				} 
				else 
				{ ?>
					<p style="float:left;padding:0 15px;margin: 0 0 10px;color:#ccc;cursor:default;">Next</p>
					<?php 
				}
				if($current_page<$last_page) 
				{ ?>
					<a href="index.php?view=shop&layout=manageItems&pagecount=<?php echo $last_page; ?>" style="float:left;padding:0 15px;margin: 0 0 10px;">Last</a>
					<?php 
				} 
				else 
				{ ?>
					<p style="float:left;padding:0 15px;margin: 0 0 10px;color:#ccc;cursor:default;">Last</p>
					<?php 
				}

				?>
	      	</div>
	    </div>

	</div>
</div>


<?php
$result = mysqli_query($dbcon,$sql);
if(mysqli_num_rows($result) > 0)  
{
     while($row = mysqli_fetch_assoc($result)) 
    {
        $err_code=0; 
        $rn_id=$row["rn_id"];
        $rn_client_id=$row["rn_client_id"];
        $rn_item_name=$row["rn_item_name"];
        $rn_item_desc=$row["rn_item_desc"];
        $rn_rate=$row["rn_rate"];
        $rn_price=$row["rn_price"];
        $rn_approved_by=$row["rn_approved_by"];
        $rn_is_approved=$row["rn_is_approved"];
        $rn_created_on=$row["rn_created_on"];
        $rn_modified_on=$row["rn_modified_on"];
        $rn_created_by=$row["rn_created_by"];
        $rn_modified_by=$row["rn_modified_by"];
        $rn_enable=$row["rn_enable"];
        $rn_lang_id=$row["rn_lang_id"];
        $rn_offer=$row["rn_offer"];
        $rn_offer_start_dt=$row["rn_offer_start_dt"];
        $rn_offer_end_dt=$row["rn_offer_end_dt"];
        $rn_item_category=$row["rn_item_category"];
        $rn_subcategory=$row["rn_subcategory"];
        $rn_tags=$row["rn_tags"];
        $rn_stock_qty=$row["rn_stock_qty"];
        $rn_delivery_time=$row["rn_delivery_time"];
        ?>
        <form method="post" action=index.php?view=shop&layout=updatedeleteItems&pno=<?php echo $current_page;?> enctype="multipart/form-data">
			<input type="hidden" name="submitted" value="true" />                                        
	        <div class="container">            
				<div class="row">
					<div class="col-sm-3 profileDtl">
						<?php                                                     
	                        if(file_exists($target_dir . $rn_client_id.'-'.$rn_id.'.jpg'))
	                        {
	                            ?>
	                            <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $rn_client_id.'/'.$rn_client_id.'-'.$rn_id; ?>.jpg id="uploadImg" class="profileImage" />

	                            <div class="col-sm-12 itemDtl">
	                          		<div class="row">
				                         <?php
				                         	$filePattern='media/com_shop/images/clients/'.$row["rn_client_id"].'/'.$row["rn_client_id"].'-'.$row["rn_id"].'*.jpg';
				 							//echo $filePattern;
				 							$imgid=0;
											foreach (glob($filePattern) as $filename) 
											{
												$imgid=$imgid+1;
												?>								
												<div class="imageClipBar" style="border:1px solid #9d9d9d;padding:0;margin:0;">
					                    			<img class="imgClips" src= <?php echo $filename; ?> id=img<?php echo $imgid;?> onclick="changeImg(<?php echo $imgid;?>);"/>
												</div>
										<?php							    
											}
										?>
									</div>
							  </div>


	                            <?php
	                        }
	                        else
	                        {
	                            ?>
	                            <img src=<?php echo JURI::root().'media/com_shop/'; ?>images/unknown_user.png style="width:150px;" class="profileImage"/>
	                            <?php
	                        }
                        ?>
                        <p class="container-item-rating">
                          <?php 
                            $rating_value =$rn_rate;
                            echo $rn_rate;
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
                        <label for="imgId">Upload / Edit(Tamano max: 500KB, Resolucion : 400*400)</label>
                        <p>Editar su imagines aqui : <b>https://pixlr.com/editor</b></p>
                        <input type="file" name="fileToUpload" id="fileToUpload">   
                        <br>
                        <a href=index.php?view=shop&layout=manageImages&imageId=<?php echo $row["rn_id"];?> class="submit_button"><button type="button" class="btn btn-success">Add Images</button></a>
                        <?php 
                            if($rn_client_id)
                            {
                        ?>
                            <br>
                            <br>
                            <!-- <button type="submit" class="btn btn-success">Update</button></a> -->
                                                                                
                        <?php
                            }
                        ?> 
					</div>
					<div class="col-sm-9 itemDtl">
						<label for="rn_description">Description</label>
						<textarea name="rn_item_desc" class="form-control" maxlength=2500 placeholder="Description(Tamano maximo: 2500)" rows="16"><?php echo $rn_item_desc; ?></textarea>
					</div>
                </div>
                <div class="row">
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_item_name">Name</label>
                                <input type="text" class="form-control" maxlength=100 placeholder="Product Name(Tamano maximo: 100 :numeros o letras)"  name="rn_item_name" value="<?php echo $rn_item_name; ?>" required>
                            </div>
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_item_name">Stock Qty</label>
                        <input type="text" class="form-control" maxlength=10 placeholder="Available Qty(Tamano maximo: 5 :numeros)"  name="rn_stock_qty" id="stk_qty" onchange="return checkQty();" value="<?php echo $rn_stock_qty; ?>" required>
                            </div>
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_item_name">Delivery Time</label>
                        		<input type="text" class="form-control" maxlength=10 placeholder="Delivery Time(Tamano maximo: 2 :numeros)"  name="rn_delivery_time" id="del_time" onchange="return checkDeliveryTime();" value="<?php echo $rn_delivery_time; ?>" required>
                            </div>
                </div>
                <div class="row">
							<div class="col-sm-4 itemDtl">
								<label for="rn_id">Id</label>
                                <input type="text" class="form-control" size=25 name="rn_id" value="<?php echo $rn_id; ?>" readonly="true" >
							</div>
							<div class="col-sm-4 itemDtl">
								<label for="rn_client_id">Client Id</label>
                                <input type="text" class="form-control" size=25 name="rn_client_id" value="<?php echo $rn_client_id; ?>" readonly="true" >
							</div>                            
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_rate">Rating</label>                                   
                                <input type="text" class="form-control" size=25 name="rn_rate" value="<?php echo $rn_rate; ?>" readonly="true" >
                            </div>
                </div>
                <div class="row">
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_item_category">Category</label>
                                <!-- <input type="text" class="form-control" size=25 name="rn_item_category" value="<?php echo $rn_item_category; ?>"> -->
                                <input type="hidden" class="form-control" size=25 name="rn_item_category" id="category-Id" value="<?php echo $rn_item_category; ?>">
                                <select name="category" class="form-control countries" id="categoryId"  onchange="getSubCategories()" required>
                                    <option value="">Select Category</option>
                                    <?php
                                        if(mysqli_num_rows($resultCategory) > 0)  
                                        {
                                            while($rowCategory = mysqli_fetch_assoc($resultCategory)) 
                                            {
                                                echo $rowCategory["id"].'<br>';
                                                echo $rowCategory["description"].'<br>';
                                                echo "<option value='".$rowCategory["id"]."'>".$rowCategory["description"]."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_state">Sub Category</label>
                                <!-- <input type="text" class="form-control" size=25 name="rn_state" value="<?php echo $rn_state; ?>" required> -->
                                <input type="hidden" class="form-control" size=25 name="rn_subcategory" id="subcategory-Id" value="<?php echo $rn_subcategory; ?>">
                                <select name="subcategory" class="form-control states" id="subcategoryId" onchange="setSubCategory()" required>
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                            <div class="col-sm-4 itemDtl">
                                <label for="rn_tags">Tags</label>                                  
                                <input type="text" class="form-control" maxlength=200 placeholder="Keywords(tamano maximo: 100 :numeros o letras)"  name="rn_tags" id="rn_tags" value="<?php echo $rn_tags; ?>" required>
                            </div>
                </div>
                <div class="row">
							<div class="col-sm-4 itemDtl">
								<label for="rn_price">Price</label>                                  
                                <input type="text" class="form-control" size=25 id="price" name="rn_price" value="<?php echo $rn_price; ?>" required>
							</div>
							<div class="col-sm-4 itemDtl">
								<label for="rn_created_on">Created On</label>                                 
                                <input type="text" class="form-control" size=25 name="rn_created_on" value="<?php echo $rn_created_on; ?>" readonly="true" >
							</div>
							<div class="col-sm-4 itemDtl">
								<label for="rn_modified_on">Modified On</label>                                   
                                <input type="text" class="form-control" size=25 name="rn_modified_on" value="<?php echo $rn_modified_on; ?>" readonly="true" >
							</div>
                </div>
                <div class="row">
							<div class="col-sm-4 itemDtl">
								<label for="rn_created_by">Created By</label>                                    
                                <input type="text" class="form-control" size=25 name="rn_created_by" value="<?php echo $rn_created_by; ?>"  readonly="true" >
							</div>
							<div class="col-sm-4 itemDtl">
								<label for="rn_modified_by">Modified By</label>                                 
                                <input type="text" class="form-control" size=25 name="rn_modified_by" value="<?php echo $rn_modified_by; ?>"  readonly="true" >
							</div>
                            <div class="col-sm-4">
                                <label for="rn_enable">Enable</label>
                                    <?php 
                                        
                                        if(strcmp($rn_enable,"Y")==0) 
                                        {
                                    ?>
                                            <input type="radio" name="rn_enable" value="Y" checked="true">SI
                                            <input type="radio" name="rn_enable" value="N">NO
                                    <?php
                                        }
                                        else
                                        {
                                    ?>

                                            <input type="radio" name="rn_enable" value="Y">SI
                                            <input type="radio" name="rn_enable" value="N" checked="true">NO
                                    <?php
                                        }
                                    ?>
                            </div>                
                </div>
                <div class="row">
							<div class="col-sm-12 itemDtl">
								<label for="rn_item_desc">OFFER DETAILS</label>
								<textarea name="rn_offer" class="form-control" rows="3" maxlength=500 placeholder="Offer Descption(Tamano maximo: 500)" id="offerDesc"><?php echo $rn_offer; ?></textarea>
							</div>                
                </div>
                <div class="row">
							<div class="col-sm-6 itemDtl">
								<label for="rn_offer_start_dt">OFFER START FROM</label>                                 
                                <input type="date" class="form-control dateParam" size=25 name="rn_offer_start_dt" id="offerValidFrom" value="<?php echo $rn_offer_start_dt; ?>">
							</div>
							<div class="col-sm-6 itemDtl">
								<label for="rn_offer_end_dt">OFFER END ON</label>                                 
                                <input type="date" class="form-control dateParam" size=25 name="rn_offer_end_dt" id="offerValidTo" value="<?php echo $rn_offer_end_dt; ?>">
							</div>                
                </div>
                <div class="row">
                            <div class="col-sm-5 itemDtl">
                            </div>
                            <div class="col-sm-2 itemDtl">
                                <button type="submit" class="btn btn-success" onclick="return validateForm()">Update</button></a>
                            </div>
                            <div class="col-sm-5 itemDtl">
                            </div>
                </div>
                
			</div>
		</form>
		<script>
		function validateForm()
		{
			//alert("validateForm()");
			var offerDesc = document.getElementById("offerDesc").value;
			var offerValidFrom = document.getElementById("offerValidFrom").value;
			var offerValidTo = document.getElementById("offerValidTo").value;
			//alert("offerDesc:"+offerDesc);
			//alert("offerValidFrom:"+offerValidFrom);
			//alert("offerValidTo:"+offerValidTo);

			if(offerDesc!="" || offerValidFrom!="" || offerValidTo!="")
			{
				//alert("Checking");
				if(offerDesc==null || offerDesc=="" || offerValidFrom==null || offerValidFrom=="" || offerValidTo==null || offerValidTo=="")
				{
					alert("Please enter Offer Details, Offer Start From and Offer Ends On dates correctly");
					return false;
				}
				if(offerValidFrom > offerValidTo)
				{
					alert("Offer start from date should be always greater than Offer Ends on date");
					return false;
				}
					
			}

			return validatePrice();
			
		}

		function checkQty()
		{
		    if(isNaN(document.getElementById("stk_qty").value))
		    {
		        alert("STOCK QTY: Please enter only number value not > 99999");
		        document.getElementById("stk_qty").value=1;
		        return false;
		    }
		}
		function checkDeliveryTime()
		{
		    if(isNaN(document.getElementById("del_time").value))
		    {
		        alert("DELIVERY TIME: Please enter only number value not > 99");
		        document.getElementById("del_time").value=1;
		        return false;
		    }
		}
		</script>
        <?php
    }
}
}
?>

