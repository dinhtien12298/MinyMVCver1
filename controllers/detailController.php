<?php
    class DetailController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $post_id = isset($_GET['post']) ? $_GET['post'] : '';
            $post = $this->model->fetchPostDetail($post_id);
            $data_more_post = $this->model->fetchPostsForDataMorePost($post_id, $post->class);
            require_once 'views/detail.php';
        }
    }
    new DetailController();
