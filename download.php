<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$image_link = "jpg";//
$split_image = pathinfo($image_link);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL , $image_link);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$response= curl_exec ($ch);
curl_close($ch);
$file_name = "images-folder/".$split_image['filename'].".".$split_image['extension'];
$file = fopen($file_name , 'w') or die("X_x");
fwrite($file, $response);
fclose($file);
?>