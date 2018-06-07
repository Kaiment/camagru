<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/model/Model.class.php");

class Model_img extends Model {
    public function add_pic($user_id, $login, $name) {
        $stmt = $_db->prepare("INSERT INTO pics (userid, `login`, `name`) VALUES ?, ?, ?");
        $stmt->execute($user_id, $login, $name);
        if ($stmt->rowCount() < 1)
            return (FALSE);
        return (TRUE);
    }
}