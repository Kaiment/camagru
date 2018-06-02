<?php

abstract class Controller {
    protected $_model;
    protected $_table;

    public function getModel() { return ($_model); }
    public function getTable() { return ($_table); }
}