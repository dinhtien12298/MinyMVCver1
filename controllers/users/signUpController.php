<?php
    class SignUpController {
        public $model;
        public function __construct() {
            $this->model = new model();
            require_once 'views/users/signUp.php';
        }
    }
    new SignUpController();
