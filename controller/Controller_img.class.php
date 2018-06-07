<?php


$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/controller/Controller.class.php");
require_once("$root/model/Model_img.class.php");
require_once("$root/model/Model_users.class.php");

class Controller_img extends Controller {
    private $_db_img;
    private $_db_users;

    public function __construct() {
        $this->_db_img = new Model_img();
        $this->_db_users = new Model_users();
    }

    public function add_pic($login, $token) {
        $user_id = $this->_db_users->get_user_id($login);
        if (!$this->_db_img->add_pic($user_id, $login, $token))
            return (FALSE);
        return (TRUE);
    }
}