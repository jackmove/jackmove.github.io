<?php session_start();
##############################################################################
##############################################################################
header('Content-type: image/png');
$img = ImageCreateFromPNG('files/bg.png');

$cod= rand(0,99999);
$_SESSION['captcha_code']=$cod;

$color = ImageColorAllocate($img, 149, 165, 155);
$ttf = 'files/font.ttf';
$ttfsize = 21; 
$angle = rand(0,4); 
$t_x = rand(5,40);
$t_y = 24;

imagettftext($img, $ttfsize, $angle, $t_x, $t_y, $color, $ttf, $cod);
imagepng($img);
imagedestroy($img);
##############################################################################
##############################################################################
?>