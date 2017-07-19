<?php
  session_start();
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $db = mysqli_connect('localhost', 'root', '', 'e-shop');
    $sql = sprintf("SELECT * from users WHERE username='%s'",
        mysqli_real_escape_string($db, $_POST['username'])
    );
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row && $row['isAdmin']) {
      $hash = $row['password'];
      $isAdmin = $row['isAdmin'];
      $id = $row['id'];
      $isAdmin = $row['isAdmin'];
      if (password_verify($_POST['password'], $hash)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['isAdmin'] = $isAdmin;
        $_SESSION['id'] = $id;
        $_SESSION['isAdmin'] = $isAdmin;
        header('Location: dashboard/');
        exit();
      } else {
        echo 'Wrong username or password';
      }
    } else {
      echo 'Wrong username or password';
    }
    mysqli_close($db);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div class="form-container">
      <form  class="input-form" action="" method="post">
        <h1>Login</h1>
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
        <input class="submit-button" type="submit" value="Login">
      </form>
      <script src="js/input.js" charset="utf-8"></script>
    </div>
  </body>
</html>
