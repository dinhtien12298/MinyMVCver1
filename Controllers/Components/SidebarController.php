<?php
    require_once 'Models/Components/SidebarComponentModel.php';
    class SidebarController
    {
        public $model;
        public $all_ads;
        public $data_related;
        public function __construct()
        {
            $this->model = new SidebarComponentModel();
            $this->all_ads = $this->model->fetchAllAdvertiments();
            if (isset($_GET['post'])) {
                $post_id = $_GET['post'];
                $subject_id = $this->model->searchSubjectIdOfPost($post_id)->subject_id;
                $this->data_related = $this->model->findPostRelated($post_id, $subject_id);
            }
        }
    }
    new SidebarController();
