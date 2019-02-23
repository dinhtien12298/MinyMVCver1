<?php
    class Controller
    {
        public $index;
        public function __construct()
        {
            $this->index = new Index();
            $controller = $this->index->controller;
            $file_controller = "Controllers/MainPage/$controller" . "Controller.php";
            if (file_exists($file_controller)) {
                require_once $file_controller;
            } else {
                echo 'Cannot find the Controller file!';
            }
        }

        public function login()
        {
            if (isset($_GET['loginAction'])) {
                $_SESSION['username'] = isset($_GET['username']) ? $_GET['username'] : '';
                echo '
                    <script>window.location.href = "/minyMVC/index.php?user"</script>
                ';
            }
        }

        public function logOut()
        {
            if (isset($_GET['logout'])) {
                session_destroy();
                header('location: index.php');
            }
        }
    }
    new Controller();
