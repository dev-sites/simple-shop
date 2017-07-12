<?php
  if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    header('Location: index.php');
  }  
?>
