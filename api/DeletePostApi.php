<?php
    require_once '../Models/ApiModel.php';

    class DeletePostApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';
            $delete_status = $this->deletePost($post_id);
            echo $delete_status;
        }

        public function deletePost($post_id)
        {
            $delete = $this->model->deletePost($post_id);
            if (!$delete) {
                return "Xóa bài viết không thành công!";
            }
            return "Xóa bài viết thành công!";
        }
    }
    new DeletePostApi();
