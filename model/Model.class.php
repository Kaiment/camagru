<?php

abstract class Model {
    protected $_db;
    protected $_table;

    public function getDb() { return ($this->_db); }

    public function __construct($table) {
        require_once("../config/database.php");
        $this->_table = $table;
        $this->_db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    }
}