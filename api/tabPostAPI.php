<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class TabPostAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $subject_id = isset($_GET['subjectid']) ? $_GET['subjectid'] : '';
            $data = $this->searchTabPost($subject_id);
            echo $data;
        }

        private function searchTabPost($subject_id)
        {
            $data = $this->model->searchTabPost($subject_id, 6);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new TabPostAPI();
