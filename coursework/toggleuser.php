<?php

include 'util.php';
enable_debug();
init_sql();

if (!is_logged()) {
    killme('Нет прав');
}
$user = get_user_info();
if ($user['access_level'] != 3) {
    killme('Нет прав');
}

$id = $_GET['id'] or killme('id нет');

$current = get_user_info($id);

$nextlevel = 1;
if ($current['access_level'] == 1) $nextlevel = 2;

send_and_check("UPDATE cusers SET access_level=$nextlevel WHERE id=$id");

header('Location: ' . $_SERVER['HTTP_REFERER']);
