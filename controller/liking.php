<?php

require_once("../controller/Controller_img.class.php");

$controller = new Controller_img();

if (isset($_POST['pic_id'], $_POST['user_id']))
    echo $controller->add_like($_POST['pic_id'], $_POST['user_id']);