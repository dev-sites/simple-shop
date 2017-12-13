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
      if (isset($_POST['add-order'])) {
        $email = $_POST['email'];
        $cost = $_POST['cost'];
        $date = $_POST['date'];
        $product = $_POST['product'];
        $address = $_POST['address'];
        $status = $_POST['status_id'];

        $sql = sprintf("INSERT INTO orders (user_id, cost, date, address, status, product_id) VALUES (%s, %s, '%s', '%s', '%s', %s)", $email, $cost, $date, $address, $status, $product);
        echo var_dump($sql);
        mysqli_query($db, $sql);
        mysqli_close($db);
      }
    ?>
    <?php require('../tmpl/dashboard.tmpl.html'); ?>
    <section class="main-content">
      <div class="add-product">
        <input type="button" class="add-product-accordion" value="Add Order">
        <div class="add-product-form hidden">
          <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="input-field-container">
              <span class="input-placeholder">E-mail</span>
              <input type="text" class="input-field" name="email" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <input type="date" class="input-field" name="date" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Address</span>
              <input type="text" class="input-field" name="address" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Продукт</span>
                <select name="product">
                  <option selected="selected">Продукт</option>
                  <?php 
                    $sql = 'SELECT * FROM products';
                    $result = mysqli_query($db, $sql);
                    foreach ($result as $row) {
                      printf('<option value="%s">%s</option>', $row['id'], $row['name']);
                    }
                  ?>
                </select>
              </div>
            <div class="input-field-container">
              <span class="input-placeholder">Cost</span>
              <input type="text" class="input-field" name="cost" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Статус</span>
              <select name="status_id">
                <option selected="selected">Статус заказа</option>
                <option value="Сборка">Сборка</option>
                <option value="Подготовка к отправке">Подготовка к отправке</option>
                <option value="Отправке">Отправке</option>
                <option value="Доставлено">Доставлено</option>
              </select>
            </div>
            <input type="submit" class="submit-button" name="add-order" value="Add Order">
          </form>
        </div>
      </div>
      <div class="products">
        <ul>
          <?php
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            $db->set_charset("utf8");
            $sql = 'SELECT orders.id, orders.cost, orders.address, orders.date, orders.status, products.name, products.price, users.email FROM orders INNER JOIN products ON orders.product_id = products.id INNER JOIN users ON orders.user_id = users.id';
            $result = mysqli_query($db, $sql);
            //echo var_dump($result);
            foreach ($result as $row) {
              printf('<li class="product">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <h3>Номер заказа %s</h3>
                        <div class="product-info hidden">
                          <p>%s</p>
                          <p>%s</p>
                          <p>%s</p>
                          <p>%s</p>
                          <p>%s</p>
                          <span class="manage-product">
                            <a href="edit.php?del=orders&id=%s">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href="delete.php?del=orders&id=%s">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                          </span>
                        </div>
                      </li>',  $row['id'], $row['name'], $row['cost'], $row['address'], $row['email'], $row['status'], $row['id'], $row['id']);
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
