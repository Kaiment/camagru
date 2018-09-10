<?php

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
    $cut = imagecreatetruecolor($src_w, $src_h); 
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    return ($dst_im);
}

session_start();

if (!isset($_POST["img"], $_POST["montage_img"], $_SESSION['loggued'], $_SESSION['user_id']))
    die();
$login = $_SESSION['loggued'];
$user_id = $_SESSION['user_id'];
if (!file_exists("../public/img/users/user$user_id"))
    mkdir("../public/img/users/user$user_id");
$montage_img = $_POST["montage_img"];
$img = str_replace('data:image/jpeg;base64,', '', $_POST['img']);
$img = str_replace(" ", "+", $img);
$img = base64_decode($img);
file_put_contents("../public/img/users/user$user_id/tmp.jpg", $img);
$src = imagecreatefrompng("../public/img/montage/$montage_img.png");
$dest = imagecreatefromjpeg("../public/img/users/user$user_id/tmp.jpg");
imagealphablending($src, true);
imagesavealpha($src, true);
imagecopymerge_alpha($dest, $src, 0, 290, 0, 0, 200, 200, 100);
imagejpeg($dest, "../public/img/users/user$user_id/tmp.jpg");
imagedestroy($dest);
echo "data:image/jpeg;base64,".base64_encode(file_get_contents("../public/img/users/user$user_id/tmp.jpg"));