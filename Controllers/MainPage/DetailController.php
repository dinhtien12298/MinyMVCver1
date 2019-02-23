<?php
    require_once 'Models/Main/DetailModel.php';
    require_once 'Controllers/Components/MenuController.php';
    require_once 'Controllers/Components/BannerController.php';
    require_once 'Controllers/Components/FooterController.php';
    require_once 'Controllers/Components/SidebarController.php';
    class DetailController extends Controller
    {
        public $model;
        public $menu;
        public $banner;
        public $footer;
        public $sidebar;
        public function __construct()
        {
            $this->model = new DetailModel();
            $this->menu = new MenuController();
            $this->banner = new BannerController();
            $this->footer = new FooterController();
            $this->sidebar = new SidebarController();
            $post_id = isset($_GET['post']) ? $_GET['post'] : '';
            // login/logout
            parent::login();
            parent::logOut();
            // dataMenu
            $all_classes = $this->menu->all_classes;
            $data_menu = $this->menu->data_menu;
            $class_images = $this->menu->class_images;
            // dataBanner
            $class = $this->banner->class;
            $post_id = $this->banner->post_id;
            $post = $this->banner->post;
            $banner_title = $this->banner->banner_title;
            $breadcrumb = $this->banner->breadcrumb;
            // dataFooter
            $data_footer = $this->footer->data_footer;
            // dataSideBar
            $all_ads = $this->sidebar->all_ads;
            if (isset($_GET['post'])) {
                $data_related = $this->sidebar->data_related;
            }
            // Main
            $post = $this->model->fetchPostDetail($post_id);
            $data_more_post = $this->model->fetchPostsForDataMorePost($post_id, $post->class);
            $controller = 'Detail';
            $main_content_path = 'Views/MainPage/Detail.php';
            require_once 'Views/View.php';
        }
    }
    new DetailController();
