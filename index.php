<?php
    session_start();

    require_once 'config.php';
    require_once 'models/model.php';

    if (isset($_GET['class'])) {
        $controller = 'category';
    } elseif (isset($_GET['post'])) {
        $controller = 'detail';
    } else {
        $controller = 'homepage';
    }

    $file_controller = "controllers/$controller" . "Controller.php";

    if (file_exists($file_controller)) {
        require_once 'views/container.php';
    } else {
        echo 'Cannot find the file!';
    }

    mysqli_close($conn);
