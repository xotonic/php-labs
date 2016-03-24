<?php

include 'util.php';

init_sql();
$sql = send_and_check("SELECT count(*) as count from likes");
$likes = mysql_fetch_assoc($sql);
echo $likes['count'];
?>
