<?php

include 'util.php';

if (isset($_SERVER['REMOTE_ADDR'])) {
    init_sql();
    $sql = send_and_check("SELECT ip as ip from likes where ip = INET_ATON('$_SERVER[REMOTE_ADDR]')");
    if (mysql_num_rows($sql) == 0) {
        send_and_check("INSERT into likes(ip) values (INET_ATON('$_SERVER[REMOTE_ADDR]'))");
        echo 'ok';
    } else {
        echo 'already';
    }
} else {
    echo 'fail';
}
