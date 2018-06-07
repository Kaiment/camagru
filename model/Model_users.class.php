<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/model/Model.class.php");

class Model_users extends Model {
    // Adds user with encrypted password
    public function add_user($login, $password, $email) {
        if ($this->login_exists($login) === TRUE)
            return (FALSE);
        $stmt = $this->_db->prepare("INSERT INTO users (`login`, `password`, email) VALUES (?, ?, ?)");
        $stmt->execute([strtolower($login), $password, $email]);
        $this->add_to_confirm($login, $password, $email);
        return (TRUE);
    }

    // Returns user data or FALSE.
    public function get_user($login) {
        $stmt = $this->_db->prepare("SELECT * FROM users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == FALSE)
            return (FALSE);
        return ($user);
    }

    // Returns user's password or FALSE if user is not found.
    public function get_user_pw($login) {
        $stmt = $this->_db->prepare("SELECT `password` FROM users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == FALSE)
            return (FALSE);
        return ($user['password']);
    }
    public function get_user_email($login) {
        $stmt = $this->_db->prepare("SELECT email FROM users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $user['email'];
        if ($user == FALSE)
            return (FALSE);
        return ($user);
    }

    public function get_user_id($login) {
        $stmt = $this->_db->prepare("SELECT id FROM users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $user['id'];
        if ($user == FALSE)
            return (FALSE);
        return ($user);
    }

    public function update_login($login, $new_login) {
        $stmt = $this->_db->prepare("UPDATE users SET `login`=? WHERE `login`=?");
        $stmt->execute([strtolower($new_login), strtolower($login)]);
        if ($stmt->rowCount() < 1)
            return (FALSE);
        return (TRUE);
    }

    public function update_email($login, $email) {
        $stmt = $this->_db->prepare("UPDATE users SET `email`=? WHERE `login`=?");
        $stmt->execute([strtolower($email), strtolower($login)]);
        if ($stmt->rowCount() < 1)
            return (FALSE);
        return (TRUE);
    }

    // Updates user password with email or login.
    public function update_password($find, $new_pw) {
        $find = strtolower($find);
        $stmt = $this->_db->prepare("UPDATE users SET `password`=? WHERE `login`=? OR email=?");
        $stmt->execute([$new_pw, $find, $find]);
        if ($stmt->rowCount() < 1)
            return (FALSE);
        return (TRUE);
    }
    
    // Returns the confirmation key of an account.
    public function get_account_key($id) {
        $stmt = $this->_db->prepare("SELECT `key` FROM confirm WHERE userid=?");
        $stmt->execute([$id]);
        $key = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($key == FALSE)
            return (FALSE);
        return($key['key']);
    }

    // Upadtes user and make its account active.
    public function set_account_active($id) {
        $stmt = $this->_db->prepare("UPDATE users SET is_active=TRUE WHERE id=?");
        $stmt->execute([$id]);
    }

    // Checks if account is active
    public function is_active($login) {
        $stmt = $this->_db->prepare("SELECT is_active FROM users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $is_active = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($is_active == FALSE)
            return (FALSE);
        $is_active = $is_active['is_active'];
        if ($is_active)
            return (TRUE);
        return (FALSE);
    }

    // Returns TRUE or FALSE whether user exists or not
    private function login_exists($login) {
        $stmt = $this->_db->prepare("SELECT * FROM users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $user = $stmt->fetch();
        if ($user == FALSE)
            return FALSE;
        return TRUE;
    }

    private function add_to_confirm($login, $password, $email) {
        $confirm_hash = hash('whirlpool', $login.$password.$email);
        $stmt = $this->_db->prepare("SELECT id from users WHERE `login`=?");
        $stmt->execute([strtolower($login)]);
        $user_id = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $user_id['id'];
        $stmt = $this->_db->prepare("INSERT INTO confirm (userid, `key`) VALUES (?, ?)");
        $stmt->execute([$user_id, $confirm_hash]);
        $subject = "Action required : Please confirm your account on Instalike";
        $txt = "Hello $login,\nYou can click on the link below to activate your account :\nlocalhost:8008/controller/confirm.php?id=$user_id&key=$confirm_hash";
        mail($email, $subject, $txt);
    }
}