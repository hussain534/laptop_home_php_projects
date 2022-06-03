<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	$dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db
	#session_start();
	$DEBUG_STATUS=false;
    $products_per_page=4;
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
 
    /*Define select variables here*/
    $rn_id=0;
    $rn_client_id=0;
    $rn_item_name="";
    $rn_item_desc="";
    $rn_rate=0;
    $rn_price=0;
   

    if(isset($_GET["clientId"]))
        $clientId=$_GET["clientId"];
    else
        $clientId=0;
    if($DEBUG_STATUS)
    {
        echo 'Client Id::'.$clientId.'<br>';    
    } 


    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;
    if($DEBUG_STATUS)
    {
        echo 'Current Page::'.$current_page.'<br>';    
    }
 
    $total_count=0;

    $first_page=0;
    $last_page=0;
    $prev_page_count=0;
    $next_page_count=0;
    
    if($DEBUG_STATUS)
    {
        echo 'Current page no::'.$current_page.'<br>';    
    }        
    $sql = "SELECT rn_id, rn_client_id, rn_item_name, rn_item_desc, rn_rate, rn_price, rn_approved_by, rn_is_approved,
            rn_created_on, rn_modified_on, rn_created_by, rn_modified_by, rn_enable, rn_lang_id
            FROM RN_ITEMS WHERE rn_client_id=".$clientId;
   
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


    $sql = "select ri.rn_id,ri.rn_client_id,ri.rn_item_name,rc.rn_client_name,ri.rn_price,ri.rn_rate item_rate,
            rc.rn_show_price,rc.rn_category,rn_offer,rn_offer_start_dt,rn_offer_end_dt from rn_items ri, rn_clients rc 
            WHERE rc.rn_client_id=".$clientId." and ri.rn_client_id=rc.rn_client_id 
            order by rc.rn_rate,ri.rn_rate desc
            limit ".$current_page*$products_per_page.",".$products_per_page; 

    include_once('default_guestMainFilterPanel.php');
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
        			        	<li style="line-height:25px !important;font-weight:bold;" class="userMenu"><a href='index.php?view=shop&amp;layout=userHome' style="padding:3px 5px !important;"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
                                <li style="line-height:25px !important;" class="userMenu"><a href='index.php?view=shop&amp;layout=userProfile' style="padding:3px 5px !important;"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
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
        			            <li style="line-height:25px !important;" class="userMenu"><a href="index.php?view=shop&layout=userProfile" style="padding:3px 5px !important;"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
        			            <li style="line-height:25px !important;font-weight:bold;" class="userMenu"><a href="index.php?view=shop&layout=clientProfile" style="padding:3px 5px !important;"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
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
		    <div class="col-sm-12">
		      	<div class="add_button" style="width:90%;">
		          	<p style="float:left;padding:0 15px;color:darkcyan;"><?php echo 'Showing('.($current_page+1).'/'.$total_pages.')';?></p>
		      	</div>
		    </div>
		    <div class="col-sm-12">
		      	<div class="navi" style="width:90%;">
					<?php 
					if($current_page>0) 
					{ ?>
						<a href=index.php?view=shop&layout=userClientContainer&pagecount=0&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">First</a>
						<?php 
					}
					else 
					{ ?>
						<a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">First</a>
						<?php 
					}
					if($current_page>0) 
					{ ?>
						<a href=index.php?view=shop&layout=userClientContainer&pagecount=<?php echo $current_page-1; ?>&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">Prev</a>
						<?php 
					} 
					else 
					{ ?>
						<a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Prev</a>
						<?php 
					}
					if($current_page<$last_page) 
					{ ?>
						<a href=index.php?view=shop&layout=userClientContainer&pagecount=<?php echo $current_page+1; ?>&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">Next</a>
						<?php 
					} 
					else 
					{ ?>
						<a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Next</a>
						<?php 
					}
					if($current_page<$last_page) 
					{ ?>
						<a href=index.php?view=shop&layout=userClientContainer&pagecount=<?php echo $last_page; ?>&clientId=<?php echo $clientId; ?> style="float:left;padding:0 15px;">Last</a>
						<?php 
					} 
					else 
					{ ?>
						<a href="#" style="float:left;padding:0 5px;color:#ccc;cursor:default;">Last</a>
						<?php 
					}

					?>
		      	</div>
		    </div>

		</div>
	</div>
	<div class="container">            
		<div class="row">
			<?php      
            $result = mysqli_query($dbcon,$sql);
            $i=0;
            if(mysqli_num_rows($result) > 0)  
            {

              	while($row = mysqli_fetch_assoc($result)) 
              	{  
                	$i=$i+1;  
                	?>

                	<div class="col-sm-3">
                  		<div class="panel panel-primary">
                    		<div class="panel-heading">
                        		<p class="container-item-name"><a href=index.php?view=shop&layout=userItemContainer&itemId=<?php echo $row["rn_id"];?> style="color:white;"><?php echo $row["rn_item_name"];?></a></p>
                        		<?php 
                          		if(strcmp($row["rn_offer"], ""))
                          		{
                            		echo 	"<div class='offer' title='".$row['rn_offer']."'>
			                              		<div class='offerInside'>
			                                		<div class='offerHeading'>OFERTA</div>    
			                              		</div>
                            				</div>";
                        		}
                        		else
                          			echo "<div class='emptyoffer'></div>";
                      				?>
                    		</div>
                    		<div class="panel-body">
                      			<a href=index.php?view=shop&layout=userItemContainer&itemId=<?php echo $row["rn_id"];?> style="color:white;">
                      				<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $row["rn_client_id"];?>/<?php echo $row["rn_client_id"].'-'.$row["rn_id"].'.jpg';?> style="width:100%">
                      			</a>
                    		</div>
                    		<div class="panel-footer">
                      			<p class="container-item-price">$ <?php echo $row["rn_price"];?></p>                        
                        		<p class="container-item-rating">
	                          		<?php 
	                            	$rating_value =$row["item_rate"];
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
                        		<p class="container-item-clientName"><a href=index.php?view=shop&layout=userClientContainer&pagecount=0&clientId=<?php echo $row["rn_client_id"];?>><?php echo $row["rn_client_name"];?></a></p>
                        		<p class="container-item-category"><a href=index.php?view=shop&layout=userCategoryContainer&pagecount=0&category=<?php echo $row["rn_category"];?>><?php echo $row["rn_category"];?></p>
                        		<p class="container-item-details"><a href=index.php?view=shop&layout=userItemContainer&itemId=<?php echo $row["rn_id"];?>>View Details</a></p> 
                    		</div>
                  		</div>
                	</div>
                	<?php
                  	if($i%4==0)
                  	{
                    	?>
		</div>
	</div>
	<div class="container">    
		<div class="row">
					<?php
                  	}
                }
              }
                ?>
        </div>
	</div>
    <br>
    <?php
	}
	?>