<?php

require_once('Controller.class.php');
require_once('../model/Model_users.class.php');

class Controller_users extends Controller {
    public function __construct() {
        $this->_table = 'users';
        $this->_model = new Model_users($this->_table);
    }

    // Redirect to a page with associative array keys and values as $_GET
    public function redirect_get($path, array $data) {
        $gets = "";
        if (isset($data) && !empty($data)) {
            $gets = "?";
            foreach ($data as $k => $e)
                $gets = $gets.$k."=".$e;
        }
        exit(header('Location:'.$path.$gets));
    }

    // Register user in database with hashed password
    public function register_user($login, $password, $email) {
        $pw = hash('whirlpool', $password);
        $login = strtolower($login);
        $email = strtolower($email);
        return ($this->_model->add_user($login, $pw, $email));
    }

    // Logs user if form is correct
    public function log_user($login, $password) {
        if ($this->_model->is_active($login) == FALSE)
            return (FALSE);
        if ($this->check_pw($login, $password) === FALSE)
            return (FALSE);
        session_start();
        $_SESSION['loggued'] = $login;
        return (TRUE);
    }

    // Checks if login and password match in database
    private function check_pw($login, $password) {
        $db_pw = $this->_model->get_user_pw($login);
        if ($db_pw === FALSE)
            return (FALSE);
        if ($password === $db_pw)
            return (TRUE);
        return (FALSE);
    }
}