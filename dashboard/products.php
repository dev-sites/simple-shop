<?php
  session_start();
  require '../authentication.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/typography.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/products.css">
  </head>
  <body>
    <?php
      $db = mysqli_connect('localhost', 'root', '', 'e-shop');
      if (isset($_POST['add-product'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $target_dir = "../img/";
        $fileName = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $fileName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $db_dir = "/simple-shop/img/";
        $db_file = $db_dir . $fileName;
        if($_FILES["image"]["name"]){
          $sql = sprintf("INSERT INTO products (title, picture, description, price) VALUES ('%s', '%s', '%s', '%s')", $title, $db_file, $description, $price);
        } else {
          $sql = sprintf("INSERT INTO products (title, description, price) VALUES ('%s', '%s', '%s')", $title, $description, $price);
        }
        mysqli_query($db, $sql);
        mysqli_close($db);
      }
    ?>
    <?php require('../tmpl/dashboard.tmpl.html'); ?>
    <section class="main-content">
      <div class="add-product">
        <input type="button" class="add-product-accordion" value="Add Product">
        <div class="add-product-form">
          <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="input-field-container">
              <span class="input-placeholder">Product Title</span>
              <input type="text" class="input-field" name="title" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Product Description</span>
              <input type="text" class="input-field" name="description" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Product Price</span>
              <input type="text" class="input-field" name="price" value="">
              <span class="border"></span>
            </div>
            <input type="file" name="image" value="Upload product image" class="image-upload-button" enctype="multipart/form-data">
            <input type="submit" class="submit-button" name="add-product" value="Add Product">
          </form>
          <div class="product-image">
            <p>The default product image is</p>
            <img src="../img/default_product.png" alt="">
            <p>Upload Image</p>
          </div>
        </div>
      </div>
      <div class="products">
        <ul>
          <?php
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            $sql = 'SELECT * FROM products';
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              printf('<li>%s</li>', $row['title']);
            }
          ?>
        </ul>
      </div>
    </section>
    <script src="../js/products.js" charset="utf-8"></script>
    <script src="../js/input.js" charset="utf-8"></script>
  </body>
</html>
