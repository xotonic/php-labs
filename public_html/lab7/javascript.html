<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title> Бесполезная регистрация </title>
  <script>
    function e(msg) {
      var b = document.getElementById('out');
      b.innerHTML += msg + "<br>";
    }

    function is_e() {
      var b = document.getElementById('out');
      if (b.innerHTML == "")
        return true;
      else return false;
    }

    function validate() {
      var b = document.getElementById('out');
      b.innerHTML = "";
      var f = document.forms["f"]
      var nameRegex = /^[a-zA-Z\-]+$/;
      var passRegex = /^[a-z0-9_-]{6,18}$/;
      var markRegex = /^[0-9]+$/;
      if (f["login"].value == "")
        e("Логин пустой");
      else if (f["login"].value.length < 3 ) e("Логин короткий (минимум 3)");
      else if (!f["login"].value.match(nameRegex)) e("Логин не удовлетворяет выражению /^[a-z0-9_-]{3,16}$/");
      if (f["password"].value == "")
        e("Пароль пустой");
      else if (f["password"].value.length < 6 ) e("Пароль короткий (минимум 6)");
      else if (!f["password"].value.match(passRegex)) e("Пароль не удовлетворяет выражению /^[a-z0-9_-]{6,18}$/");
      if (!(f["password"].value == f["password2"].value) || !(f["password2"].value == f["password3"].value)) e("Пароли не совпадают");
      if (f["president"].value != "Путин") e("Фамилия не \"Путин\"");
      if (!f["mark"].value.match(markRegex)) e("Оценка должна быть числом");
      else if (f["mark"].value < 8) e("Слишком мало баллов");
      if (f["sweet_yes"].checked == true && f["sweet_no"].checked == true) e("Так хочешь или нет? (да, я знаю про radio)");
      else if (f["sweet_no"].checked == true && f["sweet_yes"].checked == false) e("Ну не хочешь -  не надо");
      else if (f["sweet_no"].checked == false && f["sweet_yes"].checked == false) e("Определись с конфеткой");

      return is_e();
      //alert("Логин пустой");
    }
  </script>
</head>

<body>
  <form action="sweet.html" name='f' onsubmit="return validate();" onkeyup="validate()">
    Логин
    <br>
    <input type='text' name='login' />
    <br> Пароль
    <br>
    <input type='password' name='password' />
    <br> Повторите пароль
    <br>
    <input type='password' name='password2' />
    <br> Повторите пароль еще раз
    <br>
    <input type='password' name='password3' />
    <br> Фамилия следующего президента
    <br>
    <input type='text' name='president' />
    <br> Сколько баллов я получу за эту лабу ?
    <br>
    <input type='text' name='mark' />
    <br> Хочешь конфетку ?
    <br>
    <input type='checkbox' name='sweet_yes' onclick="validate()" /> Да
    <br>
    <input type='checkbox' name='sweet_no' onclick="validate()" /> Нет
    <br>
    <input type='submit' name='submit' value='Send'>
  </form>
  <div id='out'> </div>
</body>

</html>
