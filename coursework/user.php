<?php

include 'util.php';
enable_debug();
init_sql();

$id = $_GET['id'] or killme('Нет такого юзера');

$current = get_user_info($id);

$logged = is_logged();
$admin = false;
$user = array();
if ($logged == true)
{
  $user = get_user_info();
  if ($user["access_level"] == 3) $admin = true;
}

$current_is_moder = false;
if ($current['access_level'] == 2) $current_is_moder = true;

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo "Страница пользователя $current[login]"; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class='main'>

    <?php
    echo "<div><u><a href='$_SERVER[HTTP_REFERER]'?>Назад</a></u></div>";
    echo "<h2>Страница пользователя $current[login]</h2>";
    if ($admin) echo "<div><a href='toggleuser.php?id=$current[id]'><u>Дать/отнять права модератора</u></a></div>";
    echo <<< TAG

    <div>Рейтинг: $current[rating]</div>
    <div>Забанен: $current[ban]</div>
    <div>Уровень доступа: $current[access_level]</div>
TAG;
     ?>
   </div>
  </body>
</html>
