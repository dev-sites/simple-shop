<?php
  session_start();
  if ($_SESSION['isAdmin'] === 0 || !$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/typography.css">
    <link rel="stylesheet" href="../css/dashboard.css">
  </head>
  <body>
      <?php
        require('../tmpl/dashboard.tmpl.html')
      ?>
      <section class="main-content">
        <div class="user-info">
          <span class="dashboard-item"><p>Registered users
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <?php
            $numberOfUsers = 0;
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            $sql = "SELECT * FROM users";
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              $numberOfUsers += 1;
            }
            echo $numberOfUsers;
          ?></p></span>
          <span class="dashboard-item"><p>Number of orders
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <?php
            $numberOfOrders = 0;
            $sql = "SELECT * FROM orders";
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              $numberOfOrders += 1;
            }
            echo $numberOfOrders;
          ?></p></span>
          <span class="dashboard-item"><p>Number of products
            <i class="fa fa-tags" aria-hidden="true"></i>
            <?php
            $numberOfProducts = 0;
            $sql = "SELECT * FROM products";
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              $numberOfProducts += 1;
            }
            echo $numberOfProducts . ' ';
            mysqli_close($db);
          ?></p></span>
        </div>
      </section>
  </body>
</html>
