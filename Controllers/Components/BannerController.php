<?php
    require_once 'Models/Components/BannerComponentModel.php';
    class BannerController
    {
        public $model;
        public $class;
        public $post_id;
        public $post;
        public $banner_title;
        public $breadcrumb;
        public function __construct()
        {
            $this->model = new BannerComponentModel();
            $this->class = isset($_GET['class']) ? $_GET['class'] : '';
            $this->post_id = isset($_GET['post']) ? $_GET['post'] : '';
            $this->post = isset($_GET['post']) ? $this->model->postInfoForBanner($this->post_id) : '';
            $subject = isset($_GET['post']) ? $this->post->subject : '';
            $title = isset($_GET['post']) ? $this->post->title : '';
            $this->banner_title = isset($_GET['post']) ? "$subject - $title" : "$this->class - GIẢI BÀI TẬP $this->class";
            $this->breadcrumb = $this->breadcrumb($this->post);
        }

        public function breadcrumb($post)
        {
            $breadcrumb = ['trang chủ'];
            if (isset($_GET['class'])) {
                array_push($breadcrumb, $_GET['class']);
            }
            if (isset($_GET['subject']) && $_GET['class'] != 'Mới nhất') {
                array_push($breadcrumb, $_GET['subject']);
            }
            if (isset($_GET['post'])) {
                if  (!in_array($post->class, $breadcrumb)) {
                    array_push($breadcrumb, $post->class);
                }
                if  (!in_array($post->subject, $breadcrumb)) {
                    array_push($breadcrumb, $post->subject);
                }
                array_push($breadcrumb, $post->title);
            }
            return $breadcrumb;
        }
    }
    new BannerController();
