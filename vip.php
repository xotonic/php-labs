<?php


  if (isset($_POST['vip']) /*and isset($_POST["code"])*/ ) {
    //if ($_POST["code"] == "i-want-unsee-it")
      setcookie('vip', $_POST['vip'] == 'on' ? 'on' : 'off', time() + 60 * 60 * 24 * 31);
    //  else die("Эх, неудача. Наверно что-то не то ввёл. Ухади...");
  } else {
    setcookie('vip', 'off', time() + 60 * 60 * 24 * 31);
}
header('location:index.php');
