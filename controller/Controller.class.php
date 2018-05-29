<?php

abstract class Controller {
    private $model;
    private $table;

    public function getModel() { return ($model); }
    public function getTable() { return ($table); }
}