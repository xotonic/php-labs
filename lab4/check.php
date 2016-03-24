<?php
# Соединямся с БД
include 'util.php';

//  enable_debug();
init_sql();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = send_and_check("SELECT *,INET_NTOA(ip) as fip FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);
  /*  echo "database id = $userdata[id]<br>";
    echo "database hash = $userdata[hash]<br>";
    echo "cookie id = $_COOKIE[id]<br>";
    echo "cookie hash = $_COOKIE[hash]<br>";
    echo "database ip = $userdata[fip]<br>";
    echo "user ip = $_SERVER[REMOTE_ADDR]<br>";*/

    if (($userdata['hash'] !== $_COOKIE['hash'])
        or ($userdata['id'] !== $_COOKIE['id'])
        or (($userdata['fip'] !== $_SERVER['REMOTE_ADDR'])
        and ($userdata['fip'] !== '0'))) {
        setcookie('id', '', time() - 3600 * 24 * 30 * 12, '/');
        setcookie('hash', '', time() - 3600 * 24 * 30 * 12, '/');
        echo 'Доступ запрещен';
    } else {
      header("location: table.php");
        //echo 'Привет, '.$userdata['login'].'. Всё работает!';
    }
} else {
    echo 'Включите куки';
}
