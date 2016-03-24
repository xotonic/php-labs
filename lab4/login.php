<?php

include 'util.php';

//enable_debug();
// Страница авторизации

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

# Соединямся с БД

init_sql();


if (isset($_POST['signin'])) {

    # Вытаскиваем из БД запись, у которой логин равняеться введенному

    $query = mysql_query("SELECT id, password FROM users WHERE login='".mysql_real_escape_string($_POST['slogin'])."' LIMIT 1");

    $data = mysql_fetch_assoc($query);

    # Соавниваем пароли

    if ($data['password'] === md5(md5($_POST['spassword']))) {

        # Генерируем случайное число и шифруем его

        $hash = md5(generateCode(10));

        if (!@$_POST['rip']) {

            # Если пользователя выбрал привязку к IP

            # Переводим IP в строку

            $insip = ", ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        # Записываем в БД новый хеш авторизации и IP

        send_and_check("UPDATE users SET hash='".$hash."' ".$insip." WHERE id='".$data['id']."'");

        # Ставим куки

        setcookie('id', $data['id'], time() + 60 * 60 * 24 * 30);

        setcookie('hash', $hash, time() + 60 * 60 * 24 * 30);

        # Переадресовываем браузер на страницу проверки нашего скрипта

        header('Location: check.php');
        exit();
    } else {
        echo 'Вы ввели неправильный логин/пароль';
    }
}
