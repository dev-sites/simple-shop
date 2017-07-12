<?php
  session_start();
  if ($_SESSION['isAdmin'] === 0 || !$_SESSION['isAdmin']) {
    header('Location: index.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
  </head>
  <body>
    <div class="container">
      <header class="sidebar">
        <ul class="items-list">
          <li><a href="#">Products</a></li>
          <li><a href="#">Orders</a></li>
          <li><a href="#">Manage Users</a></li>
        </ul>
        <span><a href="../logout.php">Logout</a></span>
      </header>
      <section class="main-content">
        <div class="user-info">
          <p>Registered users: <?php
            $numberOfUsers = 0;
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            $sql = "SELECT * FROM users";
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              $numberOfUsers += 1;
            }
            mysqli_close($db);
            echo $numberOfUsers;
          ?></p>
        </div>
      </section>
    </div>
  </body>
</html>
