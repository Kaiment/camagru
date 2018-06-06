<?php
session_start();

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/controller/Controller_users.class.php");

$controller = new Controller_users();
if (!isset($_POST['login'], $_POST['password']) || empty($_POST['login']) || empty($_POST['password']))
    $controller->redirect_get('/view/login.php', ['log' => 'fail']);
$login = $_POST['login'];
$pw = $_POST['password'];
if ($controller->log_user($login, $pw))
    $controller->redirect_get('/index.php', ['log' => 'success']);
else
    $controller->redirect_get('/view/login.php', ['log' => 'fail']);