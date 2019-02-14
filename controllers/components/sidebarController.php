<?php
    class SidebarController {
        public $model;
        public function __construct() {
            $this->model = new model();
            $all_ads = $this->model->fetchAllRecords("
                SELECT * FROM advertiments
            ");
            require_once 'views/components/sidebar.php';
        }
    }

    new SidebarController();
