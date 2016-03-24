<?php

include 'util.php';

$q = test_input($_REQUEST['q']);
$q = str_replace('"', "", $q);
$q = str_replace("'", "", $q);
if ($q !== '') {
    //echo 'Ну хоть строка не пустая';
    init_sql();
    $query = "SELECT id as id ,name as name from models where name like '%$q%'";
    $sql = send_and_check($query);
    if (mysql_num_rows($sql) == 0) { echo "Ничего не найдено"; exit(); }
    //echo "<form action='game.php' method='get'>";
    while ($row = mysql_fetch_assoc($sql)) {
      $highlighted =  preg_replace("/($q)/i","<span style=\"color:red;\">$1</span>",$row['name']);
      $link = "<a href='game.php?id=$row[id]'>$highlighted</a><br>";
      echo $link;
    }
    //echo "</form>";
}
else echo "Нечего искать";
