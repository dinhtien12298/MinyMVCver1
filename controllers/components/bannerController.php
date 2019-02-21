<?php
    class BannerController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $post_id = isset($_GET['post']) ? $_GET['post'] : '';
            $post = isset($_GET['post']) ? $this->model->postInfoForBanner($post_id) : '';
            $banner_title = isset($_GET['post']) ? "$post->subject - $post->title" : "$class - GIẢI BÀI TẬP $class";
            $breadcrumb = $this->breadcrumb($post);
            require_once 'views/components/banner.php';
        }

        private function breadcrumb($post) {
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
