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

    public function get_pic($id) {
        if (is_numeric($id))
            return ($this->_model_img->get_pic($id));
        return (FALSE);
    }

    public function get_one_page() {
        return ($this->_model_img->get_one_page());
    }
}