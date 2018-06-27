<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/model/Model.class.php");

class Model_users extends Model {
    // Adds user with encrypted password
    public function add_user($login, $password, $email) {
        if ($this->login_exists($login) === TRUE)
            return (FALSE);
        if ($this->email_exists($email) === TRUE)
            return (FALSE);
        $stmt = $this->_db->prepare("INSERT INTO users (`login`, `password`, email) VALUES (?, ?, ?)");
        $stmt->execute([strtolower($login), $password, strtolower($email)]);
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

    public function get_user_by_id($id) {
        $stmt = $this->_db->prepare("SELECT `login` FROM users WHERE id=?");
        $stmt->execute([$id]);
        $login = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$login)
            return (FALSE);
        return ($login['login']);
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
        if ($this->email_exists($email))
            return FALSE;
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

    // Updates user and make its account active.
    public function set_account_active($id) {
        $stmt = $this->_db->prepare("UPDATE users SET is_active=TRUE WHERE id=?");
        $stmt->execute([$id]);
        $stmt = $this->_db->prepare("DELETE FROM confirm WHERE id=?");
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

    public function notif_enabled($pic_id) {
        $user_id = $this->get_user_id_from_pic($pic_id);
        if ($user_id === FALSE)
            return FALSE;
        $stmt = $this->_db->prepare("SELECT notif FROM users WHERE id=?");
        $stmt->execute([$user_id]);
        $notif = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($notif == FALSE)
            return FALSE;
        return ($notif['notif']);
    }

    private function get_user_id_from_pic($pic_id) {
        $stmt = $this->_db->prepare("SELECT userid FROM pics WHERE id=?");
        $stmt->execute([$pic_id]);
        $userid = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$userid)
            return (FALSE);
        return ($userid['userid']);
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

    public function email_exists($email) {
        $stmt = $this->_db->prepare("SELECT email FROM users WHERE email=?");
        $stmt->execute([strtolower($email)]);
        $email = $stmt->fetch();
        if ($email)
            return TRUE;
        return FALSE;
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
        $txt = "<html><body>";
        $txt .= "<p>Hello $login,</p>";
        $txt .= "<p>You can click on the link below to activate your account :</p>";
        $txt .= "<a href=\""."http://localhost:8008/controller/confirm.php?id=".$user_id."&key=".$confirm_hash."\">Confirm account.</a>";
        $txt .= "</body></html>";
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= "From: kai.bedene@gmail.com" . "\r\n";
        mail($email, $subject, $txt, $header);
    }
}