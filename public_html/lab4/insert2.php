<?php

include 'util.php';

enable_debug();
//ini_set('display_errors', 1);
//ini_set('track_errors', 1);
//ini_set('html_errors', 1);
//error_reporting(E_ALL);

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

$id_category = get_id_by_name($category, 'categories');
$id_country = get_id_by_name($country, 'countries');
$qmodel = 'INSERT into models(id_category, id_country, name, count, price)
values ('.$id_category.', '.$id_country.", '".$name."', ".$count. ", ".$price.")";
send_and_check($qmodel);
//$id_model = get_id_by_name($name, 'models');
//$qstorage = 'INSERT into storage(id_model, count, price) values ('.$id_model.', '.$count.', '.$price.')';
//send_and_check($qstorage);

header('location:table.php');
