<?php

include 'util.php';
enable_debug();
//$get = $_REQUEST['get'] ?: false;
$table = $_REQUEST['table'];
$id = $_REQUEST['id'];
$neg = $_REQUEST['neg'];
$table_fullname = "crates_$table";
$post_rate = $neg == 1 ? -1 : 1;

$rates = array('topic' => 2, 'reply' => 3, 'comment' => 1);
$tables = array('topic' => 'ctopics', 'reply' => 'creplies', 'comment' => 'ccomments');

init_sql();
$user = get_user_info();

// rate which will be added to post creator
$rate = $rates["$table"];
if ($neg = 1) {
    $rate = -$rate;
}

$sql = send_and_check("SELECT * from $table_fullname WHERE id_user = $user[id] and id_$table = $id");
$r = mysql_fetch_assoc($sql);
if (mysql_num_rows($sql) == 0) {

    send_and_check("INSERT into $table_fullname (id_$table, id_user, rate) values ($id, $user[id], $post_rate)");
    send_and_check("UPDATE $tables[$table] SET rating=rating + ($post_rate) WHERE id = $id");
    $sqlcreator = send_and_check("SELECT creator as id from $tables[$table] where id=$id");
    $row = mysql_fetch_assoc($sqlcreator);
    send_and_check("UPDATE cusers SET rating=rating + ($rate) WHERE id = $row[id]");
    // count
    //$sqll = send_and_check("SELECT SUM(rate) as sum FROM $table_fullname WHERE id_user = $user[id] and id_$table = $id");
    //$row = mysql_fetch_assoc($sqll);
    //echo $row['sum'];
}
else if (mysql_num_rows($sql) == 1 and $post_rate != $r['rate'])
{
    // запоминаем рейтанувшего юзера
    send_and_check("UPDATE $table_fullname SET rate=$post_rate WHERE id_user = $user[id] and id_$table = $id");
    // увеличиваем рейтинг поста
    send_and_check("UPDATE $tables[$table] SET rating=rating + ($post_rate) - $r[rate] WHERE id = $id");
    // увеличваем рейтинг юзера
    $sqlcreator = send_and_check("SELECT creator as id from $tables[$table] where id=$id");
    $row = mysql_fetch_assoc($sqlcreator);
    send_and_check("UPDATE cusers SET rating=rating - ($rate) WHERE id = $row[id]");

    //$sqll = send_and_check("SELECT SUM(rate) as sum FROM $table_fullname WHERE id_user = $user[id] and id_$table = $id");
    //$row = mysql_fetch_assoc($sqll);
  //  echo $row['sum'];
}
else {
//    echo 'fail';
}

echo get_rate($table,$id);
