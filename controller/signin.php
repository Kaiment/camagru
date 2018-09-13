<?php

require_once('Controller_users.class.php');

$controller = new Controller_users();
if (!isset($_POST['login'], $_POST['password'], $_POST['confirm_password'], $_POST['email']) || empty($_POST['login']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['email']))
    $controller->redirect_get("/view/login.php", ["register" => "incomplete"]);
$login = strtolower($_POST['login']);
$pw = $_POST['password'];
if (!preg_match('/[0-9]*/', $pw) || strlen($pw) < 6)
    $controller->redirect_get("/view/login.php", ['register' => 'invalid_pw']);
else if ($pw !== $_POST["confirm_password"])
    $controller->redirect_get("/view/login.php", ["register" => "confirm_fail"]);
if ($controller->register_user($login, $pw, $_POST['email']))
    $controller->redirect_get('/view/login.php', ["register" => "success"]);
else
    $controller->redirect_get('/view/login.php', ["register" => "forbidden"]);