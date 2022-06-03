<?php
$con = mysql_connect("localhost","merakiprod01","merakiprod01");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("clinicosight", $con);
?>