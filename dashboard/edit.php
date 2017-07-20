<?php
  session_start();
  if (!$_GET['id'] || !ctype_digit($_GET['id'])) {
    header('Location: products.php');
    exit();
  } else{
    $id = $_GET['id'];
    $title = '';
    $description = '';
    $price = '';
    $picture = '';
    $db = mysqli_connect('localhost', 'root', '', 'e-shop');
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($db, $sql);
    foreach ($result as $row) {
      $title = $row['title'];
      $description = $row['description'];
      $price = $row['price'];
      $picture = $row['picture'];
    }
  }
  if (isset($_POST['edit-product'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    if (isset($_FILES["image"]["name"])) {
      $target_dir = "../img/";
      $fileName = basename($_FILES["image"]["name"]);
      $target_file = $target_dir . $fileName;
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
      $db_dir = "/simple-shop/img/";
      $db_file = $db_dir . $fileName;
      $sql = "UPDATE products SET title='$title', picture='$db_file' description='$description', price='$price' WHERE id=$id";
    } else {
      $sql = "UPDATE products SET title='$title', description='$description', price='$price' WHERE id=$id";
    }
    mysqli_query($db, $sql);
    header('Location: products.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/typography.css">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/dashboard.css">
  </head>
  <body>
    <?php
      require('../tmpl/dashboard.tmpl.html');
    ?>
    <section class="main-content">
      <div class="edit-product">
        <span class="edit-title"><p>Edit Product</p></span>
        <form class="" action="" method="post">
          <div class="input-field-container">
            <span class="input-placeholder input-placeholder-focused">Product Title</span>
            <input type="text" name="title" class="input-field" value="<?php
              echo $title
            ?>
            ">
            <span class="border"></span>
          </div>
          <div class="input-field-container">
            <span class="input-placeholder input-placeholder-focused">Product Description</span>
            <input type="text" name="description" class="input-field" value="<?php
              echo $description
            ?>">
            <span class="border"></span>
          </div>
          <div class="input-field-container">
            <span class="input-placeholder input-placeholder-focused">Product Price</span>
            <input type="text" name="price" class="input-field" value="<?php
              echo $price
            ?>">
            <span class="border"></span>
          </div>
          <div class="product-image">
            <p>Current product image is</p>
            <img src="<?php
              echo $picture
            ?>" alt="">
            <p>Upload Image</p>
            <input type="file" name="image" value="Upload product image" class="image-upload-button" enctype="multipart/form-data">
          </div>
          <input class="submit-button" type="submit" name="edit-product" value="Edit Product">
        </div>
        </form>
    </section>
    <script src="../js/input.js" charset="utf-8"></script>
  </body>
</html>
