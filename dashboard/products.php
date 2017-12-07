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
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $status_id = $_POST['status_id'];
        $code = $_POST['code'];
        $target_dir = "../img/";
        $fileName = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $fileName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $db_dir = "/simple-shop/img/";
        $db_file = $db_dir . $fileName;
        if($_FILES["image"]["name"]){
          $sql = sprintf("INSERT INTO products (name, picture, description, price, category_id, status_id, code) VALUES ('%s', '%s', '%s', %s, %s, %s, %s)", $name, $db_file, $description, $price, $category_id, $status_id, $code);
        } else {
          $sql = sprintf("INSERT INTO products (name, description, price, category_id, status_id, code) VALUES ('%s', '%s', %s, %s, %s, %s)", $name, $description, $price, $category_id, $status_id, $code);
        }
        mysqli_query($db, $sql);
        mysqli_close($db);
      }
    ?>
    <?php require('../tmpl/dashboard.tmpl.html'); ?>
    <section class="main-content">
      <div class="add-product">
        <input type="button" class="add-product-accordion" value="Add Product">
        <div class="add-product-form hidden">
          <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="input-field-container">
              <span class="input-placeholder">Product name</span>
              <input type="text" class="input-field" name="name" value="">
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
            <div class="input-field-container">
              <span class="input-placeholder">Category</span>
              <select name="category_id">
                <option selected="selected">Категория</option>
                <option value="1">Акустика</option>
                <option value="2">Электро</option>
              </select>
              <!--input type="text" class="input-field" name="category_id" value="">
              <span class="border"></span-->
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Status</span>
              <select name="status_id">
                <option selected="selected">Статус</option>
                <option value="1">В наличии</option>
                <option value="2">Ожидается</option>
                <option value="3">Отсутствует</option>
              </select>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Code</span>
              <input type="text" class="input-field" name="code" value="">
              <span class="border"></span>
            </div>
            <div class="product-image">
              <p>The default product image is</p>
              <img src="../img/default_product.png" alt="">
              <p>Upload Image</p>
              <input type="file" name="image" value="Upload product image" class="image-upload-button" enctype="multipart/form-data">
            </div>
            <input type="submit" class="submit-button" name="add-product" value="Add Product">
          </form>
        </div>
      </div>
      <div class="products">
        <ul>
          <?php
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            $sql = 'SELECT * FROM products';
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
              printf('<li class="product">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <h3>%s</h3>
                        <div class="product-info hidden">
                          <img src="%s">
                          <p>%s</p>
                          <h5>%s€</h5>
                          <span class="manage-product">
                            <a href="edit.php?id=%s">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href="delete.php?id=%s">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                          </span>
                        </div>
                      </li>', $row['name'], $row['picture'], $row['description'], $row['price'], $row['id'], $row['id']);
            }
          ?>
        </ul>
      </div>
    </section>
    <div class="">

    </div>
    <script src="../js/products.js" charset="utf-8"></script>
    <script src="../js/input.js" charset="utf-8"></script>
  </body>
</html>
