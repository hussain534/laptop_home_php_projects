
<?php
include("validation/header.php"); ?>
<form id="formID" class="formular" method="post">
  
    
   <b> <u>Change Password</u> </b> <br /><br />
    
     Old Password
   <label for="textfield"></label>
      <input type="password" name="textfield" id="textfield" class="validate[required] text-input">
    
     New Password
     <input type="password" name="textfield2" id="textfield2" class="validate[required] text-input">
    
     Confirm Password
     <input type="password" name="textfield3" id="textfield3" class="validate[required,equals[textfield2]] text-input" >
    
    <div align="center">
        <input type="submit" name="button" id="button" value="Change Pasword">
  <input type="submit" name="button2" id="button2" value="Cancel">
      </div>
 
</form>
