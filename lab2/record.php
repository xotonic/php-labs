<?php

date_default_timezone_set('UTC');
//if (!isset($_POST["skills"])) { echo "No skills set"; return; }
if (!isset($_POST['message'])) {
    echo 'No text content';

    return;
}

require_once 'recaptchalib.php';
 $privatekey = '6LcqnBgTAAAAAOwLY3XqhSEUPPv-7rApdttIkGWG';
 $resp = recaptcha_check_answer($privatekey,
                               $_SERVER['REMOTE_ADDR'],
                               $_POST['recaptcha_challenge_field'],
                               $_POST['recaptcha_response_field']);

 if (!$resp->is_valid) {
     // What happens when the CAPTCHA was entered incorrectly
   die('КАПЧУ ВВЕДИ');
 } else {
     ini_set('display_errors', 1);
     ini_set('track_errors', 1);
     ini_set('html_errors', 1);
     error_reporting(E_ALL);
     include 'message.php';
     $post = $_POST['skills'];
     $msg = new Message();
     $str = implode($post, ' ');
     $msg->parse($str);

     if (strpos($str, 'drink') !== false) {
         $msg->drink = true;
     }
     if (strpos($str, 'smoke') !== false) {
         $msg->smoke = true;
     }
     if (strpos($str, 'drug') !== false) {
         $msg->drug = true;
     }
     if (strpos($str, 'dota') !== false) {
         $msg->dota = true;
     }

     $string = substr($_POST['message'], 0, 200);

     $msg->text = str_replace("\n", '<br>', strip_tags($string));
     $msg->created = new DateTime();
     $content = serialize($msg);
     $file = fopen('records.txt', 'a');
     flock($file, 2);
     fwrite($file, $content."\n");
     fclose($file);
     header('location:lab2_2.php');
 }
