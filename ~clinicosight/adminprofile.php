
<?php
include("validation/header.php"); ?>
<form id="formID" class="formular" method="post" action="">
  <div align="center"><strong><b> <u>Admin Profile</u></b></strong></div>
Name<input name="adminname" id="adminid" type="text" class="validate[required] text-input"/>
Contact No<input name="contactno" id="contactno" type="text" class="validate[required] text-input"/>
Email ID<input name="emailid" id="emailid" type="text" class="validate[required,custom[email]] text-input"/>
<input name="button" id="button" type="submit" value="Update">
<input name="button" id="button" type="submit" value="cancel">
</form>
<?php
include("dbconnection.php");
$resrec= mysql_query("UPDATE admin SET adminname='$_POST[adminname]', contactno='$_POST[contactno]', emailid='$_POST[emailid]'
WHERE loginid = '1'");

?> 
