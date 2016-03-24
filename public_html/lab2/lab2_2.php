
<?php
//ini_set("display_errors", 1);
//ini_set("track_errors", 1);
//ini_set("html_errors", 1);
//error_reporting(E_ALL);
?>
<html>
<head>
<title>Anonimous forum</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv = "content-language" content = "ru" />
<link rel="stylesheet" type="text/css" href="style.css">
<style>
.coder {
  background: #212121;
  color: #FFFFFF  ;
  font-family: monospace;
  border-radius: 5px;
  padding: 5px;
  display: inline-block;
  vertical-align: top;
  margin-top: 10px;
  margin-left: 50px;
}
.input_form
{
  background: #FAFAFA;
  font-family: monospace;
  padding: 5px;
  border-radius: 5px;
  display: inline-block;
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

  <?php include '../util.php'; youtube("2NpgXMfERn8"); ?>

  <!--div class="gaf210imvustylez_youtubebox" style="width:1px;height:1px;overflow:hidden">
    <iframe width="300" height="300" src="http://www.youtube.com/embed/eBhh23-paLU?autoplay=1&amp;loop=1&amp;playlist=eBhh23-paLU" frameborder="0" allowfullscreen></iframe>
  </div-->

<div class="coder">
<form action="record.php" method="post">
  Текст сообщения:<br>
  <textarea class="input_form" type="textarea" rows=10 cols=60 name="message">Sample text</textarea>
<div class="coder" style="margin-left: 0px;">
  <p><input type="checkbox" name="skills[]" value="drink">Пью</input><br>
  <input type="checkbox" name="skills[]" value="smoke">Курю</input><br>
  <input type="checkbox" name="skills[]" value="drug">Колюсь</input><br>
  <input type="checkbox" name="skills[]" value="dota">Играю в дотку</input> </p>
  <input  class="btn sweep" type="submit" value="Отправить">
</div>

<div class="input_form">
<?php
require_once 'recaptchalib.php';
 $publickey = '6LcqnBgTAAAAAKVuYUiDu9Kj8Vh5McvdJ08jZzVW'; // you got this from the signup page
 echo recaptcha_get_html($publickey);
?>
</div>

</form>
</div>
<br>

<?php
include 'message.php';
$file = fopen('records.txt', 'r');
while (!feof($file)) {
    $buffer = fgets($file);
    $msg = unserialize($buffer);
    if ($msg) {
        $style = '';
        if ($msg->drink == true) {
            $style = $style.'color: #C6FF00;';
        }
        if ($msg->smoke == true) {
            $style = $style.'font-style: italic;';
        }
        if ($msg->drug == true) {
            $style = $style.'font-weight: bold;';
        }
        if ($msg->dota == true) {
            $style = $style.'text-decoration: underline;';
        }
        ?>
<div class="coder"><p> <?php echo "<div style='color : gray;'>".date_format($msg->created, 'd/m/Y H:i:s')."</div><div style='".$style.";'>".$msg->text.'</div>';
        ?></p></div>
<?php

    }
}
fclose($file);
?>
<br>

</body>
</html>
