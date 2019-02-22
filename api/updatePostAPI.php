<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class UpdatePostAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $title = isset($_GET['title']) ? $_GET['title'] : '';
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';
            $subject_id = $this->searchSubjectId($class, $subject);
            $update = $this->updatePost($post_id, $title, $subject_id, $content);
            echo $update;
        }

        private function searchSubjectId($class, $subject) {
            $subject_id = $this->model->searchSubjectId($class, $subject)->id;
            return $subject_id;
        }

        private function updatePost($post_id, $title, $subject_id, $content) {
            $update = $this->model->updatePost($post_id, $title, $subject_id, $content);
            if (!$update) {
                return 'Cập nhật bài viết không thành công!';
            }
            return 'Cập nhật bài viết thành công!';
        }
    }
    new UpdatePostAPI();
