<?php

class Controller {
    public $model;
    public $view;
    protected $pageData = array();

    public function __constructor() {
        $this->view = new View();
        $this->model = new Model();
    }
}