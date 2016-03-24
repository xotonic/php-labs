<?php

include 'util.php';
enable_debug();
init_sql();

if (!isset($_GET['id'])) {
    killme('Нет id');
}

// reply id
$id = $_GET['id'];
$user = get_user_info();
$sql = send_and_check("SELECT id_topic as id, ctopics.creator as creator FROM creplies, ctopics
  WHERE creplies.id = $id and creplies.id_topic = ctopics.id");
$topic = mysql_fetch_assoc($sql);

// is current user topic starter ?
if ($topic['creator'] != $user['id']) {
    killme("Нет прав : creator=$topic[creator], user=$user[id]");
} else {
    if (isset($_GET['rem']) and $_GET['rem'] == true) {
      send_and_check("UPDATE ctopics SET closed=false WHERE id = $topic[id]");
      send_and_check("UPDATE creplies SET is_solution=false WHERE id = $id");
    } else {
        send_and_check("UPDATE ctopics SET closed=true WHERE id = $topic[id]");
        send_and_check("UPDATE creplies SET is_solution=true WHERE id = $id");
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
}
