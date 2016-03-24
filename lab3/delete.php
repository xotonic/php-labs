<?php

include 'util.php';

enable_debug();
init_sql();

$SQL = "DELETE from models where id = $_GET[id]";

send_and_check($SQL);
header('location:index.php');
