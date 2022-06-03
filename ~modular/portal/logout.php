<?php
session_start();
session_destroy();
//unset($_SESSION['ERR']);
$url='../index.php';
header("Location:$url");
?>