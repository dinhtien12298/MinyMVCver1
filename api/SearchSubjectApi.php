<?php
    require_once '../Models/ApiModel.php';
    class SearchSubjectApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $data = $this->searchSubjects($class);
            echo $data;
        }

        public function searchSubjects($class)
        {
            $class_id = $this->model->searchClassIdByClass($class)->id;
            $data = $this->model->searchSubjectsOfClass($class_id);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new SearchSubjectApi();
