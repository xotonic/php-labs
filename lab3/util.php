<?php

function enable_debug()
{
  ini_set('display_errors', 1);
  ini_set('track_errors', 1);
  ini_set('html_errors', 1);
  error_reporting(E_ALL);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function get_id_by_name($name, $table_name)
{
    $sql = 'SELECT id from '.$table_name." where name ='".$name."'";
  //  echo "get_id_by_name : " . $sql . "<br>";
    $query = send_and_check($sql);

    if (!$query)
    {
        $message = 'Неверный запрос: '.mysql_error()."\n";
        $message .= 'Запрос целиком: '.$sql;
        die($message);
    }

    $row = mysql_fetch_assoc($query);
    $id = $row['id'];
  //  echo "get_id_by_name : row = " . $row . "<br>";
  //  echo "get_id_by_name : id = " . $id . "<br>";

    return $id;
}

function send_and_check($query)
{
  $result = mysql_query($query);

  if (!$result) {
      $message  = 'send_and_check : Неверный запрос: ' . mysql_error() . "\n";
      $message .= 'Запрос целиком: ' . $query;
      die($message);
  }
  return $result;
}

function init_sql()
{
  @$connect = mysql_connect('localhost', 'user108', 'gun_centos_user_108');
  if (!$connect) {
      echo "Can't connect to database!";
      exit;
  }
  @$db = mysql_select_db('user108');
  if (!$db) {
      echo "Can't change database!";
      exit;
  }
}

  ?>
