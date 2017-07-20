<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/typography.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/product.css">
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
              echo ' <p><a href="/simple-shop/dashboard">Dashboard</a></p>';
            }
          ?>
        </div>
        <?php require '../tmpl/nav.tmpl.html'; ?>
      </header>
      <section class="product-page">
        <?php
          $id = $_GET['id'];
          $db = mysqli_connect('localhost', 'root', '', 'e-shop');
          $sql = sprintf("SELECT * FROM products WHERE id='%s'", $id);
          $result = mysqli_query($db, $sql);
          foreach ($result as $row) {
            $title = $row['title'];
            $picture = $row['picture'];
            $description = $row['description'];
            $price = $row['price'];
          }
        ?>
        <div class="product-page-image">
          <img src="<?php echo $picture; ?>" alt="">
        </div>
        <div class="product-page-title">
          <h3><?php echo $title ?></h3>
        </div>
        <input class="buy-btn" type="button" name="" value="Buy Now!">
        <div class="product-page-desc">
          <p><?php echo $description ?></p>
        </div>
        <div class="product-page-price">
          <p><?php echo $price ?>€</p>
        </div>
      </section>
  </body>
</html>
