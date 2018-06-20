<?php

require_once("Controller_img.class.php");

session_start();
$controller = new Controller_img();

$login = $_SESSION['loggued'];
if (!file_exists("../public/img/users/$login"))
    die();
$pic_token = $controller->create_token();
$tmp = file_get_contents("../public/img/users/$login/tmp.jpg");
file_put_contents("../public/img/users/$login/$pic_token.jpg", $tmp);
$controller->add_pic($login, $pic_token, time());
unlink("../public/img/users/$login/tmp.jpg");
echo "data:image/jpeg;base64,".base64_encode(file_get_contents("../public/img/users/$login/$pic_token.jpg"));