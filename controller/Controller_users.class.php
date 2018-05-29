<?php

require_once('Controller.class.php');
require_once('../model/Model_users.class.php');

class Controller_users extends Controller {
    public function __construct() {
        $this->model = new Model_users();
        $this->table = 'users';
    }

    public function register_user($login, $password) {
        $pw = hash('whirlpool', $password);
        $this->model->add_user(strtolower($login), $pw, $this->table);
    }

    public function log_user($login, $password) {
        $pw = hash('whirlpool', $password);
        if (check_pw($login, $pw) === FALSE);
            return (FALSE);
        $_SESSION['loggued'] = $login;
        return (TRUE);
    }

    // Checks if login and password match in database
    private function check_pw($login, $password) {
        $db_pw = $this->model->get_user(strtolower($login), $this->table);
        if ($db_pw === FALSE)
            return (FALSE);
        if ($password === $db_pw)
            return (TRUE);
        return (FALSE);
    }
}