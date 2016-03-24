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

function check_cookie()
{

  if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
      $query = send_and_check("SELECT *,INET_NTOA(ip) as fip FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
      $userdata = mysql_fetch_assoc($query);

      if (($userdata['hash'] !== $_COOKIE['hash'])
          or ($userdata['id'] !== $_COOKIE['id'])
          or (($userdata['fip'] !== $_SERVER['REMOTE_ADDR'])
          and ($userdata['fip'] !== '0'))) {
          setcookie('id', '', time() - 3600 * 24 * 30 * 12, '/');
          setcookie('hash', '', time() - 3600 * 24 * 30 * 12, '/');
          die('ДОСТУП ЗАПРЕЩЕН');
      } else {
    return;
      }
  } else {
      die('Вход не выполнен');
  }

}

function youtube($id)
{
    if (isset($_COOKIE['vip']) and $_COOKIE["vip"] == "on") {
        echo "<div style='position: fixed; z-index: -99; width: 100%; height: 100%;'>
    <iframe frameborder='0' height='100%' width='100%'
      src='https://www.youtube.com/embed/$id?autoplay=1&controls=0&showinfo=0&autohide=1&loop=1&playlist=$id'>
    </iframe>
  </div>";
    }
}

function coub($id)
{
    if (isset($_COOKIE['vip']) and $_COOKIE["vip"] == "on") {
        echo "<div style='position: fixed; z-index: -99; width: 100%; height: 100%;'>
    <iframe frameborder='0' height='100%' width='100%'
      src='http://coub.com/embed/$id?muted=false&autostart=true&originalSize=false&hideTopBar=true&startWithHD=true'>
    </iframe>
  </div>";
    }
}

  ?>
