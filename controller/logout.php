<?php

session_start();
if ($_SESSION['loggued'])
{
    unset($_SESSION['loggued']);
    header('Location:../index.php?logout=success');
} else {
    header('Location:../index.php?logout=notloggued');
}