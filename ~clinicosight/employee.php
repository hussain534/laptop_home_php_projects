<?php
include("validation/header.php");
include("dbconnection.php");
$result = mysql_query("SELECT MAX(empid) FROM employee");
while($row = mysql_fetch_array($result))
  {
$maxpatid = $row[0];
$maxpatid++;
  }

//insert employee record
if(isset($_POST["button"]))
{

// UPLOAD IMAGE CODE

	// Temporary file name stored on the server
      $tmpName  = $_FILES['image']['tmp_name'];  
       
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);	
	  

//UPLOAD IMAGE CODE ENDS HERE AND IMAGE BINARY VALUE STORES IN VARIABLE $data
	
/*
$sql="INSERT INTO doctor(doctorname, quali, specialistin, contactno, emailid, image, biodata,password )
VALUES
('$_POST[dfn] $_POST[dmn] $_POST[dln]' ,'$_POST[quali]','$_POST[spin]','$_POST[contact]','$_POST[emailid]','$data','$_POST[bio]','$_POST[password]')";

	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
*/	  
}
?>
<?php
if(isset($_POST["button"]))
{
	$result = mysql_query("SELECT MAX(empid) FROM employee");
while($row = mysql_fetch_array($result))
  {
$maxpatid = $row[0];
  }
	$docrec = mysql_query("SELECT * FROM employee where empid ='$maxpatid'");
while($row = mysql_fetch_array($docrec))
  	{
   
	echo "<form id='formID1' class='formular' method='post' enctype='multipart/form-data'>";
	echo "<b>Employee Record inserted successfully.. <br><br>";
	//image code ends here
	 echo "Employee ID is : $row[empid]<br><br>";
	 echo "Employee Name : $row[empname]<br><br>";
	 echo "Designation : $row[designation]<br><br>";
	  echo "Address : $row[address]<br><br>";
	   echo "Contact No : $row[contactno]<br><br>";
	    echo "Email ID : $row[emailid]<br><br>";
		

	
echo "</b></form>";
 	}
	
}
else
{
?>        
<form id="formID" class="formular" method="post"  enctype="multipart/form-data">
  
    <div align="center"><strong>Employee</strong></div>

  
  <p>Employee ID
      <label for="efn2"></label>
      <input type="text" name="efn2" id="efn2"  class="validate[required] text-input" readonly value="<?php echo $maxpatid; ?>"/>
      <label for="textfield4">Password</label>
      <input type="password" name="password" id="password"  class="validate[required] text-input"/>
      <label for="textfield3"> </label>
Confirm Password
<input type="password" name="textfield5" id="textfield5" class="validate[required,equals[password]] text-input" />
First Name
<label for="efn"></label>
      <input type="text" name="efn" id="efn"  class="validate[required] text-input">
      
      
      Middle Name
      <input type="text" name="emn" id="emn"  class="validate[required] text-input">
      
      
      Last Name
      <input type="text" name="eln" id="eln"  class="validate[required] text-input">
      
      
      
      Designation 
      <input type="text" name="desig" id="desig"  class="validate[required] text-input">
    Address
<input type="text" name="add" id="add" class="validate[required] text-input"/>
      <label for="spid"></label>
      
      Contact No
      <input type="text" name="contact" id="contact" class="validate[required] text-input">
      
      
      Email ID
      <input type="text" name="emailid" id="emailid" class="validate[required,custom[email]] text-input">
      
      
      Image
    <label for="image"></label>
      <input name="image" accept="image/jpeg" type="file">
  </p>
<p>&nbsp;</p>
    <div align="center">
      <input type="submit" name="button" id="button" value="Add"  class="submit">
       &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="button2" id="button2" value="Cancel"  class="submit">
  </div><br /><br />
</form>
<?php
}
?>