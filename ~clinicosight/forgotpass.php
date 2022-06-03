<?php
include("validation/header.php"); ?>
<form id="formID" class="formular" method="post">
  <div align="center"><strong><b> Forgot Password</b></strong></div> <p><p> Login ID 
  <label for="textfield"></label>
<input type="text" name="loginid" id="textfield" class="validate[required] text-input">

Email ID 
  <input type="text" name="emailid" id="textfield2" class="validate[required,custom[email]] text-input" >


  <input type="submit" name="button" id="button" value="Recover Password">
  <input type="submit" name="button2" id="button2" value="Cancel">

</form>