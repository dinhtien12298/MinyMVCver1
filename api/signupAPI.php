<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class SignupAPI {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $username = isset($_GET['username']) ? $_GET['username'] : '';
            $password = isset($_GET['password']) ? $_GET['password'] : '';
            $confirm_password = isset($_GET['confirm_password']) ? $_GET['confirm_password'] : '';
            $fullname = isset($_GET['fullname']) ? $_GET['fullname'] : '';
            $birth = isset($_GET['birth']) ? $_GET['birth'] : '';
            $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
            $email = isset($_GET['email']) ? $_GET['email'] : '';
            $working = isset($_GET['working']) ? $_GET['working'] : '';
            $sign_up = $this->signup(
                $username, $password, $confirm_password, $fullname, $birth, $phone, $email, $working
            );
            echo $sign_up;
        }

        private function signup($username, $password, $confirm_password, $fullname, $birth, $phone, $email, $working)
        {
            if (!$this->checkPassword($password, $confirm_password)) {
                return 'Mật khẩu không trùng nhau';
            }
            if ($this->checkUsername($username)) {
                return 'Tên tài khoản đã tồn tại!';
            }
            if ($this->checkPhone($phone)) {
                return 'Số điện thoại đã tồn tại. Vui lòng dùng số khác!';
            }
            if ($this->checkEmail($email)) {
                return 'Email đã tồn tại. Vui lòng dùng địa chỉ khác!';
            }
            $sign_up = $this->model->signUpUser($username, $password, $fullname, $birth, $phone, $email, $working);
            if (!$sign_up) {
                return 'Đăng ký thất bại!';
            }
            return 'Đăng ký thành công!';
        }

        private function checkPassword($password, $confirm_password)
        {
            if ($password != $confirm_password) {
                return false;
            }
            return true;
        }

        private function checkUsername($username)
        {
            $check = $this->model->checkUsername($username);
            return $check;
        }

        private function checkEmail($email)
        {
            $check = $this->model->checkEmail($email);
            return $check;
        }

        private function checkPhone($phone)
        {
            $check = $this->model->checkPhone($phone);
            return $check;
        }
    }
    new SignupAPI();
