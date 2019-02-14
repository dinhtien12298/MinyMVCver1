<?php
    class MenuController {
        public $model;

        public function __construct() {
            $this->model = new model();
            $all_classes = $this->model->fetchAllRecords("SELECT * FROM classes");
            require_once 'views/components/menu.php';
        }
    }

    new MenuController();
