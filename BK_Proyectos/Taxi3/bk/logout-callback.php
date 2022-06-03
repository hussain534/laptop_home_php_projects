<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['email']);



  header('location: ../');
  exit;
?>
