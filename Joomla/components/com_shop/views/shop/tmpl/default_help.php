<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	$dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db
	$products_per_page=20;

	$sql = "SELECT rn_client_id,rn_country,rn_state,rn_city FROM RN_CLIENTS WHERE rn_client_id=38";
			
	$result = mysqli_query($dbcon,$sql);
	if(mysqli_num_rows($result) > 0)  
	{
		 while($row = mysqli_fetch_assoc($result)) 
		{
			$rn_country=$row["rn_country"];
			$rn_state=$row["rn_state"];
			$rn_city=$row["rn_city"];
		}
	}

	$sql = "SELECT id,name FROM COUNTRIES order by id";			
	$result = mysqli_query($dbcon,$sql);

	include_once('default_catalogs.php');
	$statesArray=$countries_state_catalog;
	$citiesArray=$state_city_catalog;
	/*$sqlState = "SELECT concat(country_id,':',id,'~',name,'|') country_state FROM STATES order by country_id";
	$resultState = mysqli_query($dbcon,$sqlState);
	$statesArray="";
	if(mysqli_num_rows($resultState) > 0)  
	{
		while($row = mysqli_fetch_assoc($resultState)) 
		{
			//echo $row["country_state"];
			$statesArray=$statesArray.$row["country_state"];
			//echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
		}
	}*/

	/*$sqlCities = "SELECT concat(state_id,':',id,'~',name,'|') state_city FROM CITIES order by state_id";			
	$resultCities = mysqli_query($dbcon,$sqlCities);

	$citiesArray="";
	if(mysqli_num_rows($resultCities) > 0)  
	{
		while($row = mysqli_fetch_assoc($resultCities)) 
		{
			//echo $row["country_state"];
			$citiesArray=$citiesArray.$row["state_city"];
			//echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
		}
	}*/


?>
<script type="text/javascript">
  $(".category").hide();
</script>
<input type="hidden" id="statesarr" value="<?php echo $statesArray;?>">
<input type="hidden" id="citiesarr" value="<?php echo $citiesArray;?>">
<form method="post" action="index.php?view=shop&amp;layout=help">
	<input type="hidden" name="submitted" value="true" />
	<div class="container login" id="login">  
		<div class="row">
			<div class="col-sm-12">
				<p class="sectionHeader">GEO-LOCATION</span></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-12 itemDtl">
                        <label for="rn_country">Country</label>
                        <!-- <input type="text" class="form-control" size=25 name="rn_country" value=<?php echo $rn_country; ?> required> -->
                        <input type="text" class="form-control" size=25 name="rn_country" id="country-Id" value=<?php echo $rn_country; ?>>
                        <select name="country" class="form-control countries" id="countryId" onchange="getStates()" required >
                        	<option value="">Select Country</option>
                            <?php
	                            if(mysqli_num_rows($result) > 0)  
								{
									while($row = mysqli_fetch_assoc($result)) 
									{
										echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
									}
								}
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12 itemDtl">
                        <label for="rn_state">State</label>
                        <!-- <input type="text" class="form-control" size=25 name="rn_state" value="<?php echo $rn_state; ?>" required> -->
                        <input type="text" class="form-control" size=25 name="rn_state" id="state-Id" value="<?php echo $rn_state; ?>">
                        <select name="state" class="form-control states" id="stateId" onchange="getCities()" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                    <div class="col-sm-12 itemDtl">
                        <label for="rn_city">City</label>
                        <!-- <input type="text" class="form-control" size=25 name="rn_city" value=<?php echo $rn_city; ?> required> -->
                        <input type="text" class="form-control" size=25 name="rn_city" id="city-Id" value=<?php echo $rn_city; ?>>
                         <select name="city" class="form-control cities" id="cityId" onchange="setCity()" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
				</div>
				<div class="row">
					<div class="col-sm-12 col12  style-text-center">
						<button type="submit" class="btn btn-info loginSubmit">Submit</button>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
	</div>
</form>






