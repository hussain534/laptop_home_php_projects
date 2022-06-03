<?php
session_start();
session_destroy();
$url='index.php?error=1';
header("Location:$url");
?>