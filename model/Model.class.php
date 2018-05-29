<?php

abstract class Model {
    protected $db;

    public function getDb() { return ($this->db); }

    public function __construct() {
        require_once("../config/database.php");
        $this->db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    }
}