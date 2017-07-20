<?php
  session_start();
  if (!$_GET['id'] || !ctype_digit($_GET['id'])) {
    header('Location: products.php');
  } else {
    $id = $_GET['id'];
    $db = mysqli_connect('localhost', 'root', '', 'e-shop');
    $sql = "DELETE FROM products WHERE id=$id";
    mysqli_query($db, $sql);
    header('Location: products.php');
    exit();
  }
?>
