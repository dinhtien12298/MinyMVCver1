<?php
    require_once '../Models/ApiModel.php';

    class CreatePostApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $title = isset($_GET['title']) ? $_GET['title'] : '';
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
            $subject_id = $this->searchSubjectId($class, $subject);
            $create = $this->createPost($title, $user_id, $subject_id, $content);
            echo $create;
        }

        public function searchSubjectId($class, $subject)
        {
            $subject_id = $this->model->searchSubjectId($class, $subject)->id;
            return $subject_id;
        }

        public function createPost($title, $user_id, $subject_id, $content)
        {
            $create = $this->model->createPost($title, $user_id, $subject_id, $content);
            if (!$create) {
                return "Đăng bài viết không thành công!";
            }
            return "Đăng bài viết thành công!";
        }
    }
    new CreatePostApi();
