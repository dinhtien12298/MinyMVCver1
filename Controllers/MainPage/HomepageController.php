<?php
    require_once 'Models/Main/HomepageModel.php';
    require_once 'Controllers/Components/MenuController.php';
    require_once 'Controllers/Components/BannerController.php';
    require_once 'Controllers/Components/FooterController.php';
    class HomepageController extends Controller
    {
        public $model;
        public $menu;
        public $banner;
        public $footer;
        public function __construct()
        {
            $this->model = new HomepageModel();
            $this->menu = new MenuController();
            $this->banner = new BannerController();
            $this->footer = new FooterController();
            $list_classes = [
                'Mới nhất',
                'lớp 9',
                'lớp 8'
            ];
            $data = $this->dataContent($list_classes);
            $data_content = $data[0];
            $list_buttons = $data[1];
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
            // Main
            $controller = 'Homepage';
            $main_content_path = 'Views/MainPage/Homepage.php';
            require_once 'Views/View.php';
        }

        public function dataContent($list_classes)
        {
            $data_content = [];
            $list_buttons = [];
            foreach ($list_classes as $class_name) {
                $index = array_search($class_name, $list_classes);
                $data_content[$index] = [];
                $list_buttons[$index] = $this->model->fetchSubjectButton($class_name);
                if ($class_name == "Mới nhất") {
                    $data_content[$index] = $this->model->fetchRelatedPosts();
                } else {
                    $subject = $list_buttons[$index][0]->subject;
                    $data_content[$index] = $this->model->fetchPostsByClassesAndSubjects($class_name, $subject);
                }
            }
            return [$data_content, $list_buttons];
        }
    }
    new HomepageController();
