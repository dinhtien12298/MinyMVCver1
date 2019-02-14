<?php
    Class BannerController {
        public $model;
        public function __construct() {
            $this->model = new model();

            $breadcrumb = ['trang chủ'];
            if (isset($_GET['class'])) {
                array_push($breadcrumb, $_GET['class']);
            }
            if (isset($_GET['subject']) && $_GET['class'] != 'Mới nhất') {
                array_push($breadcrumb, $_GET['subject']);
            }
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
                if  (!in_array($post->class, $breadcrumb)) {
                    array_push($breadcrumb, $post->class);
                }
                if  (!in_array($post->subject, $breadcrumb)) {
                    array_push($breadcrumb, $post->subject);
                }
                array_push($breadcrumb, $post->title);
            }

            require_once 'views/components/banner.php';
        }
    }

    new BannerController();
