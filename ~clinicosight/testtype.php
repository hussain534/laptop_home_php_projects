
<?php
include("validation/header.php"); ?>
<form id="formID" class="formular" method="post">
  <div align="center"><strong><b> <u>Test Types</u></b></strong></div>
 <p> Test Type 
  <label for="textfield"></label>
<input type="text" name="textfield" id="textfield" class="validate[required] text-input">

Sub Type 
  <input type="text" name="textfield2" id="textfield2" >

Description 
  <label for="textarea"></label>
  <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>


  <input type="submit" name="button" id="button" value="Add">
  <input type="submit" name="button2" id="button2" value="Update"> 
  <input type="submit" name="button3" id="button3" value="Cancel">

</form>
