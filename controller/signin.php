<?php

require_once('Controller_users.class.php');

if (!isset($_POST['login'], $_POST['password'], $_POST['confirm_password']))
    header('Location:../index.php?form=incomplete');
$controller = new Controller_users();
$controller->register_user($_POST['login'], $_POST['password'], $_POST['confirm_password']);
header('Location:../index.php?form=success');