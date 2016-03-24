<?php
include 'util.php';
//enable_debug();
$id = $_GET['id'];
?>
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Изменение элемента</title>
  <link rel="stylesheet" type="text/css" href="style.css">

  </head>
  <body>

    <?php include '../util.php'; coub("4fb32"); ?>

    <?php
    $SQL_categories = 'SELECT name from categories order by name asc';
    $SQL_countries = 'SELECT name from countries order by name asc';
    init_sql();
    check_cookie();
    $cat_result = send_and_check($SQL_categories);
    $country_result = send_and_check($SQL_countries);

    $SQL = 'SELECT  models.id as model_id,
    								models.name as model_name,
    								models.count as model_count,
    								models.price as model_price,
    								categories.name as categories_name,
    								countries.name as countries_name
    								from models, categories, countries
    								where models.id_category = categories.id and
    							models.id_country = countries.id and models.id ='.$id;
    $obj = mysql_fetch_object(send_and_check($SQL));

    /*foreach ($obj as $key => $value) {
        echo "$key = $value<br>";
    }*/
     ?>
    <div class="btn" >
    	<FORM METHOD="POST" ACTION="update.php" >
        <input hidden name="id" value="<?php echo $obj->model_id?>">
        <P >Введите новые данные<br>
    			<table>
    			<tr>
    				<td>Наименование</td>
    				<td><INPUT class="btn" type=text name="name" value="<?php echo $obj->model_name?>" size=20></td>
    			</tr>
    			<tr>
    				<td>Количество</td>
    				<td><INPUT class="btn" type=text name="count" value="<?php echo $obj->model_count?>" size=10>
    				</td>
    			</tr>
    			<tr>
    				<td>Цена</td>
    				<td><INPUT class="btn" type=text name="price" value="<?php echo $obj->model_price?>" size=10></td>
    			</tr>
    			<tr>
    				<td>Категория</td>
    				<td>
    					<select class="btn" name="category">
    						<option selected="selected"></option>
    						<?php
                            while ($row = mysql_fetch_assoc($cat_result)) {
                                $selected = $row['name'] == $obj->categories_name ? 'selected' : '';
                                echo "<option $selected>$row[name]</option>";
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
                            while ($row = mysql_fetch_assoc($country_result)) {
                                $selected = $row['name'] == $obj->countries_name ? 'selected' : '';
                                echo "<option $selected>$row[name]</option>";
                            }
                            ?>
    					</select>
    				</td>
    			</tr>
    			</table>
    			<br>
    				<INPUT class="btn sweep" type=submit value="ИЗМЕНИТЬ">
    		</FORM></P>
    		</div>
  </body>
