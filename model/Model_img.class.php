<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/model/Model.class.php");

class Model_img extends Model {
    public function add_pic($user_id, $login, $name, $time) {
        $stmt = $this->_db->prepare("INSERT INTO pics (userid, `login`, `name`, `date`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, strtolower($login), $name, $time]);
        if ($stmt->rowCount() < 1)
            return (FALSE);
        return (TRUE);
    }

    public function get_pic($id) {
        $stmt = $this->_db->prepare("SELECT * FROM pics WHERE `id`=?");
        $stmt->execute([$id]);
        $pic = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($pic == FALSE)
            return FALSE;
        return ($pic);
    }

    public function get_one_page() {
        $stmt = $this->_db->prepare("SELECT * FROM pics ORDER BY `date`");
        $stmt->execute();
        $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($pics);
    }
}