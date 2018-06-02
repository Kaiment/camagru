<?php

require_once('Model.class.php');

class Model_users extends Model {
    // Adds user with encrypted password
    public function add_user($login, $password, $email) {
        if ($this->login_exists($login) === TRUE)
            return (FALSE);
        $stmt = $this->_db->prepare("INSERT INTO users (`login`, `password`, email) VALUES (?, ?, ?)");
        $stmt->execute([$login, $password, $email]);
        $this->add_to_confirm($login, $password, $email);
        $this->send_confirm_mail($login);
        return (TRUE);
    }

    // Returns user data or FALSE
    public function get_user($login) {
        $stmt = $this->_db->prepare("SELECT * FROM users WHERE `login`=?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === NULL || $user === FALSE)
            return (FALSE);
        return ($user);
    }

    // Returns user's password or FALSE if user is not found
    public function get_user_pw($login) {
        $stmt = $this->_db->prepare("SELECT `password` FROM users WHERE `login`=?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === NULL || $user === FALSE)
            return (FALSE);
        else
            return ($user['password']);
    }

    public function send_confirm_mail($login) {
        $user = $this->get_user($login);
        $mail = $user['email'];
        $pw = $user['password'];
        $user_id = $user['id'];
        $key = hash('whirlpool', $login.$mail.$pw);
        $subject = "Action required : Please confirm your account on Instalike";
        $txt = "Hello $login,\nYou can click on the link below to activate your account :\nlocalhost:8008?id=$user_id&key=$key";
        if (mail($mail, $subject, $txt) === false)
            echo 'fail :(';
    }

    // Checks if account is active
    public function is_active($login) {
        $stmt = $this->_db->prepare("SELECT is_active FROM users WHERE `login`=?");
        $stmt->execute([$login]);
        $is_active = $stmt->fetch(PDO::FETCH_ASSOC);
        $is_active = $is_active['is_active'];
        if ($is_active)
            return (TRUE);
        else
            return (FALSE);
    }

    // Returns TRUE or FALSE whether user exists or not
    private function login_exists($login) {
        $stmt = $this->_db->prepare("SELECT * FROM users WHERE `login`=?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();
        if ($user === NULL || $user === FALSE)
            return FALSE;
        return TRUE;
    }

    private function add_to_confirm($login, $password, $email) {
        $confirm_hash = hash('whirlpool', $login.$password.$email);
        $stmt = $this->_db->prepare("SELECT id from users WHERE `login`=?");
        $stmt->execute([$login]);
        $user_id = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $user_id['id'];
        $stmt = $this->_db->prepare("INSERT INTO confirm (userid, `key`) VALUES (?, ?)");
        $stmt->execute([$user_id, $confirm_hash]);
    }
}