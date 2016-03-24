<?php

$data = $_POST['data'];
$cookie_content = 'was '.implode($data, ' ');
$cookie_lifetime = 356 * 24 * 60 * 60;
setcookie('checkboxes', $cookie_content, time() + $cookie_lifetime);
header('location:index.php');
?>
