
<?php

include 'util.php';

enable_debug();
init_sql();

$name = $country = $category = '';
$count = 0;
$price = 0.0;

$name = test_input($_POST['name']);
$country = test_input($_POST['country']);
$category = test_input($_POST['category']);
$count = test_input($_POST['count']);
$price = test_input($_POST['price']);

if ($name == '') {
    echo 'Name is empty';
    exit;
}
if ($count == '') {
    echo 'Count not entered';
    exit;
}
if ($price == '') {
    echo 'Price not entered';
    exit;
}
if ($category == '') {
    echo 'Category not choosed';
    exit;
}
if ($country == '') {
    echo 'Country not choosed';
    exit;
}

$SQL = "UPDATE models SET name = '$name', count = $count, price = $price, ".
'id_category = '.get_id_by_name($category, 'categories').', id_country = '.get_id_by_name($country, 'countries').
" WHERE id = $_POST[id]";

send_and_check($SQL);
header('location:index.php');
