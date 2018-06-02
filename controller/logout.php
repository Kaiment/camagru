<?php

session_start();
if ($_SESSION['loggued'])
{
    unset($_SESSION['loggued']);
    exit(header('Location:../index.php?logout=success'));
} else {
    exit(header('Location:../index.php?logout=notloggued'));
}