<?php
  session_start();  
  $del = $_GET['del'];
  echo $del;
  if (!$_GET['id'] || !ctype_digit($_GET['id'])) {
    header("Location: $del.php");
  } else {
    $id = $_GET['id'];
    $db = mysqli_connect('localhost', 'root', '', 'e-shop');
    $sql = "DELETE FROM $del WHERE id=$id";
    mysqli_query($db, $sql);
    header("Location: $del.php");
    exit();
  }
?>
