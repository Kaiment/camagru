<?php

abstract class Controller {
    protected $_model;
    protected $_table;
    protected $_root;

    public function __construct() {
        $this->_root = realpath($_SERVER["DOCUMENT_ROOT"]);
    }

    public function create_token() {
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        return $token;
    }

    public function getModel() { return ($_model); }
    public function getTable() { return ($_table); }
}