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
      echo sprintf("SHOW VARIABLES LIKE 'character_set_client'");
      if (isset($_POST['add-user'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = $_POST['isAdmin'];
        echo mb_detect_encoding($name);
        $sql = sprintf("INSERT INTO users (name, email, password, isAdmin) VALUES ('%s', '%s', '%s', %s)", $name, $email, $password, $admin);
        
        mysqli_query($db, $sql);
        mysqli_close($db);
      }
    ?>
    <?php require('../tmpl/dashboard.tmpl.html'); ?>
    <section class="main-content">
      <div class="add-product">
        <input type="button" class="add-product-accordion" value="Add User">
        <div class="add-product-form hidden">
          <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="input-field-container">
              <span class="input-placeholder">User name</span>
              <input type="text" class="input-field" name="name" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">E-mail</span>
              <input type="text" class="input-field" name="email" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Password</span>
              <input type="text" class="input-field" name="password" value="">
              <span class="border"></span>
            </div>
            <div class="input-field-container">
              <span class="input-placeholder">Права</span>
              <select name="isAdmin">
                <option selected="selected">Права</option>
                <option value="0">Покупатель</option>
                <option value="1">Администратор</option>
              </select>
            </div>
            <input type="submit" class="submit-button" name="add-user" value="Add User">
          </form>
        </div>
      </div>
      <div class="products">
        <ul>
          <?php
            $db = mysqli_connect('localhost', 'root', '', 'e-shop');
            //$db->query("SET NAMES 'cp1251'");
            //$db->set_charset("utf8");
            $sql = 'SELECT * FROM users';
            $result = mysqli_query($db, $sql);
            foreach ($result as $row) {
    			  if ($row['isAdmin'] == 0) {
    				  $row['isAdmin'] = 'Покупатель';
    			  } else {
    				  $row['isAdmin'] = 'Администратор';
    			  }
              printf('<li class="product">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <h3>%s</h3>
                <div class="product-info hidden">
                  <p>%s</p>
						      <p>%s</p>
                  <span class="manage-product">
                    <a href="edit.php?del=users&id=%s">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <a href="delete.php?del=users&id=%s">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </span>
                </div>
                </li>', $row['name'], $row['email'], $row['isAdmin'], $row['id'], $row['id']);
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
