<?php
echo 'testing';
session_start();
echo 'NAME:'.$_SESSION['name'].'<br>';
echo 'ID'.$_SESSION['id'].'<br>';
echo 'EMAIL'.$_SESSION['email'].'<br>';
echo 'FNAME'.$_SESSION['firstname'].'<br>';
echo 'LNAME'.$_SESSION['lastname'].'<br>';
echo 'MNAME'.$_SESSION['middlename'].'<br>';
?>