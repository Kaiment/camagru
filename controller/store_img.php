<?php

require_once("Controller_img.class.php");

session_start();
$controller = new Controller_img();

$data = [];
$login = $_SESSION['loggued'];
$user_id = $_SESSION['user_id'];
if (!file_exists("../public/img/users/user$user_id"))
    mkdir("../public/img/users/user$user_id");
$pic_token = $controller->create_token();
$data['id'] = $controller->add_pic($login, $pic_token, time());
$tmp = file_get_contents("../public/img/users/user$user_id/tmp.jpg");
file_put_contents("../public/img/users/user$user_id/$pic_token.jpg", $tmp);
unlink("../public/img/users/user$user_id/tmp.jpg");
$data['base64'] = "data:image/jpeg;base64,".base64_encode(file_get_contents("../public/img/users/user$user_id/$pic_token.jpg"));
echo json_encode($data);