<?php
    class DetailController {
        public $model;
        public function __construct() {
            $this->model = new model();

            $post_id = isset($_GET['post']) ? $_GET['post'] : '';
            $post = $this->model->fetchARecord("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM users, subjects, classes, posts
                WHERE users.id = posts.user_id AND
                classes.id = subjects.class_id AND
                subjects.id = posts.subject_id AND 
                posts.id = $post_id
            ");

            $data_more_post = $this->model->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM users, subjects, classes, posts
                WHERE users.id = posts.user_id AND
                classes.id = subjects.class_id AND
                subjects.id = posts.subject_id AND
                classes.class = '$post->class' AND
                posts.id != $post_id
                LIMIT 6
            ");

            require_once 'views/detail.php';
        }
    }

    new DetailController();
