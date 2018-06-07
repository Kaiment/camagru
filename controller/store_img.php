<?php

require_once("Controller_img.class.php");

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    $cut = imagecreatetruecolor($src_w, $src_h); 
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    return ($dst_im);
}

session_start();
$controller = new Controller_img();

if (!isset($_POST["img"], $_POST["montage_img"], $_SESSION['loggued']))
    die();
$montage_img = $_POST["montage_img"];
$img = str_replace('data:image/jpeg;base64,', '', $_POST['img']);
$img = str_replace(" ", "+", $img);
$img = base64_decode($img);
file_put_contents("tmp.jpg", $img);

$src = imagecreatefrompng("../public/img/montage/$montage_img.png");
$dest = imagecreatefromjpeg("tmp.jpg");
imagealphablending($src, true);
imagesavealpha($src, true);
// Copy and merge
imagecopymerge_alpha($dest, $src, 0, 290, 0, 0, 200, 200, 100);


$login = $_SESSION['loggued'];
if (!file_exists("../public/img/users/$login"))
    mkdir("../public/img/users/$login");
$pic_token = $controller->create_token();
imagejpeg($dest, "../public/img/users/$login/$pic_token.jpg");
$controller->add_pic($login, $pic_token);

imagepng($src);
imagedestroy($dest);