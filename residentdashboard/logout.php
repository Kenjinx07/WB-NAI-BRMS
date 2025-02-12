<?php
  include '../config/session_manager.php';
  
  session_start();
  session_destroy();
  
  header("location:../index.php");
?>
