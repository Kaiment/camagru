<?php

require_once('Model.class.php');

class Model_users extends Model {
    // Adds user with encrypted password
    public function add_user($login, $password, $table) {
        $insert_user = "INSERT INTO $table (`login`, `password`, is_admin)
        VALUES ($login, $password, FALSE);";
        $this->db->exec($insert_user);
    }

    // Returns an array ['login' => ..., 'password' => ...] or FALSE
    public function get_user($login, $table) {
        $get_user = "SELECT $login FROM $table";
        $res = $this->db->exec($get_user);
        if ($res->num_rows <= 0)
            return (FALSE);
        $user = $res->fetch();
        return ($user['password']);
    }
}