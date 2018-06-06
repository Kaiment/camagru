<?php


if (!isset($_POST["img"]))
    die();
$img = $_POST['img'];
file_put_contents("img.txt", $img);