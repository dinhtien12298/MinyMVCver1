<?php
    class SidebarController {
        public $model;
        public function __construct() {
            $this->model = new model();

            $all_ads = $this->model->fetchAllRecords("
                SELECT * FROM advertiments
            ");

            if (isset($_GET['post'])) {
                $post_id = $_GET['post'];
                $post = $this->model->fetchARecord("
                    SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                    FROM users, subjects, classes, posts
                    WHERE users.id = posts.user_id AND
                    classes.id = subjects.class_id AND
                    subjects.id = posts.subject_id AND 
                    posts.id = $post_id
                ");

                $data_related = $this->model->fetchAllRecords("
                    SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                    FROM users, subjects, classes, posts
                    WHERE users.id = posts.user_id AND
                    classes.id = subjects.class_id AND
                    subjects.id = posts.subject_id AND 
                    classes.class = '$post->class' AND 
                    subjects.subject = '$post->subject' AND 
                    posts.id != $post_id
                    LIMIT 8
                ");
            }

            require_once 'views/components/sidebar.php';
        }
    }

    new SidebarController();
