
<?php
$country=$_REQUEST['country'];
include("dbconnection.php");
$query="select state from state where countryid=$country";
$result=mysql_query($query);

?>
<select name="city">
<option>Select City</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value><?=$row['state']?></option>
<? } ?>
</select>
