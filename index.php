<?php
    session_start();
    class Index
    {
        public $controller;
        public function __construct()
        {
            if (isset($_GET['class'])) {
                $this->controller = 'Category';
            } elseif (isset($_GET['post'])) {
                $this->controller = 'Detail';
            } elseif (isset($_GET['user']) && isset($_SESSION['username'])) {
                $this->controller = 'UserMainHome';
            } else {
                $this->controller = 'Homepage';
            }
            require_once 'Controllers/Controller.php';
        }
    }
    new Index();