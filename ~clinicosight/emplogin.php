<?php
include("validation/header.php"); 
?>
<p align="center"><strong>Staff Login  Page</strong></p>

<form id="formID" class="formular" method="post">

<strong>Staff Login  ID</strong>
<input type="text" name="userid" id="userid" class="validate[required] text-input" >
 
  
    <strong>Password</strong>
<input type="password" name="password" id="password" class="validate[required] text-input" >
 
   
    Type:  <select name="select" id="select" class="validate[required]">
<option value="">Select</option>
      <option value="Employee">Employee</option>
      <option value="Doctor">Doctor</option>
      <option value="Administrator">Administrator</option>
    </select>

        <input class="submit"  type="submit" name="login" id="login" value="Login"> 
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="submit" name="forgotpassword" value="Forgot Password" class="submit">      
</form>