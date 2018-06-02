<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title) ? $title : 'Camagru'; ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel='stylesheet' type='text/css' href='/public/css/style.css' />
    </head>
    <body>
        
        <nav class='container-fluid header'>
            <div class='row no-gutters'>
                <div class='col-lg-2'>
                    <a href='../index.php'><img class='logo_main' src='../public/img/logo_main.png'></a>
                </div>
                <?php session_start(); if (!isset($_SESSION['loggued'])): ?>
                    <div class='col-lg-2 offset-lg-8'>
                        <a href='/view/login.php'><button class='menu_button'>LOG IN</button></a></li>
                    </div>
                <?php else: ?>
                    <div class='col-lg-2 offset-lg-6'>
                        <a href='view/account.php'><button class='menu_button'>MY ACCOUNT</button></a>
                    </div>
                    <div class='col-lg-2'>
                        <a href='/controller/logout.php'><button class='menu_button'>LOG OUT</button></a>
                    </div>
                <?php endif ?>
            </div>
        </nav>