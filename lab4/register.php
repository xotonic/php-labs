<?php

include 'util.php';


//enable_debug();
init_sql();

if (isset($_POST['register'])) {
    $err = array();
    if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['rlogin'])) {
        $err[] = 'Логин может состоять только из букв английского алфавита и цифр';
    }
    if (strlen($_POST['rlogin']) < 3 or strlen($_POST['rlogin']) > 30) {
        $err[] = 'Логин должен быть не меньше 3-х символов и не больше 30';
    }

    # проверяем, не сущестует ли пользователя с таким именем
    $query = mysql_query("SELECT COUNT(id) FROM users WHERE login='".mysql_real_escape_string($_POST['rlogin'])."'");

    if (mysql_result($query, 0) > 0) {
        $err[] = 'Пользователь с таким логином уже существует в базе данных';
    }

    # Если нет ошибок, то добавляем в БД нового пользователя

   if (count($err) == 0) {
       $login = $_POST['rlogin'];

       # Убираем лишние пробелы и делаем двойное шифрование
       $password = md5(md5(trim($_POST['rpassword'])));

       $type = "'user'";
       if ($_POST['rmoderator']) {
           if ($_POST['rmasterpass'] == 'kekus') {
               $type = "'moderator'";
           }
           else {
             echo "ИНВАЛИД МАСТЕР ПАССВОРД"; exit();
           }
       }

       mysql_query("INSERT INTO users SET login='".$login."', password='".$password."', type=$type");

       //header('Location: login.php');
       echo "АККАУНТ УСПЕШНО СОЗДАН<br><a href='index.php'>А теперь войти</a>";

       exit();
   } else {
       echo '<b>При регистрации произошли следующие ошибки:</b><br>';

       foreach ($err as $error) {
           echo $error.'<br>';
       }
   }
}
