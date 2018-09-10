<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/controller/Controller.class.php");
require_once("$root/model/Model_img.class.php");
require_once("$root/model/Model_users.class.php");

class Controller_img extends Controller {
    private $_model_img;
    private $_model_users;

    public function __construct() {
        $this->_model_img = new Model_img();
        $this->_model_users = new Model_users();
    }

    public function add_pic($login, $token, $time) {
        $user_id = $this->_model_users->get_user_id($login);
        if (!$this->_model_img->add_pic($user_id, $login, $token, $time))
            return (FALSE);
        return (TRUE);
    }

    public function delete_img($pic_id) {
        $this->_model_img->delete_img($pic_id);
    }

    public function add_like($pic_id, $user_id) {
        if (!$this->get_pic($pic_id))
            return FALSE;
        if ($this->_model_img->has_already_liked($pic_id, $user_id))
            return ($this->_model_img->remove_like($pic_id, $user_id));
        else
            return ($this->_model_img->add_like($pic_id, $user_id));
    }

    public function add_comment($pic_id, $user_id, $comment) {
        return ($this->_model_img->add_comment($pic_id, $user_id, $comment));
    }
    
    public function get_pic_comments($pic_id) {
        $comments = $this->_model_img->get_pic_comments($pic_id);
        foreach ($comments as $k => $c) {
            if (!$this->_model_users->get_user_by_id($c['userid'])) {
                $this->_model_img->delete_userid_comments($c['userid']);
                unset($comments[$k]);
            }
        }
        return (array_values($comments));
    }

    public function has_already_liked($pic_id, $user_id) {
        if (!$this->get_pic($pic_id))
            return FALSE;
        if ($this->_model_img->has_already_liked($pic_id, $user_id))
            return TRUE;
        return FALSE;
    }

    public function get_pic($id) {
        if (is_numeric($id))
            return ($this->_model_img->get_pic($id));
        return (FALSE);
    }

    public function get_one_page($page) {
        return ($this->_model_img->get_one_page($page));
    }

    public function get_all_user_pics($id) {
        return ($this->_model_img->get_all_user_pics($id));
    }
}