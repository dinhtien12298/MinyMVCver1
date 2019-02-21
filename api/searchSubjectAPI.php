<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class SearchSubjectAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $data = $this->searchSubjects($class);
            echo $data;
        }

        private function searchSubjects($class) {
            $class_id = $this->model->searchClassIdByClass($class)->id;
            $data = $this->model->searchSubjectsOfClass($class_id);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new SearchSubjectAPI();
