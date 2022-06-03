<?php
include("validation/header.php"); ?>
<form id="formID" class="formular" method="post" action="">
<div align="center"><strong><b> Labtest</b></strong></div>
    Test ID  
      <input type="text" name="testid" id="textfield" class="validate[required] text-input" />
  </p>
  <p>Test Type 
    <label for="select"></label>
    <select name="ttype" id="select" class="validate[required]">
   <option value="">Select</option>
    <option >Blood</option>
     <option >Scanning</option></select>
  </p>
  <p>Patient ID 
    <input type="text" name="patid" id="textfield2" class="validate[required]"/>
  </p>
  <p>Employee ID
    <input type="text" name="empid" id="textfield3" class="validate[required]" />
  </p>
  <p> Lab Fee 
    <input type="text" name="labfee" id="textfield4" class="validate[required]"/>
  </p>
  <p>  Date  
    <input type="text" name="date" id="textfield7" />
  </p>
  <p> Time 
    <input type="text" name="time" id="textfield8" />
    <label for="fileField"></label>
  </p>
  <p>Treatment ID  
    <input type="text" name="treid" id="textfield5" class="validate[required]"/>
  </p>
  <p>Uploads
    <input type="file" name="uploads" id="fileField" />
  </p>
  <p>Comment  
    <label for="textarea"></label>
    <textarea name="comment" id="textarea" cols="45" rows="5"></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit">
    <input type="submit" name="button2" id="button2" value="Cancel">
  </p>
</form>
</body>
</html>


<?php
$con = mysql_connect("localhost","root","technology");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("clinicosight", $con);

$sql="INSERT INTO labtest (testid, ttypeid, patid, empid, labfee, date, time, treid, uploads, comment)
VALUES
('$_POST[labfee]','$_POST[date]','$_POST[time]','$_POST[treid]','$_POST[uploads]','$_POST[comment]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con)
?> 


