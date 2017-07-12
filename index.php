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
    <link rel="stylesheet" href="css/products.css">
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
              echo ' <p><a href="users.php">Manage users</a></p>';
            }
          ?>
        </div>
        <?php require 'tmpl/nav.tmpl.html'; ?>
      </header>
      <section class="products">
        <ul class="products-list">
          <li class="product"></li>
          <li class="product"></li>
          <li class="product"></li>
          <li class="product"></li>
          <li class="product"></li>
          <li class="product"></li>
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
