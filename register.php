<?php
  session_start();
  if(isset($_SESSION['username'])) {
    header('Location: index.php');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <?php
    if (isset($_POST['submit'])) {
      $username = $_POST['username'];
      $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $db = mysqli_connect('localhost', 'root', '', 'e-shop');
      $sql = sprintf("INSERT INTO users (username, password) VALUES (
        '%s', '%s'
      )", mysqli_real_escape_string($db, $username),
          mysqli_real_escape_string($db, $hash));
      mysqli_query($db, $sql);
      mysqli_close($db);
      header('Location: index.php');
      exit();
    }
    ?>
    <form  class="user-form" action="" method="post">
      <h1>Register</h1>
      <div class="input-field-container">
          <span class="input-placeholder">Username</span>
          <input class="input-field" type="text" name="username">
          <span class="border"></span>
      </div>
      <div class="input-field-container">
          <span class="input-placeholder">Password</span>
          <input class="input-field" type="password" name="password">
          <span class="border"></span>
      </div>
      <div class="input-field-container">
          <span class="input-placeholder">E-mail</span>
          <input class="input-field" type="text" name="email">
          <span class="border"></span>
      </div>
      <input class="submit-button" type="submit" name="submit" value="Submit">
    </form>
    <script src="js/login.js" charset="utf-8"></script>
  </body>
</html>
