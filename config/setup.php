<?php

require_once('database.php');

$users_table = 'CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        `login` VARCHAR(15) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        is_admin BOOLEAN NOT NULL default FALSE,
        is_active BOOLEAN NOT NULL default FALSE,
        notif BOOLEAN NOT NULL default TRUE)';

$active_account_table = 'CREATE TABLE IF NOT EXISTS confirm(
        id INT AUTO_INCREMENT PRIMARY KEY,
        userid VARCHAR(128) NOT NULL,
        `key` VARCHAR(256) NOT NULL)';

$pictures_table = "CREATE TABLE IF NOT EXISTS pics(
        id INT AUTO_INCREMENT PRIMARY KEY,
        userid VARCHAR(128) NOT NULL,
        `login` VARCHAR(15) NOT NULL,
        `name` VARCHAR(32) NOT NULL,
        likes VARCHAR(128) NOT NULL default '0')";

try {
    $dbh = new PDO($SERV_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("CREATE DATABASE IF NOT EXISTS ".$DB_NAME);
    $dbh->exec("use ".$DB_NAME);
    $dbh->exec($users_table);
    $dbh->exec($active_account_table);
    $dbh->exec($pictures_table);
    echo "Database ready to use\n";
} catch (PDOException $e) {
    echo "Error creating database : " . $e->getMessage();
}