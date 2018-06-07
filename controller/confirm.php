<?php

require_once('Controller_users.class.php');

$controller = new Controller_users();

if (!isset($_GET['id'], $_GET['key']))
    $controller->redirect_get('../index.php?confirm=fail', ['confirm' => 'fail']);
$controller->confirm_account($_GET['id'], $_GET['key']);
    $controller->redirect_get('../index.php?confirm=success', ['confirm' => 'success']);