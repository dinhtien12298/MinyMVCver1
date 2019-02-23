<?php
    require_once 'Models/Main/CategoryModel.php';
    require_once 'Controllers/Components/MenuController.php';
    require_once 'Controllers/Components/BannerController.php';
    require_once 'Controllers/Components/FooterController.php';
    require_once 'Controllers/Components/SidebarController.php';
    class CategoryController extends Controller
    {
        public $model;
        public $menu;
        public $banner;
        public $footer;
        public $sidebar;
        public function __construct()
        {
            $this->model = new CategoryModel();
            $this->menu = new MenuController();
            $this->banner = new BannerController();
            $this->footer = new FooterController();
            $this->sidebar = new SidebarController();
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
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
            if (isset($_GET['subject']) || $class == 'Mới nhất') {
                $page = ($_GET['page']);
                $tab_title = ($class == 'Mới nhất') ? $class : $subject;
                $data = $this->dataContentDetail($page, $class, $subject);
                $data_content = $data[0];
                $page_button = $data[1];
                $continue = $data[2];
                $main_content_path = 'Views/MainPage/CategoryDetail.php';
            } else {
                $data_content = $this->dataContentBasic($class);
                $main_content_path = 'Views/MainPage/CategoryBasic.php';
            }
            $controller = 'Category';
            require_once 'Views/View.php';
        }

        public function dataContentBasic($class)
        {
            $class_id = $this->model->searchClassIdByClass($class)->id;
            $all_subjects = $this->model->searchSubjectsOfClass($class_id);
            $data_content = [];
            foreach ($all_subjects as $subject) {
                $index = array_search($subject, $all_subjects);
                $data_content[$index] = $this->model->searchTabPost($subject->id, 3);
            }
            return $data_content;
        }

        public function dataContentDetail($page, $class, $subject)
        {
            $start_number = 9 * ($page - 1);
            if  ($class == 'Mới nhất') {
                $subject_id = 0;
                $data_content = $this->model->fetchLastedPostForPage($start_number);
            } else {
                $subject_id = $this->model->searchSubjectId($class, $subject)->id;
                $data_content = $this->model->fetchPostsForPage($start_number, $subject_id);
            }
            $number_of_records = $this->model->countPosts($start_number, $subject_id);
            $page_button = $this->calculatePageNumber($page, $number_of_records)[0];
            $continue = $this->calculatePageNumber($page, $number_of_records)[1];
            return [$data_content, $page_button, $continue];
        }

        public function calculatePageNumber($page, $number_of_records)
        {
            $continue = false;
            if ($number_of_records <= 9) {
                $page_number = $page;
            } elseif ($number_of_records <= 18) {
                $page_number = $page + 1;
            } else {
                $page_number = $page + 2;
            }
            if ($number_of_records > 27) {
                $continue = true;
            }
            return [$page_number, $continue];
        }
    }
    new CategoryController();
