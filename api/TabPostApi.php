<?php
    require_once '../Models/ApiModel.php';
    class TabPostApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $subject_id = isset($_GET['subjectid']) ? $_GET['subjectid'] : '';
            $data = $this->searchTabPost($subject_id);
            echo $data;
        }

        public function searchTabPost($subject_id)
        {
            $data = $this->model->searchTabPost($subject_id, 6);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new TabPostApi();
