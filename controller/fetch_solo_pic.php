<?php


$controller = new Controller_img();
$pic = $controller->get_pic($_GET['id']);
$pic_name = $pic['name'];
$author = $pic['login'];
date_default_timezone_set("Europe/Paris");
$date = date("d/m/Y H:i:s", $pic['date']);
$desc = $pic['desc'];
$likes = $pic['likes'];
if ($likes < 2)
    $likes .= " like";
else
    $likes .= " likes";