<?php
    class LoginController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            if (isset($_GET['loginAction'])) {
                $_SESSION['username'] = isset($_GET['username']) ? $_GET['username'] : '';
                echo '
                    <script>window.location.href = "/minyMVC/index.php?user"</script>
                ';
            }
            require_once 'views/users/login.php';
        }
    }
    new LoginController();
