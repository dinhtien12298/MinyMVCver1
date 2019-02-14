<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class SearchPostAPI {
        public $model;
        public function __construct() {
            $this->model = new model();

            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $data = $this->model->fetchAllRecords("SELECT * FROM posts WHERE title like '%$keyword%'");
            if ($data) {
                echo json_encode($data);
            }
        }
    }

    new SearchPostAPI();
