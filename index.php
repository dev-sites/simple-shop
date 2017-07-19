<?php
  // if (!$isSetup || !isset($isSetup)) {
  //   header('Location: setup/setup.php');
  //   exit();
  // }
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div class="container">
      <header>
        <div class="welcome-text">
          <?php
            if (isset($_SESSION['username'])) {
              echo '<p>Welcome ' . $_SESSION['username'] . ' ';
              echo '<a href="logout.php">Logout</a></p>';
            } else {
              echo '<p>Welcome, please <a href="login.php">Login</a> or <a href="register.php">Register</a></p>';
            }
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
              echo ' <p><a href="dashboard">Dashboard</a></p>';
            }
          ?>
        </div>
        <?php require 'tmpl/nav.tmpl.html'; ?>
      </header>
      <section class="products">
        <ul class="products-list">
          <?php
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            $sql = 'SELECT * FROM products';
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              printf('<li class="product">
                        <a href="products/product.php?id=%s"
                        <span class="product-title">%s</span>
                        <img class="product-image" src="%s"></img>
                        <span class="product-price">%s€</span>
                        </a>
                      </li>',$row['id'], $row['title'], $row['picture'], $row['price']);
            }
            mysqli_close($db);
          ?>
        </ul>
      </section>
      <!-- <section class="showcase">
        <div class="showcase-container">
          <img src="https://placehold.it/250" alt="">
          <h2 class="showcase-title">Product release segment</h2>
        </div>
      </section> -->
      <footer><span class="admin-login"><a href="admin.php">Admin Login</a></span></footer>
    </div>
  </body>
</html>
