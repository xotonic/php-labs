
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Страница</title>
  </head>
  <body>
    <?php
    include 'util.php';

    if (isset($_GET['id']))
    {
      init_sql();
      $sql = send_and_check("SELECT name as name from models where id = $_GET[id]");
      if (mysql_num_rows($sql) == 0) die("<h1>Игра не найдена</h1>");

      $first = mysql_fetch_assoc($sql);
      echo "<h1>Страница игры <span id='game_name'>$first[name]</span></h1>";


    } else die("<h1>404</h1>");
    ?>
  </body>
</html>
