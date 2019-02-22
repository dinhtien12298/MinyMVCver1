<?php
    class UpdateInfoController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            $user = $this->model->foundUser($username);
            require_once 'views/users/updateInfo.php';
        }
    }
    new UpdateInfoController();
