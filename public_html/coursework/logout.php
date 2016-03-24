<?php

include 'util.php';
enable_debug();
if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    init_sql();
    $query = send_and_check("UPDATE cusers SET hash = 0 WHERE id = $id");
    unset($_COOKIE["id"]);
    unset($_COOKIE["hash"]);
    setcookie('id', null, -1, '/');
    setcookie('hash', null, -1, '/');

    //setcookie('hash', '', time() - 3600 * 24 * 30 * 12, '/');
}
header('location: index.php');
