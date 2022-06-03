<?php
session_start();
session_destroy();
$url='login.php?err=99';
header("Location:$url");
?>