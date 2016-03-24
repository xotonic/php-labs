<?php

include 'util.php';
enable_debug();
$err = array();
$success = false;
session_start();

if (isset($_GET['from'])) $_SESSION['afrom'] = $_GET['from'];

if (isset($_POST['register'])) {
    init_sql();

    if (!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring'])) {
        $err[] = 'Капча введеда неправильно';
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['rlogin'])) {
        $err[] = 'Логин может состоять только из букв английского алфавита и цифр';
    }

    if (strlen($_POST['rlogin']) < 3 or strlen($_POST['rlogin']) > 30) {
        $err[] = 'Логин должен быть не меньше 3-х символов и не больше 30';
    }

    # проверяем, не сущестует ли пользователя с таким именем
    $query = send_and_check("SELECT COUNT(id) FROM cusers WHERE login='".mysql_real_escape_string($_POST['rlogin'])."'");

    if (mysql_result($query, 0) > 0) {
        $err[] = 'Пользователь с таким логином уже существует в базе данных';
    }

    # Если нет ошибок, то добавляем в БД нового пользователя
   if (count($err) == 0) {
       $login = $_POST['rlogin'];

       # Убираем лишние пробелы и делаем двойное шифрование
       $password = md5(md5(trim($_POST['rpassword'])));
       send_and_check("INSERT INTO cusers SET login='".$login."', password='".$password."'");
   } else {
       //echo '<b>При регистрации произошли следующие ошибки:</b><br>';
   }
}
if (isset($_POST['signin'])) {

    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    init_sql();
    $query = send_and_check("SELECT id as id, password as password, ban FROM cusers WHERE login='".mysql_real_escape_string($_POST['slogin'])."' LIMIT 1");

    $data = mysql_fetch_assoc($query);

    # Соавниваем пароли
    if (mysql_num_rows($query) == 1) {
      if ($data['ban'] == true) killme("Пользователь забанен");
        if ($data['password'] === md5(md5($_POST['spassword']))) {
        # Генерируем случайное число и шифруем его

        $hash = md5(generateCode(10));

        # Записываем в БД новый хеш авторизации и IP

        send_and_check("UPDATE cusers SET hash='".$hash."'  WHERE id='".$data['id']."'");

        # Ставим куки

        setcookie('id', $data['id'], time() + 60 * 60 * 24 * 30);

            setcookie('hash', $hash, time() + 60 * 60 * 24 * 30);

        # Переадресовываем браузер на страницу проверки нашего скрипта
        if (isset($_SESSION['afrom']))
        {
          $next = $_SESSION['afrom'] . '.php';
          unset($_SESSION['afrom']);
          header("Location: $next");
        }
        else
        header('Location: board.php');
        //$success = true;
        exit();
        } else {
            $err[] = 'Вы ввели неправильный логин/пароль';
        }
    } else {
        $err[] = 'Вы ввели неправильный логин/пароль';
    }
}
if (count($err) == 0) {
    $success = true;
}

# Функция для генерации случайной строки

function generateCode($length = 6)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789';
    $code = '';
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Регистрация/Вход</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
    if (isset($_POST['register']) or isset($_POST['signin'])) {
        $color = $success ? 'green' : 'red';
        echo "<div style='color: $color;'>";
        if ($success) {
            echo 'Аккаунт успешно создан';
        } else {
            foreach ($err as $error) {
                echo $error.'<br>';
            }
        }
    }
    echo '</div>';
    ?>
    <table class="centered" >
      <tr>
        <td valign="top" class="right" style="padding: 10px;">
    <div>
      <p>
      <b>Регистрация</b><br>
     <form action="autorization.php" method="post">
       Логин <br><input  type=text name="rlogin"/><br>
       Пароль <br><input  type=text name="rpassword"/>
         <p><img width=120 height=80 class='captcha' src="kcaptcha/index.php?<?php echo session_name() ?>=<?php echo session_id() ?>"><br>
           <input class='control' type="text" name="keystring" size="6">
         </p>
         <br>
       <input name="register" type=submit value="Регистрация"/>
     </form></p>
   </div>
    </p>
  </td>
  <td valign="top" style="padding: 10px;"  >
    <p>
    <div>
      <b>Вход</b><br>
      <p>
      <form action="autorization.php" method="post">
        Логин <br><input type=text name="slogin"/><br>
        Пароль <br><input  type=text name="spassword"/><br><br>
        <input name="signin" type=submit value="Вход"/>
      </form></p>
    </p>
  </div>
</td>
</tr>
</table>
  </body>
</html>
