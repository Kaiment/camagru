<?php

abstract class Model {
    protected $_db;

    public function getDb() { return ($this->_db); }

    public function __construct() {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require("$root/config/database.php");
        $this->_db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    }
}