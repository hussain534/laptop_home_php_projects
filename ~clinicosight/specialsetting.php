<form action="" method="post">
  <table width="1000" border="1">
    <tr>
      <td colspan="2">Specialist Settings</td>
    </tr>
    <tr>
      <td width="508">Specialist Type</td>
      <td width="476"><label for="sptype"></label>
      <input type="text" name="sptype" id="sptype"></td>
    </tr>
    <tr>
      <td>Comment</td>
      <td><label for="comment"></label>
      <textarea name="comment" id="comment" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="button" id="button" value="Add">
       &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="button2" id="button2" value="Cancel">
      </div></td>
    </tr>
  </table>
</form>
<?php
$con = mysql_connect("localhost","root","technology");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("clinicosight", $con);

$sql="INSERT INTO specialist(sptype, comment)
VALUES
('$_POST[sptype]','$_POST[comment]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con)
?>
