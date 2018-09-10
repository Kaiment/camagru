<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/controller/Controller.class.php");
require_once("$root/model/Model_users.class.php");

class Controller_users extends Controller {
    public function __construct() {
        $this->_table = 'users';
        $this->_model = new Model_users();
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

    public function get_user_by_id($id) {
        return ($this->_model->get_user_by_id($id));
    }

    public function get_email_by_picid($pic_id) {
        $user_id = $this->_model->get_user_id_from_pic($pic_id);
        $email = $this->_model->get_email_by_id($user_id);
        if (!$email)
            return FALSE;
        return ($email['email']);
    }

    public function notif_enabled($pic_id) {
        return ($this->_model->notif_enabled($pic_id));
    }

    public function notif_enabled_by_userid($user_id) {
        return ($this->_model->notif_enabled_by_userid($user_id));
    }

    public function switch_notif($id, $switch) {
        $this->_model->switch_notif($id, $switch);
        $this->redirect_get("/view/account.php", ['edit_notif' => 'success']);
    }

    // Register user in database with hashed password
    public function register_user($login, $password, $email) {
        $pw = $this->hash($password);
        return ($this->_model->add_user($login, $pw, $email));
    }

    // Logs user if form is correct
    public function log_user($login, $password) {
        if ($this->_model->is_active($login) == FALSE)
            return (FALSE);
        if ($this->check_pw($login, $password) === FALSE)
            return (FALSE);
        $_SESSION['loggued'] = $login;
        $_SESSION['email'] = $this->_model->get_user_email($login);
        $_SESSION['user_id'] = $this->_model->get_user_id($login);
        return (TRUE);
    }

    public function change_login($login, $new_login, $password) {
        if (!$this->check_pw($login, $password))
            return (FALSE);
        if (!$this->_model->update_login(strtolower($login), $new_login))
            return (FALSE);
        $_SESSION['loggued'] = $new_login;
        return (TRUE);
    }

    public function change_email($login, $email, $password) {
        if (!$this->check_pw($login, $password))
            return (FALSE);
        if (!$this->_model->update_email($login, $email))
            return (FALSE);
        $_SESSION['email'] = $email;
        return (TRUE);
    }

    public function change_password($login, $old_pw, $new_pw, $confirm_new_pw) {
        if ($new_pw !== $confirm_new_pw)
            return (FALSE);
        if (!$this->check_pw($login, $old_pw))
            return (FALSE);
        if (!$this->_model->update_password($login, $this->hash($new_pw)))
            return (FALSE);
        return (TRUE);
    }
    // Reset user's password with new random token.
    public function reset_password($email) {
        if (!$this->_model->email_exists($email))
            return FALSE;
        $new_password = $this->create_token();
        $new_password = $this->hash($new_password);
        if ($this->_model->update_password($email, $new_password) === FALSE)
            return (FALSE);
        mail($email, "Reset password", "Hello,\nYour new password is : $new_password.\nDon't forget to change your password once again after logging in.");
        return (TRUE);
    }

    //Confirms account
    public function confirm_account($id, $key) {
        if (!$this->_model->get_user_by_id($id))
            return FALSE;
        $db_key = $this->_model->get_account_key($id);
        if ($key === $db_key) {
            $this->_model->set_account_active($id);
            return (TRUE);
        }
        return (FALSE);
    }

    // CHECK IF PASSWORD IS PROTECTED
    public function password_is_safe($pw) {
        if (strlen($pw) < 8)
            return FALSE;
        
    }

    // Checks if login and password match in database
    private function check_pw($login, $password) {
        $password = $this->hash($password);
        $db_pw = $this->_model->get_user_pw($login);
        if ($password === $db_pw)
            return (TRUE);
        return (FALSE);
    }

    private function hash($pw) {
        return (hash('whirlpool', $pw));
    }
}