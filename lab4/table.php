<?php
include 'util.php';
//enable_debug();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>База данных</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include '../util.php'; youtube("r9944B_Cmbk"); ?>
	

<center>
<h1 class="btn">Интернет магазин YOBA-SHOP.RU</h1>
<?php
$SQL = 'SELECT  models.id as model_id,
								models.name as model_name,
								models.count as model_count,
								models.price as model_price,
								categories.name as categories_name,
								countries.name as countries_name
								from models, categories, countries
								where models.id_category = categories.id and
							models.id_country = countries.id ';

// filtering
if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    foreach ($filter as $key => $value) {
        //echo $key . " = " . $value . "<br>";

        switch ($value) {
            case 'name':
            {
                $text = $_POST['filter_name'];
                $SQL .= "and models.name like '%$text%' ";
                break;
            }
            case 'count':
            {
                $min = $_POST['filter_count_min'];
                $max = $_POST['filter_count_max'];
                if ($min) {
                    $SQL .= "and models.count > $min ";
                }
                if ($max) {
                    $SQL .= "and models.count < $max ";
                }
                break;
            }
            case 'price':
            {
                $min = $_POST['filter_price_min'];
                $max = $_POST['filter_price_max'];
                if ($min) {
                    $SQL .= "and models.price > $min ";
                }
                if ($max) {
                    $SQL .= "and models.price < $max ";
                }
                break;
            }
            case 'category':
            {
                $text = $_POST['filter_category'];
                $SQL .= "and categories.name = '$text' ";
                break;
            }
            case 'country':
            {
                $text = $_POST['filter_country'];
                $SQL .= "and countries.name = '$text' ";
                break;
            }
        }
    }
}

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
@$ss = mysql_query($SQL);
$nr = mysql_num_rows($ss);
$nf = mysql_num_fields($ss);

$can_change = false;
if (isset($_COOKIE['id'])) {
    $query = send_and_check("SELECT type, login FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);
    if ($userdata['type'] == 'moderator') {
        $can_change = true;
    }
		echo "<br><div class='btn'>Sup, $userdata[type] $userdata[login]</div><br>";
		echo "<br><div class='btn'><a href='logout.php'>Выйти<a></div><br>";

} else { die("Куки потерял");}
$cat_result = mysql_query($SQL_categories);

if (!$cat_result) {
    $message = 'Неверный запрос: '.mysql_error()."\n";
    $message .= 'Запрос целиком: '.$SQL_categories;
    die($message);
}

$country_result = mysql_query($SQL_countries);

if (!$country_result) {
    $message = 'Неверный запрос: '.mysql_error()."\n";
    $message .= 'Запрос целиком: '.$country_result;
    die($message);
}

?>
<tr></table>
<div>
	<FORM  METHOD="POST" ACTION="table.php" >
		<P class="btn" >Фильтр<br>
			<table>
			<tr>
				<td><input type=checkbox name=filter[] value="name"><div class="btn">По имени</div></td>
				<td><INPUT  class="btn" type=text name="filter_name" size=20></td>
			</tr>
			<tr>
				<td><input type=checkbox name=filter[] value="count"><div class="btn">По количеству</div></td>
				<td><INPUT class="btn" type=text name="filter_count_min" size=10> - <INPUT class="btn" type=text name="filter_count_max" size=10>
				</td>
			</tr>
			<tr>
				<td><input type=checkbox name=filter[] value="price"><div class="btn">По цене</div></td>
				<td><INPUT class="btn" type=text name="filter_price_min" size=10> - <INPUT class="btn" type=text name="filter_price_max" size=10></td>
			</tr>
			<tr>
				<td><input type=checkbox name=filter[] value="category"><div class="btn">По категории</div></td>
				<td>
					<select class="btn" name="filter_category">
						<option selected="selected">Выберите</option>
						<?php
                        while ($row = mysql_fetch_assoc($cat_result)) {
                            echo '<option>'.$row['name'].'</option>';
                        }
                        ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><input  type=checkbox name=filter[] value="country"><div class="btn">По стране</div></td>
				<td>
					<select class="btn" name="filter_country">
						<option selected="selected">Выберите</option>
						<?php
                        while ($row = mysql_fetch_assoc($country_result)) {
                            echo '<option>'.$row['name'].'</option>';
                        }
                        ?>
					</select>
				</td>
			</tr>
			</table>
			<br>
				<INPUT class="fade btn" type=submit value="ПОИСК">
		</FORM></P>
		</div>
<?php if ($can_change == true) {
    ?>
					<A class="fade btn" HREF=insert.php> Добавить</A> <br>
<?php
} ?>
<center><table class="btn"  cellpadding=5/>
<?php
// printing headers
while ($field = mysql_fetch_field($ss)) {
    echo '<th><b>'.$field->name.'</b></th>';
}

// printing rows
while ($obj = mysql_fetch_object($ss)) {
    echo '<tr>';
    foreach ($obj as $key => $value) {
        echo '<td>'.$value.'</td>';
    }

    if ($can_change == true) {
        // update link
    echo "<td><a class='fade' href=update_form.php?id=$obj->model_id&name=".urlencode($obj->model_name).
    "&count=$obj->model_count&price=$obj->model_price&category=".urlencode($obj->categories_name).
    '&country='.urlencode($obj->countries_name).'>Изменить</a></td>';
    // delete link
    echo "<td><a class='fade' href=delete.php?id=$obj->model_id>Удалить</a></td>";
        echo    '</tr>';
    }
}
?>
</table></center>
</body>
