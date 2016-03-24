<?php

include 'util.php';
enable_debug();
init_sql();

if (!is_logged()) {
    killme('Нет прав');
}
$user = get_user_info();
if ($user['access_level'] < 2) {
    killme('Нет прав');
}

$id = $_GET['id'] or killme('Что удалять-то?');

$comments = send_and_check("SELECT id from ccomments where id_topic=$id");
while ($row = mysql_fetch_assoc($comments)) {
    send_and_check("DELETE from crates_comment where id_comment=$row[id]");
}

$replies = send_and_check("SELECT id from creplies where id_topic=$id");
while ($row = mysql_fetch_assoc($replies)) {
    send_and_check("DELETE from crates_reply where id_reply=$row[id]");
}

$topics = send_and_check("SELECT id from ctopics where id=$id");
while ($row = mysql_fetch_assoc($topics)) {
    send_and_check("DELETE from crates_topic where id_topic=$row[id]");
}

send_and_check("DELETE from ccomments where id_topic=$id");
send_and_check("DELETE from creplies where id_topic=$id");
send_and_check("DELETE from ctopics where id=$id");

header('Location: index.php');
