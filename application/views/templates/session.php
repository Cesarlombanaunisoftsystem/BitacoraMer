<?php
  session_start();
  // error_reporting(0);
  $criterio = $_SESSION["profile"];
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); #no cache
  header("Cache-Control: post-check=0, pre-check=0", false); #no cache
  header("Pragma: no-cache"); #no cache
  if(!isset($_SESSION['profile'])){
  	echo "<script>localStorage.clear();window.location.href = 'index.php';</script>";
  }
?>
