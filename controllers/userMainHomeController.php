<?php
    class UserMainHomeController {
        public $model;
        public function __construct()
        {
            $this->model = new model;
            require_once 'views/userMainHome.php';
        }
    }
    new UserMainHomeController();
