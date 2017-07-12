<?php
  session_start();
  require 'authentication.php';
  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: index.php');
    exit();
  }
  $username = '';
  $db = mysqli_connect('localhost', 'root', '', 'e-shop');
  $sql = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($db, $sql);
  foreach ($result as $row) {
    $username = $row['username'];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit user</title>
  </head>
  <body>
    <?php
      if (isset($_POST['submit'])) {
        if ($_POST['username']) {
          $sql = sprintf("UPDATE users SET username='%s' WHERE id='%s'", $_POST['username'], $id);
          $result = mysqli_query($db, $sql);
        }
        if ($_POST['password']) {
          $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
          $sql = sprintf("UPDATE users SET password='%s' WHERE id='%s'", $hash, $id);
          $result = mysqli_query($db, $sql);
        }
        header('Location: index.php');
        exit();
      }
    ?>
    <form action="" method="post">
      Username:
        <input type="text" name="username" value="<?php
          echo $username;
        ?>"><br><br>
      Password:
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Save">
    </form>
  </body>
</html>
