<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title) ? $title : 'Camagru'; ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel='stylesheet' type='text/css' href='/public/css/style.css' />
    </head>
    <body>
        
        <nav class='container-fluid header'>
            <div class='row no-gutters'>
                <div class='col-lg-2'>
                    <a href='../index.php'><img class='logo_main' src='../public/img/logo_main.png'></a>
                </div>
                <?php session_start(); if (!isset($_SESSION['loggued'])): ?>
                        <a href='/view/add_photo.php' class='col-lg-2 offset-lg-6 menu_button'><i class="fa fa-camera"></i> GALERIE</a>
                        <a href='/view/login.php' class='col-lg-2 menu_button'><i class="fa fa-power-off"></i> LOG IN / REGISTER</a>
                <?php else: ?>
                        <a href='/view/galerie.php' class='col-lg-2 offset-lg-2 menu_button'><i class="fa fa-camera"></i> GALERIE</a>
                        <a href='/view/add_photo.php' class='col-lg-2 menu_button'><i class="fa fa-plus-circle"></i> ADD PHOTO</a>
                        <a href='/view/account.php' class='col-lg-2 menu_button'><i class="fa fa-user"></i> MY ACCOUNT</a>
                        <a href='/controller/logout.php' class='col-lg-2 menu_button'><i class="fa fa-power-off"></i> LOG OUT</a>
                <?php endif ?>
            </div>
        </nav>