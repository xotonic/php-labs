<?php
  include 'util.php';
  enable_debug();
  init_sql();
  if (!is_logged()) {
      die("Вы не авторизированы. <a href='autorization.php?from=create'>Исправить</a>");
  }
  session_start();

  if (isset($_POST['submit'])) {
      if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']) {
          $user = get_user_info();
          $cleared_title = test_input($_POST['title']);
          if ((empty($cleared_title) != true)
              and ($_POST['text'] != '')
              and ($_POST['text'] != '<p>'.test_input($_POST['text']).'</p>')) {
              $sql = send_and_check("INSERT into ctopics(content, title, creator, created) values ('$_POST[text]','$cleared_title', $user[id], NOW());");
              header('location: board.php?status=created');
          } else {
              die("Название темы или сообщения пустое. <a href='create.php'>Назад</a>");
          }
      } else {
          die("Неправильная капча. <a href='create.php'>Назад</a>");
      }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Создать тему</title>
          <script src="ckeditor/ckeditor.js"></script>
          <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class='main'>
    <h2 class='bottom'>segmentation<b>fault</b>.com</h2>
    <form action="create.php" method="post">
    <p>
      Название темы<br>
      <input type="text" name="title" size=80>
    </p>
      Полное описание проблемы<br>
    <textarea class='control' name="text" id="editor1" rows="10" cols="80">
      Ваше сообщение
    </textarea>
    <script>
      CKEDITOR.replace('editor1');
    </script>
    <p><img class='captcha' src="kcaptcha/index.php?<?php echo session_name() ?>=<?php echo session_id() ?>"></p>
    <p>
      <input class='control' type="text" name="keystring" size="34">
    </p>
    <input class='control' type="submit" value="SEND" name="submit" />
  </div>
  </form>
  </body>
</html>
