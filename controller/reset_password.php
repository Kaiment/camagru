<?php

$root = realpath($_SERVER['DOCUMENT_ROOT']);
require_once("$root/controller/Controller_users.class.php");

$controller = new Controller_users();
if (!isset($_POST['email']) || empty($_POST['email']))
    $controller->redirect_get("/view/reset_password.php", ["reset" => "empty"]);
if ($controller->reset_password($_POST['email']))
    $controller->redirect_get("/view/login.php", ["reset" => "success"]);
else
    $controller->redirect_get("/view/reset_password.php", ["reset" => "fail"]);
