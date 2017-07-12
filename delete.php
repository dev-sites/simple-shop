<?php
  session_start();
  require 'authentication.php';
  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: index.php');
    exit();
  }
  $db = mysqli_connect('localhost', 'root', '', 'e-shop');
  $sql = "DELETE FROM users WHERE id=$id";
  mysqli_query($db, $sql);
  if ($_SESSION['id'] === $id) {
    session_destroy();
  }
  header('Location: users.php');
  exit();
?>
