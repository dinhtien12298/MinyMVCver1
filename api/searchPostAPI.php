<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class SearchPostAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $data = $this->searchPosts($keyword);
            echo $data;
        }

        private function searchPosts($keyword)
        {
            $data = $this->model->searchPostKeyword("$keyword");
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new SearchPostAPI();
