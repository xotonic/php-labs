<?php
$is_cookies = isset($_COOKIE["checkboxes"]);
$is_background = false;
$is_image = false;
$is_text = false;
$is_music = false;
if (is_cookies == true)
{
  $cookies = $_COOKIE["checkboxes"];
  if (strpos($cookies,"background") !== false) $is_background= true;
  if (strpos($cookies,"image") !== false) $is_image= true;
  if (strpos($cookies,"text") !== false) $is_text= true;
  if (strpos($cookies,"music") !== false) $is_music= true;
}
 ?>
<html>
<head>
<title>COOKIES</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv = "content-language" content = "ru" />

<style type = "text/css">
.block {
background: #030303;
border: solid 3px #FFEA00;
color: #FFEA00;
padding: 10px;
}
.story {
color: white;
padding: 10px;
font-size: 13pt;
}
</style>

</head>
<?php
 if ($is_background == true )
 echo '<body style="background-image : url(\'https://cdn1.artstation.com/p/assets/images/images/001/146/569/large/ulrick-wery-tileableset2-grass.jpg?1441028617\')">';
else echo '<body style="background: black;">';
 ?>
<? if($is_music==true) {?>
<div class="gaf210imvustylez_youtubebox" style="width:1px;height:1px;overflow:hidden">
  <iframe width="300" height="300" src="http://www.youtube.com/embed/665YQCxqFsw?autoplay=1&amp;loop=1&amp;playlist=665YQCxqFsw" frameborder="0" allowfullscreen></iframe>
</div>
<?}?>
<div class="block">
  <?php
    if ($is_cookies == false)
    echo "<h1>Здравствуй, мой <b>новый</b> повелитель! Чего желаешь?</h1>";
    else echo "<h1>Приветствую тебя <b>снова</b>, повелитель! Вот все как ты и просил!</h1>"
   ?>
 </div>
   <div class="block">
  <form action="cookie.php" method="post">
    <input name="data[]" type="checkbox" value="text" <?php if($is_text==true) echo "checked" ?>>Хочу узреть рукописи святые!</input><br>
    <input name="data[]" type="checkbox" value="image" <?php if($is_image==true) echo "checked" ?>>Хочу войско непобедимое!</input><br>
    <input name="data[]" type="checkbox" value="background" <?php if($is_background==true) echo "checked" ?>>Хочу земли плодородные!</input><br>
    <input name="data[]" type="checkbox" value="music" <?php if($is_music==true) echo "checked" ?>>Хочу услыхать песнь божью!</input><br>
    <br>
    <input class="block" type="submit" value="ВЫПОЛНЯЙ!"/>
  </form>
</div>
  <br>
  <p>
  <?php
   if ( $is_image == true)
   echo '<img src="http://www.spriters-resource.com/resources/sheets/27/29407.png" align="left" width="60%"/>';
   if ( $is_text == true)
   //echo "TEXT!<br>";
    {
      ?>
      <div class="story">
      Здраствуйте. Я, Кирилл. Хотел бы чтобы вы сделали игру, 3Д-экшон суть такова...
      Пользователь может играть лесными эльфами, охраной дворца и злодеем.
      И если пользователь играет эльфами то эльфы в лесу, домики деревяные набигают солдаты дворца и злодеи. Можно грабить корованы...
      И эльфу раз лесные то сделать так что там густой лес... А движок можно поставить так что вдали деревья картинкой, когда подходиш они преобразовываются в 3-хмерные деревья.
      Можно покупать и т.п. возможности как в Daggerfall. И враги 3-хмерные тоже, и труп тоже 3д.
      Можно прыгать и т.п. Если играть за охрану дворца то надо слушаться командира, и защищать дворец от злого (имя я не придумал) и шпионов, партизанов эльфов, и ходит на набеги на когото из этих (эльфов, злого...).
      Ну а если за злого... то значит шпионы или партизаны эльфов иногда нападают, пользователь сам себе командир может делать что сам захочет прикажет своим войскам с ним самим напасть на дворец и пойдет в атаку.
      Всего в игре 4 зоны. Т.е. карта и на ней есть 4 зоны, 1 - зона людей (нейтрал), 2- зона императора (где дворец), 3-зона эльфов, 4 - зона злого... (в горах, там есть старый форт...)
Так же чтобы в игре могли не только убить но и отрубить руку и если пользователя не вылечат
то он умрет, так же выколоть глаз но пользователь может не умереть а просто пол экрана не видеть, или достать или купить протез, если ногу тоже либо умреш либо будеш ползать либо на коляске котаться, или самое хорошее... поставить протез. Сохранятся можно...

P.S. Я джва года хочу такую игру.
</div>
      <?php
    } ?>
 </p>
</body>
</html>
