<?php

session_start();
if ($_SESSION['loggued'])
{
    unset($_SESSION['loggued']);
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
    exit(header('Location:../index.php?logout=success'));
} else {
    exit(header('Location:../index.php?logout=notloggued'));
}