<?php
include 'util.php';
enable_debug();
?>
  <html>

  <head>
    <title>Not Anonimous forum</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="ru" />
    <meta name="title" content="THIS IS CAAAPCHAAA!!!" />
    <meta name="description" content="ЗА ОНОТОЛЕ!!1адын" />
    <link rel="stylesheet" type="text/css" href="style_my.css">
    <script src="ckeditor/ckeditor.js"></script>
    <?php if (is_vip()) echo <<< TAG
      <link href="tubular/css/screen.css" rel="stylesheet" type="text/css" />
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript" charset="utf-8" src="tubular/js/jquery.tubular.1.0.js"></script>
      <script type="text/javascript" charset="utf-8" src="tubular/js/index.js"></script>
TAG;
     ?>
  </head>

  <body>
    <?php if(is_vip()) echo "<div id='wrapper' class='clearfix'>"; ?>

    <div class='main'>
      <?php
      session_start();
      //include 'util.php';

      if (isset($_POST['submit'])) {
        //echo "Text: <br>$_POST[text]<br>IP : $_POST[ip]";
        if(isset($_SESSION['captcha_keystring']) && substr($_SESSION['captcha_keystring'],0,4) === substr($_POST['keystring'],0,4)){
          init_sql();
          $sql = send_and_check("INSERT into messages(message,ip, posted) values ('$_POST[text]',INET_ATON('$_POST[ip]'), NOW())");
          echo "<div class='ok'>Запись сохранена</div>";
        }else{
          echo "<div class='fail'>Неправильная капча</div>";
        }
      }

      $ip = $_SERVER['REMOTE_ADDR'];
       ?>
        <form action="index.php" method="post">
          <textarea class='control' name="text" id="editor1" rows="10" cols="80">
            Господи, благослови автора этой странички!
          </textarea>
          <script>
            CKEDITOR.replace('editor1');
          </script>
          <input type="hidden" value=<?php echo $ip;?> name="ip"/>
          <!--input type="hidden" value=<?php echo $referer;?> name="referer"/-->
          <!--input type="hidden" value=<?php  echo date('m-d-Y H:i:s');?> name="posted"/-->
          <p><img class='captcha' src="kcaptcha/index.php?<?php echo session_name() ?>=<?php echo session_id() ?>"></p>
          <p>
            <input class='control' type="text" name="keystring" size="34">
          </p>
          <input class='control' type="submit" value="SEND" name="submit" />
        </form>

        <?php
      init_sql();
      $sql2 = send_and_check("SELECT message as msg,  inet_ntoa(ip) as ip, posted as date from messages order by posted asc");
      while ($row = mysql_fetch_assoc($sql2))
      {
        echo "<div class='post'><div class='ip'>$row[ip]</div><div class='posted'>$row[date]</div><div class='msg'>$row[msg]</div></div>";
      }
       ?>
    </div>
    <?php if (is_vip()) echo "</div>"; ?>

  </body>

  </html>
