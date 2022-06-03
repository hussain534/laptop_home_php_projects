
<?php

include("validation/header.php");
include("dbconnection.php");
$result = mysql_query("SELECT MAX(docid) FROM doctor");
while($row = mysql_fetch_array($result))
  {
$maxpatid = $row[0];
$maxpatid++;
  }

//insert doctors record
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
	
$sql="INSERT INTO doctor(doctorname, quali, specialistin, contactno, emailid, image, biodata,password )
VALUES
('$_POST[dfn] $_POST[dmn] $_POST[dln]' ,'$_POST[quali]','$_POST[spin]','$_POST[contact]','$_POST[emailid]','$data','$_POST[bio]','$_POST[password]')";

	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
  
}
?>
<?php
if(isset($_POST["button"]))
{
	$result = mysql_query("SELECT MAX(docid) FROM doctor");
while($row = mysql_fetch_array($result))
  {
$maxpatid = $row[0];
  }
	$docrec = mysql_query("SELECT * FROM doctor where docid ='$maxpatid'");
while($row = mysql_fetch_array($docrec))
  	{
   
	echo "<form id='formID1' class='formular' method='post' enctype='multipart/form-data'>";
	echo "<b>Doctor Record inserted successfully.. <br><br>";
	//image code ends here
	 echo "Doctor ID is : $row[docid]<br><br>";
	 echo "Doctor Name : $row[doctorname]<br><br>";
	 echo "Qualification : $row[quali]<br><br>";
	  echo "Specialist in : $row[specialistin]<br><br>";
	   echo "Contact No : $row[contactno]<br><br>";
	    echo "Email ID : $row[emailid]<br><br>";
		 echo "Biodata : $row[biodata]<br><br>";

	
echo "</b></form>";
 	}
	
}
else
{
?>        
<form id="formID" class="formular" method="post"  enctype="multipart/form-data">
  
    <div align="center"><strong>Doctors</strong></div>

  
    <p>Doctor ID
      <label for="dfn2"></label>
      <input type="text" name="dfn2" id="dfn2"  class="validate[required] text-input" readonly value="<?php echo $maxpatid; ?>"/>
      <label for="textfield4">Password</label>
      <input type="password" name="password" id="password"  class="validate[required] text-input"/>
      <label for="textfield3"> </label>
Confirm Password
<input type="password" name="textfield5" id="textfield5" class="validate[required,equals[password]] text-input" />
First Name
<label for="dfn"></label>
      <input type="text" name="dfn" id="dfn"  class="validate[required] text-input">
      
      
      Middle Name
      <input type="text" name="dmn" id="dmn"  class="validate[required] text-input">
      
      
      Last Name
      <input type="text" name="dln" id="dln"  class="validate[required] text-input">
      
      
      Qualification
      <input type="text" name="quali" id="quali"  class="validate[required] text-input">
      
      
      Specialist in 
      <input type="text" name="spin" id="spin" class="validate[required] text-input"/>
      <label for="spid"></label>
      
      Contact No
      <input type="text" name="contact" id="contact" class="validate[required] text-input">
      
      
      Email ID
      <input type="text" name="emailid" id="emailid" class="validate[required,custom[email]] text-input">
      
      
      Image
      <label for="image"></label>
      <input name="image" accept="image/jpeg" type="file">
      
      
      Bio-data
      <label for="bio"></label>
      <textarea name="bio" id="bio" cols="45" rows="5" ></textarea>
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
