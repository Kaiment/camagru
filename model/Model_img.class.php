<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/model/Model.class.php");

class Model_img extends Model {
    public function add_pic($user_id, $login, $name, $time) {
        $stmt = $this->_db->prepare("INSERT INTO pics (userid, `login`, `name`, `date`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, strtolower($login), $name, $time]);
        if ($stmt->rowCount() < 1)
            return (FALSE);
        return ($this->_db->lastInsertId());
    }

    public function add_like($pic_id, $user_id) {
        $stmt = $this->_db->prepare("INSERT INTO likes (pic_id, liker_id) VALUES (?, ?)");
        $stmt->execute([$pic_id, $user_id]);
        $this->_db->query("UPDATE pics SET likes = likes + 1 WHERE id = $pic_id");
        if ($stmt->rowCount() < 1)
            return (FALSE);
        $nb_likes = $this->_db->query("SELECT likes FROM pics WHERE id = $pic_id");
        return ($nb_likes->fetch(PDO::FETCH_ASSOC)['likes']);
    }

    public function remove_like($pic_id, $user_id) {
        $stmt = $this->_db->prepare("DELETE FROM likes WHERE pic_id=? AND liker_id=?");
        $stmt->execute([$pic_id, $user_id]);
        $this->_db->query("UPDATE pics SET likes = likes - 1 WHERE id = $pic_id");
        if ($stmt->rowCount() < 1)
            return (FALSE);
        $nb_likes = $this->_db->query("SELECT likes FROM pics WHERE id = $pic_id");
        return ($nb_likes->fetch(PDO::FETCH_ASSOC)['likes']);
    }

    public function has_already_liked($pic_id, $user_id) {
        $stmt = $this->_db->prepare("SELECT * FROM likes WHERE pic_id=? AND liker_id=?");
        $stmt->execute([$pic_id, $user_id]);
        $status = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($status == FALSE)
            return FALSE;
        return TRUE;
    }

    public function add_comment($pic_id, $user_id, $comment) {
        $stmt = $this->_db->prepare("INSERT INTO comments (pic_id, userid, comment) VALUES(?, ?, ?)");
        $stmt->execute([$pic_id, $user_id, $comment]);
        return (TRUE);
    }
    
    public function get_pic_comments($pic_id) {
        $stmt = $this->_db->prepare("SELECT userid, comment FROM comments WHERE pic_id=?");
        $stmt->execute([$pic_id]);
        return ($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function delete_img($pic_id) {
        $stmt = $this->_db->prepare("DELETE FROM pics WHERE id=?");
        $stmt->execute([$pic_id]);
    }

    public function delete_userid_comments($userid) {
        $stmt = $this->_db->prepare("DELETE FROM comments WHERE userid=?");
        $stmt->execute([$userid]);
    }

    public function get_pic($id) {
        $stmt = $this->_db->prepare("SELECT * FROM pics WHERE `id`=?");
        $stmt->execute([$id]);
        $pic = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($pic == FALSE)
            return FALSE;
        return ($pic);
    }

    public function get_one_page($page) {
        $range = $page * 10;
        $stmt = $this->_db->prepare("SELECT * FROM pics ORDER BY `date` LIMIT ?, 9");
        $stmt->bindParam(1, $range, PDO::PARAM_INT);
        $stmt->execute();
        $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($pics);
    }

    public function get_all_user_pics($id) {
        $stmt = $this->_db->prepare("SELECT `name`, id FROM pics WHERE userid=?");
        $stmt->execute([$id]);
        $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($pics);
    }
}