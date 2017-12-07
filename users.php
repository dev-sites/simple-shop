<?php
  session_start();
  require 'authentication.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Manage Users</title>
  </head>
  <body>
    <ul>
      <?php
        $db = mysqli_connect('localhost', 'root', '', 'e-shop');
        $sql = "SELECT * FROM users";
        $result = mysqli_query($db, $sql);
        foreach ($result as $row ) {
          printf('<li>%s</li>
                  <a href="edit.php?id=%s">edit</a>
                  <a href="delete.php?id=%s">delete</a>',
                 $row['email'],
                 $row['id'],
                 $row['id']
          );
        }
        mysqli_close($db);
      ?>
    </ul>
  </body>
</html>
