<?php

require_once('database.php');

$users_table = 'CREATE TABLE IF NOT EXISTS users(
        ID INT AUTO_INCREMENT PRIMARY KEY,
        `login` VARCHAR(15) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        is_admin BOOLEAN NOT NULL,
        notif BOOLEAN NOT NULL);';

try {
    $dbh = new PDO($SERV_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("CREATE DATABASE IF NOT EXISTS ".$DB_NAME);
    $dbh->exec("use ".$DB_NAME);
    $dbh->exec($users_table);
    echo "Database ready to use\n";
} catch (PDOException $e) {
    echo "Error creating database : " . $e->getMessage();
}