<?php
session_start();

require_once("Controller_users.class.php");

$controller = new Controller_users();
$login = $_SESSION['loggued'];
if (isset($_POST['login'], $_POST['password']) && !empty($_POST['login'])) {
    if ($controller->change_login($login, $_POST['login'], $_POST['password']))
        $controller->redirect_get("/view/account.php", ["edit_profile" => "success"]);
    else
        $controller->redirect_get("/view/account.php", ["edit_profile" => "fail"]);
}
if (isset($_POST['new_email'], $_POST['password']) && !empty($_POST['new_email'])) {
    if ($controller->change_email($login, $_POST['new_email'], $_POST['password']))
        $controller->redirect_get("/view/account.php", ["edit_email" => "success"]);
    else
        $controller->redirect_get("/view/account.php", ["edit_email" => "fail"]);
}
if (isset($_POST['old_pw'], $_POST['new_pw'], $_POST['confirm_new_pw'])) {
    if ($controller->change_password($login, $_POST['old_pw'], $_POST['new_pw'], $_POST['confirm_new_pw']))
        $controller->redirect_get("/view/account.php", ["edit_password" => "success"]);
    else
        $controller->redirect_get("/view/account.php", ["edit_password" => "fail"]);
}
if (isset($_POST['notif'])) {
    if ($_POST['notif'] != '0' && $_POST['notif'] != '1')
        $controller->redirect_get("/view/account.php", ['edit_notif' => 'fail']);
    else
        $controller->switch_notif($_SESSION['user_id'], $_POST['notif']);
}
$controller->redirect_get("../view/account.php", []);