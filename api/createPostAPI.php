<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class CreatePostAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $title = isset($_GET['title']) ? $_GET['title'] : '';
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
            $subject_id = $this->searchSubjectId($class, $subject);
            $create = $this->createPost($title, $user_id, $subject_id, $content);
            echo $create;
        }

        private function searchSubjectId($class, $subject) {
            $subject_id = $this->model->searchSubjectId($class, $subject)->id;
            return $subject_id;
        }

        private function createPost($title, $user_id, $subject_id, $content) {
            $create = $this->model->createPost($title, $user_id, $subject_id, $content);
            if (!$create) {
                return "Đăng bài viết không thành công!";
            }
            return "Đăng bài viết thành công!";
        }
    }
    new CreatePostAPI();
