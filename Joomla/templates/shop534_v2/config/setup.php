<?php 

#DB connection Here

$dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db

$site_title='iProd';
$page_title='Login';

$messsage='';

#DEBUG
$DEBUG_STATUS=false;
$products_per_page=1;

?>