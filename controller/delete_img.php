<?php

session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['pic_id']) || empty($_GET['pic_id']))
    die(FALSE);
$user_id = $_SESSION['user_id'];
$pic_id = $_GET['pic_id'];

require('Controller_img.class.php');

$controller_img = new Controller_img();
if ($controller_img->delete_pic($user_id, $pic_id) === TRUE)
    echo TRUE;
else
    echo FALSE;