<?php
include 'util.php';
//enable_debug();
  ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Авторизация</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php include '../util.php'; coub("6iwjm"); ?>

<p>
<div class="btn">
  <b>Регистрация</b><br>
  <p>
 <form action="register.php" method="post">
   Логин <br><input class="btn" type=text name="rlogin"/><br>
   Пароль <br><input class="btn" type=text name="rpassword"/><br>
   <p><input class="btn" type=checkbox name="rmoderator" onchange="document.getElementById('masterpass').disabled = !this.checked;" >Модератор</input>
    <br>Мастер-пароль<br><input id="masterpass" class="btn" type=text name="rmasterpass"/>

     <br>
   <input class="btn fade" name="register" type=submit value="Регистрация"/>
 </form></p>
</div>
</p>
<p>
<div class="btn">
  <b>Вход</b><br>
  <p>
  <form action="login.php" method="post">
    Логин <br><input class="btn" type=text name="slogin"/><br>
    Пароль <br><input class="btn" type=text name="spassword"/><br><br>
    <input class="btn" type=checkbox name="rip">Привязка к IP</input></p>
    <input class="btn fade" name="signin" type=submit value="Вход"/>
  </form></p>
</p>
</div>
</body>
