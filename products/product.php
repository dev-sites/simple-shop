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
            if (isset($_SESSION['email'])) {
              echo '<p>Welcome ' . $_SESSION['email'] . ' ';
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
          $db->set_charset("utf8");
          $sql = sprintf("SELECT * FROM products WHERE id='%s'", $id);
          $result = mysqli_query($db, $sql);
          foreach ($result as $row) {
            $title = $row['name'];
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
        <div class="product-page-price">
          <p><?php echo $price ?>Р</p>
        </div>
        <input class="buy-btn" type="button" name="" value="Buy Now!">
        <div class="product-page-desc">
          <p><?php echo $description ?></p>
        </div>
        
      </section>
  </body>
</html>
