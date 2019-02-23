<?php
    require_once '../Models/ApiModel.php';

    class LoginApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $username = isset($_GET['username']) ? $_GET['username'] : '';
            $password = isset($_GET['password']) ? $_GET['password'] : '';
            $login = $this->login($username, $password);
            echo $login;
        }

        public function login($username, $password)
        {
            $check = $this->model->checkUser($username, $password);
            if (!$check) {
                $check_username = $this->model->checkUsername($username);
                if (!$check_username) {
                    return 'Tên tài khoản chưa tồn tại!';
                } else {
                    return 'Sai mật khẩu!';
                }
            } else {
                return 'Đăng nhập thành công!';
            }
        }
    }
    new LoginApi();
