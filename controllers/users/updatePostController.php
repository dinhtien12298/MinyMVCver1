<?php
    class UpdatePostController {
        public $model;
        public function __construct() {
            $this->model = new model();
            $post_id = isset($_GET['update']) ? $_GET['update'] : '';
            $post = $this->model->fetchPostDetail($post_id);
            $all_classes = $this->model->fetchAllClasses();
            if (!$post) {
                echo 'Post not found';
            }
            require_once 'views/users/updatePost.php';
        }
    }
    new UpdatePostController();
