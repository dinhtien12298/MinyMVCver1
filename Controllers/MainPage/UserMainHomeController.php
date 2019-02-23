<?php
    require_once 'Models/Main/UserMainHomeModel.php';
    require_once 'Controllers/Components/MenuController.php';
    require_once 'Controllers/Components/FooterController.php';
    class UserMainHomeController extends Controller
    {
        public $model;
        public $menu;
        public $footer;
        public function __construct()
        {
            $this->model = new UserMainHomeModel();
            $this->menu = new MenuController();
            $this->footer = new FooterController();
            // login/logout
            parent::login();
            parent::logOut();
            // dataMenu
            $all_classes = $this->menu->all_classes;
            $data_menu = $this->menu->data_menu;
            $class_images = $this->menu->class_images;
            // dataFooter
            $data_footer = $this->footer->data_footer;
            // updatePost
            if (isset($_GET['update'])) {
                $post_id = $_GET['update'];
                $post_detail = $this->model->fetchPostDetail($post_id);
                $all_classes = $this->model->fetchAllClasses();
            }
            // Main
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            $user = $this->model->foundUser($username);
            $all_posts = $this->model->fetchPostsByUser($user->id);
            $list_info = $this->getUserInfo($user, $all_posts);
            $main_content_path = 'Views/MainPage/UserMainHome.php';
            $controller = 'UserMainHome';
            require_once 'Views/View.php';
        }

        public function findTotalPostInfo($all_posts)
        {
            $view_number = 0;
            $like_number = 0;
            foreach ($all_posts as $post) {
                $view_number += $post->view_num;
                $like_number += $post->like_num;
            }
            return [$view_number, $like_number];
        }

        public function getUserInfo($user, $all_posts)
        {
            $list_info = [];
            $list_info['Tên tài khoản'] = $user->username;
            $list_info['Mật khẩu'] = '**********';
            $list_info['Tên đầy đủ'] = $user->fullname;
            $list_info['Tổng số bài viết'] = sizeof($all_posts);
            $list_info['Tổng lượt xem'] = $this->findTotalPostInfo($all_posts)[0];
            $list_info['Tổng lượt thích'] = $this->findTotalPostInfo($all_posts)[1];
            $list_info['Số điện thoại'] = $user->phone;
            $list_info['Email'] = $user->email;
            $list_info['Ngày sinh'] = $user->birth;
            $list_info['Cơ quan/Trường học'] = $user->working;
            return $list_info;
        }
    }
    new UserMainHomeController();
