<?php
    class LogOutController {
        public function __construct()
        {
            if (isset($_GET['logout'])) {
                session_destroy();
                header('location: index.php');
            }
        }
    }
    new LogOutController();
