<?php
session_start();
session_destroy();
$url='index.php?err=99';
header("Location:$url");
?>