<?php

defined('_JEXEC') or die('Restricted access');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
include_once('default_catalogs.php');   
$dbcon = $databsecon;
$products_per_page=$items_per_page;
$most_view_limit=6;
?>
<div class="container-fluid category" style="margin:0 0 10px 0">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<div class="inner-addon left-addon" style="margin-bottom:5px">
						<form method="post" action="index.php?view=shop&amp;layout=searchguest">
							<span class="glyphicon glyphicon-search"></span>
							<input type="text" class="form-control" id="email" name="searchGuestParam" placeholder="Let me help you search what you are looking today" value=
							"<?php echo isset($_GET['searchGuest'])?$_GET['searchGuest']:'';?>"
							required>
							<button type="submit" class="btn btn-success">Go</button>
						</form>
					</div>
				</div>
				<div class="col-sm-3">
					<?php
						if(isset($_SESSION['userid']) and isset($_SESSION["Order_id"]))
						{
						$sqlCart = "select count(*) cart_count from rn_order_management r where r.user_id='".$_SESSION['userid']."' and r.order_num=".$_SESSION["Order_id"]." and r.status_portal=0";
						//echo $sqlCart;
						$resultCart = mysqli_query($dbcon,$sqlCart);
						if(mysqli_num_rows($resultCart) > 0)  
			            {
			            	if($row = mysqli_fetch_assoc($resultCart)) 
			              	{
			              	
					?>
					<a href="index.php?view=shop&layout=managecart" class="link01"><img src=<?php echo JURI::root().'media/com_shop/'; ?>images/newCart.png><span class="badge">
					<?php echo $row['cart_count']; }}}?> 
					</span></a>
				</div>
			</div>
		</div><!-- 
		<div class="col-sm-12">
			<div class="col-sm-12 hideme">
				<p id="hideme"><span class="glyphicon glyphicon-menu-down" title="Click to open/close rapid search panel"></span></p>
			</div>
	    </div> -->
	</div>
  	<!-- <div class="row">
		<?php    
	    	$sqlCategory="select ri.rn_id,ri.rn_item_name,count(page_id) counter from rn_visits rv, rn_items ri where substring(rv.page_id,6)=ri.rn_id and page_id like 'ITEM:%' group by rn_id order by count(page_id) desc limit 0,".$most_view_limit;
		?>
    	<div class="col-sm-12 mostViewedCategory">      
        	<span style="color:#337ab7">MOST VIEWED PRODUCTS: </span>
        		<?php
            		$resultCat = mysqli_query($dbcon,$sqlCategory);
            		if(mysqli_num_rows($resultCat) > 0)  
		            {
		                while($row = mysqli_fetch_assoc($resultCat))
		                {
		                	?>
		                  		<a class="list-child" href=index.php?view=shop&layout=itemcontainer&itemId=<?php echo $row["rn_id"];?> title="Click to view all products of this sub category"><p><?php echo $row["rn_item_name"];?> </p></a><span style="color:#337ab7;padding:0 0 0 15px;">|</span>
		                    <?php
		                }
		            }
				?>
        	
   		</div> 
  	</div>
  	<div class="row">
		<?php    
	    	$sqlCategory="select rc.id,rc.Description,count(page_id) counter from rn_visits rv, rn_category rc where substring(rv.page_id,6)=rc.id and page_id like 'CATE:%' group by rc.id order by count(page_id) desc limit 0,".$most_view_limit;
		?>
    	<div class="col-sm-12 mostViewedCategory">      
        	<span style="color:#337ab7">MOST VIEWED CATEGORIES: </span>
        		<?php
            		$resultCat = mysqli_query($dbcon,$sqlCategory);
            		if(mysqli_num_rows($resultCat) > 0)  
		            {
		                while($row = mysqli_fetch_assoc($resultCat))
		                {
		                	?>
		                  		<a class="list-child" href=index.php?view=shop&layout=categorycontainer&pagecount=0&category=<?php echo $row["id"];?> title="Click to view all products of this sub category"><p><?php echo $row["Description"];?> </p></a><span style="color:#337ab7;padding:0 0 0 15px;">|</span>
		                    <?php
		                }
		            }
				?>
        	
   		</div> 
  	</div>
  	<div class="row">
		<?php    
	    	$sqlCategory="select rc.rn_client_id,rc.rn_client_name,count(page_id) counter from rn_visits rv, rn_clients rc where substring(rv.page_id,6)=rc.rn_client_id and page_id like 'CLIE:%' group by rn_client_id order by count(page_id) desc limit 0,".$most_view_limit;
		?>
    	<div class="col-sm-12 mostViewedCategory">      
        	<span style="color:#337ab7">MOST VIEWED CLIENTS: </span>
        		<?php
            		$resultCat = mysqli_query($dbcon,$sqlCategory);
            		if(mysqli_num_rows($resultCat) > 0)  
		            {
		                while($row = mysqli_fetch_assoc($resultCat))
		                {
		                	?>
		                  		<a class="list-child" href=index.php?view=shop&layout=clientcontainer&pagecount=0&clientId=<?php echo $row["rn_client_id"];?> title="Click to view all products of this client"><p><?php echo $row["rn_client_name"];?> </p></a><span style="color:#337ab7;padding:0 0 0 15px;">|</span>
		                    <?php
		                }
		            }
				?>
        	
   		</div> 
  	</div>
	<div class="row">
		<?php
	    
	    	$sqlCategory="select  rc.id cat_id,rc.description cat_name,rs.id subcat_id,rs.Description subcat_name
	                  from rn_category rc, rn_subcategory rs where 
	                  rc.id=rs.id_category and (rc.id,rs.id) in
	                  (select distinct ri.rn_item_category,ri.rn_subcategory from rn_items ri)
	                  order by rc.Description,rs.Description";
		?>
	    

	    <div class="col-sm-12 filter-panel">
			<div class="row">
				<ul>
					<?php
					    $resultCat = mysqli_query($dbcon,$sqlCategory);
					    $cat_prev="NA";
					    if(mysqli_num_rows($resultCat) > 0)  
					    {
					        while($row = mysqli_fetch_assoc($resultCat))
					        {
								if($row["cat_id"]!=$cat_prev)
								{
									$cat_prev=$row["cat_id"];
					?> 

									<br>
									</div>
									<div class="col-sm-2 category-01">
									    <a class="category-list list-parent" href=index.php?view=shop&layout=categorycontainer&pagecount=0&category=<?php echo $row["cat_id"];?>  title="Click to view all products of this category"><p><b><?php echo strtoupper($row["cat_name"]);?></b></p></a>
									    <a class="category-list list-child" href=index.php?view=shop&layout=searchguestcontainer&pagecount=0&searchGuest=<?php echo $row["subcat_name"];?> title="Click to view all products of this sub category"><p><?php echo $row["subcat_name"];?></p></a>
					<?php
				          		}
				          		else
				          		{
				    ?>
				                	<a class="category-list list-child" href=index.php?view=shop&layout=searchguestcontainer&pagecount=0&searchGuest=<?php echo $row["subcat_name"];?> title="Click to view all products of this sub category"><p><?php echo $row["subcat_name"];?></p></a>
				    <?php 
								}
				        	}
				    	}
				    ?>
				</ul>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-12 hideme">
				<p id="hideme"><span class="glyphicon glyphicon-menu-down" title="Click to open/close rapid search panel"></span></p>
			</div>
	    </div>
		 
	</div> -->
</div>
