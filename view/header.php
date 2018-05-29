<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title) ? $title : 'Camagru'; ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel='stylesheet' type='text/css' href='/public/css/style.css' />
    </head>
    <body>
        <nav class='navbar'>
            <div>
                <a href='/view/login.php'><button class='menu_button'>LOG IN</button></a></li>
                <a href='/view/signin.php'><button class='menu_button signin'>SIGN IN</button></a>
            </div>
        </nav>