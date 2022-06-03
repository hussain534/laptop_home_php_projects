<?php
session_start();
session_destroy();
//unset($_SESSION['ERR']);
$url='index.php?err=99';
header("Location:$url");
?>