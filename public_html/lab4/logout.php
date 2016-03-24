<?php

include 'util.php';
enable_debug();
if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    init_sql();
    $query = send_and_check("UPDATE users SET hash = 0 WHERE id = $id");
    unset($_COOKIE["id"]);
    unset($_COOKIE["hash"]);

    //setcookie('hash', '', time() - 3600 * 24 * 30 * 12, '/');
}
header('location: index.php');
