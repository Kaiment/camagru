<?php

require('Controller_img.class.php');
require('Controller_users.class.php');

$controller_img = new Controller_img();
$controller_users = new Controller_users();

if (!isset($_POST['comment'], $_POST['user_id'], $_POST['pic_id']))
    die();
$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$pic_id = $_POST['pic_id'];
$controller_img->add_comment($pic_id, $user_id, $comment);
$user_login = $controller_users->get_user_by_id($user_id);
$res = ['user_login' => $user_login, 'comment' => $comment];
echo(json_encode($res));