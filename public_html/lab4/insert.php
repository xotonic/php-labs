<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Добавление элемента</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include '../util.php'; coub("6iwjm"); ?>

  <?php
  include 'util.php';
  $SQL_categories = 'SELECT name from categories order by name asc';
  $SQL_countries = 'SELECT name from countries order by name asc';
  @$connect = mysql_connect('localhost', 'user108', 'gun_centos_user_108');
  if (!$connect) {
      echo "Can't connect to database!";
      exit;
  }
  @$db = mysql_select_db('user108');
  if (!$db) {
      echo "Can't change database!";
      exit;
  }
  check_cookie();
  $cat_result = mysql_query($SQL_categories);

  if (!$cat_result) {
      $message  = 'Неверный запрос: ' . mysql_error() . "\n";
      $message .= 'Запрос целиком: ' . $SQL_categories;
      die($message);
  }

  $country_result = mysql_query($SQL_countries);

  if (!$country_result) {
      $message  = 'Неверный запрос: ' . mysql_error() . "\n";
      $message .= 'Запрос целиком: ' . $country_result;
      die($message);
  }
   ?>
  <div class="btn">
  	<FORM METHOD="POST" ACTION="insert2.php" >
  		<P >Введите новые данные<br>
  			<table>
  			<tr>
  				<td>Наименование</td>
  				<td><INPUT class="btn" type=text name="name" size=20></td>
  			</tr>
  			<tr>
  				<td>Количество</td>
  				<td><INPUT class="btn" type=text name="count" size=10>
  				</td>
  			</tr>
  			<tr>
  				<td>Цена</td>
  				<td><INPUT class="btn" type=text name="price" size=10></td>
  			</tr>
  			<tr>
  				<td>Категория</td>
  				<td>
  					<select class="btn" name="category">
  						<option selected="selected"></option>
  						<?php
  						while ($row = mysql_fetch_assoc($cat_result))
  						{
  							echo "<option>" . $row['name'] . "</option>";
  						}
  						?>
  					</select>
  				</td>
  			</tr>
  			<tr>
  				<td>Страна</td>
  				<td>
  					<select class="btn" name="country">
  						<option selected="selected"></option>
  						<?php
  						while ($row = mysql_fetch_assoc($country_result))
  						{
  							echo "<option>" . $row['name'] . "</option>";
  						}
  						?>
  					</select>
  				</td>
  			</tr>
  			</table>
  			<br>
  				<INPUT class="btn fade" type=submit value="ДОБАВИТЬ  ">
  		</FORM></P>
  		</div>
</body>
