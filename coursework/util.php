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

    if (!$query) {
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

function login_by_id($id)
{
    $sql = send_and_check("SELECT login, access_level, id, ban from cusers where id = $id");
    if (mysql_num_rows($sql) == 0) {
        return "user$id";
    } else {
        $row = mysql_fetch_assoc($sql);
        $span = "$row[login]";
        if ($row['access_level'] > 2) {
            $span = "<span class='superuser'>$span</span>";
        } else {
            $span = "<a href='user.php?id=$row[id]'><span>$span</span></a>";
        }

          if ($row['access_level'] == 2) $span = "<span class='moder'>$span</span>";

        if ($row['ban'] == true and $row['access_level'] != 3) {
            $span = "<span class='banned'>$span</span>";
        }
        $user_info = get_user_info();
        if (has_rights(2) and $row['access_level'] == 1) {
            //echo $user_info['access_level'];
            $span .= "<a href='ban.php?id=$row[id]'>[X]</a>";
        }
        else if (has_rights(3) and $row['access_level'] < 3)
        {
          $span .= "<a href='ban.php?id=$row[id]'>[X]</a>";
        }
        return $span;
    }
}

function login_by_id_no_link($id)
{
    $sql = send_and_check("SELECT login, access_level, id from cusers where id = $id");
    if (mysql_num_rows($sql) == 0) {
        return "user$id";
    } else {
        $row = mysql_fetch_assoc($sql);
        $span = "$row[login]";
        if ($row['access_level'] > 1) {
            $span = "<span class='superuser'>$span</span>";
        } else {
            $span = "<span>$span</span>";
        }

        return $span;
    }
}

function send_and_check($query)
{
    $result = mysql_query($query);

    if (!$result) {
        $message = 'send_and_check : Неверный запрос: '.mysql_error()."\n";
        $message .= 'Запрос целиком: '.$query;
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
    if (isset($_COOKIE['vip']) and $_COOKIE['vip'] == 'on') {
        echo "<div style='position: fixed; z-index: -99; width: 100%; height: 100%;'>
    <iframe frameborder='0' height='100%' width='100%'
      src='https://www.youtube.com/embed/$id?autoplay=1&controls=0&showinfo=0&autohide=1'>
    </iframe>
  </div>";
    }
}

function coub($id)
{
    if (isset($_COOKIE['vip']) and $_COOKIE['vip'] == 'on') {
        echo "<div style='position: fixed; z-index: -99; width: 100%; height: 100%;'>
    <iframe frameborder='0' height='100%' width='100%'
      src='http://coub.com/embed/$id?muted=false&autostart=true&originalSize=false&hideTopBar=true&startWithHD=true'>
    </iframe>
  </div>";
    }
}

function is_vip()
{
    if (isset($_COOKIE['vip'])) {
        if ($_COOKIE['vip'] == 'on') {
            return true;
        }
    }

    return false;
}

function is_logged()
{
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $query = send_and_check('SELECT * FROM cusers WHERE id = '.intval($_COOKIE['id']).' LIMIT 1');
        $userdata = mysql_fetch_assoc($query);
    /*  echo "database id = $userdata[id]<br>";
      echo "database hash = $userdata[hash]<br>";
      echo "cookie id = $_COOKIE[id]<br>";
      echo "cookie hash = $_COOKIE[hash]<br>";
      echo "database ip = $userdata[fip]<br>";
      echo "user ip = $_SERVER[REMOTE_ADDR]<br>";*/

      if (($userdata['hash'] !== $_COOKIE['hash'])
          or ($userdata['id'] !== $_COOKIE['id'])) {
          //setcookie('id', '', time() - 3600 * 24 * 30 * 12, '/');
          //setcookie('hash', '', time() - 3600 * 24 * 30 * 12, '/');
          /*echo 'Доступ запрещен'; */return false;
      } else {
          if ($userdata['ban'] == true) {
              return false;
          }

          return true;
          //echo 'Привет, '.$userdata['login'].'. Всё работает!';
      }
    } else {
        /*echo 'Включите куки'; */return false;
    }
}

function has_rights($access_level)
{
    if (is_logged() and isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $query = send_and_check('SELECT access_level as level FROM cusers WHERE id = '.intval($_COOKIE['id']).' LIMIT 1');
        $userdata = mysql_fetch_assoc($query);
        if ($userdata['level'] >= $access_level) {
            return true;
        } else {
            return false;
        }
    }

    return false;
}

function get_user_info()
{
    $id = 0;
    if (func_num_args() != 0) {
        $id = func_get_arg(0);
    } elseif (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $id = $_COOKIE['id'];
    }
    $query = send_and_check('SELECT
      id as id,
      login as login,
      ban as ban,
      access_level as access_level,
      rating as rating FROM cusers WHERE id = '.intval($id).' LIMIT 1');
    $userdata = mysql_fetch_assoc($query);

    return $userdata;
    //else echo "NO COOKIES!";
}

function killme($message)
{
    $html =
    "<!DOCTYPE html>
    <html>
      <head>
        <meta charset='utf-8'>
        <title>Ошибка</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
      </head>
      <body>
      <div class='main'>
      <h2 class='bottom'>segmentation<b>fault</b>.com</h2>
      <h2>$message</h2><a href='javascript:history.go(-1)'>Вернуться назад</a>
      </div>
      </body>
      <html>";
    die($html);
}

function rating_block($obj, $id, $default)
{
    if (is_logged()) {
        return "<form style='display: inline;'>
          <input name='table' type=hidden value=$obj>
          <button name='down' type='button' value='$id' onclick='rate(table.value, this.value, true)'> < </button>
          <span aling='center' id='rate$obj$id'> $default </span>
          <button name='up' type='button' value='$id' onclick='rate(table.value, this.value, false)'> > </button>
        </form>";
    } else {
      return "[".get_rate($obj,$id)."]";
    }
}

function get_rate($table, $id)
{
    //echo "id=$id";
  $sqll = send_and_check("SELECT SUM(rate) as sum FROM crates_$table WHERE id_$table = $id");
    $row = mysql_fetch_assoc($sqll);

    return $row['sum'] ?: 0;
}
