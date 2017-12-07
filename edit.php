<?php
  session_start();
  require 'authentication.php';
  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: index.php');
    exit();
  }
  $email = '';
  $db = mysqli_connect('localhost', 'root', '', 'e-shop');
  $sql = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($db, $sql);
  foreach ($result as $row) {
    $email = $row['email'];
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
        if ($_POST['email']) {
          $sql = sprintf("UPDATE users SET email='%s' WHERE id='%s'", $_POST['email'], $id);
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
      email:
        <input type="text" name="email" value="<?php
          echo $email;
        ?>"><br><br>
      Password:
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Save">
    </form>
  </body>
</html>
