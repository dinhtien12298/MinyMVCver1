<?php
    class MainHomeController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            $user = $this->model->foundUser($username);
            $all_posts = $this->model->fetchPostsByUser($user->id);
            $all_classes = $this->model->fetchAllClasses();
            $list_info = $this->getUserInfo($user, $all_posts);
            require_once 'views/users/mainHome.php';
        }

        private function findTotalPostInfo($all_posts)
        {
            $view_number = 0;
            $like_number = 0;
            foreach ($all_posts as $post) {
                $view_number += $post->view_num;
                $like_number += $post->like_num;
            }
            return [$view_number, $like_number];
        }

        private function getUserInfo($user, $all_posts)
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
    new MainHomeController();
