<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class DeletePostAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';
            $delete_status = $this->deletePost($post_id);
            echo $delete_status;
        }

        private function deletePost($post_id) {
            $delete = $this->model->deletePost($post_id);
            if (!$delete) {
                return "Xóa bài viết không thành công!";
            }
            return "Xóa bài viết thành công!";
        }
    }
    new DeletePostAPI();
