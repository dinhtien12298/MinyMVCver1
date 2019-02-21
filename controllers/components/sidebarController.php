<?php
    class SidebarController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $all_ads = $this->model->fetchAllAdvertiments();
            if (isset($_GET['post'])) {
                $post_id = $_GET['post'];
                $subject_id = $this->model->searchSubjectIdOfPost($post_id)->subject_id;
                $data_related = $this->model->findPostRelated($post_id, $subject_id);
            }
            require_once 'views/components/sidebar.php';
        }
    }
    new SidebarController();
