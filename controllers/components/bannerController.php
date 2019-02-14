<?php
    Class BannerController {
        public $model;
        public function __construct() {
            $this->model = new model();
            require_once 'views/components/banner.php';
        }
    }

    new BannerController();
