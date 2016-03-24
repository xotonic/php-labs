<?php

include 'util.php';
//setlocale(LC_ALL,"ru_RU.WIN1251");
//enable_debug();
$size_x = 480;
$size_y = 480;
$axis_x = 80;
$axis_y = 80;
$bwidth = 32;
$bspacing = 10;

$table = 'countries';

if (isset($_GET['size_x'])) $size_x = $_GET['size_x'];
if (isset($_GET['size_y'])) $size_y = $_GET['size_y'];
if (isset($_GET['axis_x'])) $axis_x = $_GET['axis_x'];
if (isset($_GET['axis_y'])) $axis_y = $_GET['axis_y'];
if (isset($_GET['table'])) $table = $_GET['table'];
// SQL BLOCK
init_sql();
$query = '';
if ($table == "countries")
$query = "SELECT distinct id_country as idc, countries.name as name,
(select count(*) from models where models.id_country = idc) as count
from models, countries where countries.id = models.id_country";
elseif($table == "categories")
$query = "SELECT distinct id_category as idc, categories.name as name,
(select count(*) from models where models.id_category = idc) as count
from models, categories where categories.id = models.id_category";
else die("Cant find table $table");

$sql = send_and_check($query);

$max_count = 0;
$count = 0;
$names = array();
$counts = array();
while ($data = mysql_fetch_assoc($sql)) {
    ++$count;
    if ($max_count < $data['count']) {
        $max_count = $data['count'];
    }
    $names[] = $data["name"];
    $counts[] = $data['count'];
}
$max_y = $max_count + 1;
mysql_free_result($sql);

// INITIALISATION
$im = @imagecreatetruecolor($size_x, $size_y) or die('Cant Initialize GD');

$white = imagecolorallocate($im, 255, 255, 255);
$bcolor = imagecolorallocate($im, 150, 150, 150);
$light = imagecolorallocate($im, 255, 255, 0);

// TITLES
$title_countries = 'Статистика по странам';
$title_categories = 'Статистика по жанрам';
$font = 'font.ttf';
$names_s = 'Наименования';
$count_s = 'Кол-во';
imagettftext( $im, 8, 0, $size_x/2 - 80, $axis_y/2 - 16, $white, $font, $table == 'countries' ? $title_countries : $title_categories);
$frame = imagettfbbox ( 8 , 0, $font , $names_s );
imagettftext( $im, 8, 0, $size_x/2 - ($frame[2] - $frame[0])/2, $size_y - ($axis_y/2-20 - ($frame[3]-$frame[5])), $white, $font, $names_s);
$frame = imagettfbbox ( 8 , 0, $font , $count_s );
imagettftext( $im, 8, 0, $axis_x/2 - ($frame[2] - $frame[0])/2, $axis_y/2 - ($frame[3]-$frame[5]), $white, $font, $count_s);

// Y CONTENT
$y = 0;
while ($y < $max_y) {
    $ystep_pixels = (($size_y - $axis_y)*($y)) / $max_y + $axis_y / 2;
    imagestring($im, 2, $axis_x/2 - 16, $size_y - $ystep_pixels - 8, "$y", $y%2 == 1   ? $bcolor : $white);
    imageline(
    $im, $axis_x/2,
    $size_y - $ystep_pixels,
    $size_x - $axis_x/2,
    $size_y - $ystep_pixels,
    $bcolor);
    $y ++;
}
// X CONTENT
$x = 0;
while ($x < $count)
{
  $xstep = $axis_x/2 + $bspacing + $x*($size_x - $axis_x)/$count;
  imagestring($im, 2 ,$xstep, $size_y - $axis_y/2 + 4, $names[$x], $white);
  imagefilledrectangle($im, $xstep, $size_y - $axis_y/2, $xstep + $bwidth, $size_y - $axis_y/2 - $counts[$x]*(($size_y - $axis_y) / $max_y), $light);
  $x++;
}

// AXISES
imageline($im, $axis_x / 2, $axis_y / 2, $axis_x / 2, $size_y - $axis_y / 2, $white);
imageline($im, $axis_x / 2, $size_y - $axis_y / 2, $size_x - $axis_x / 2, $size_y - $axis_y / 2, $white);
// BORDER
imagerectangle($im, 0,0,$size_x -1, $size_y -1, $white);

header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
