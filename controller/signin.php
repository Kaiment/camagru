<?php

require_once('Controller_users.class.php');

if (!isset($_POST['login'], $_POST['password'], $_POST['confirm_password'], $_POST['email']) || empty($_POST['login']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['email']))
    exit(header('Location:../view/login.php?register=incomplete'));
$controller = new Controller_users();
$login = $_POST['login'];
$pw = $_POST['password'];
if ($pw !== $_POST["confirm_password"])
    $controller->redirect_get("../view/login.php", ["register" => "confirm_fail"]);
if ($controller->register_user($login, $pw, $_POST['email']))
    $controller->redirect_get('/view/login.php', ["register" => "success"]);
else
    $controller->redirect_get('/view/login.php', ["register" => "forbidden"]);