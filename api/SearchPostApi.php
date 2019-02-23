<?php
    require_once '../Models/ApiModel.php';
    class SearchPostApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $data = $this->searchPosts($keyword);
            echo $data;
        }

        public function searchPosts($keyword)
        {
            $data = $this->model->searchPostKeyword("$keyword");
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new SearchPostApi();
