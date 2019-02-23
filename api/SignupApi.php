<?php
    require_once '../Models/ApiModel.php';
    class SignupApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $data['username'] = isset($_GET['username']) ? $_GET['username'] : '';
            $data['password'] = isset($_GET['password']) ? $_GET['password'] : '';
            $data['confirm_password'] = isset($_GET['confirm_password']) ? $_GET['confirm_password'] : '';
            $data['fullname'] = isset($_GET['fullname']) ? $_GET['fullname'] : '';
            $data['birth'] = isset($_GET['birth']) ? $_GET['birth'] : '';
            $data['phone'] = isset($_GET['phone']) ? $_GET['phone'] : '';
            $data['email'] = isset($_GET['email']) ? $_GET['email'] : '';
            $data['working'] = isset($_GET['working']) ? $_GET['working'] : '';

            $sign_up = $this->signup($data);
            echo $sign_up;
        }

        public function signup($data)
        {
            if (!$this->checkPassword($data['password'], $data['confirm_password'])) {
                return 'Mật khẩu không trùng nhau';
            }
            if ($this->checkUsername($data['username'])) {
                return 'Tên tài khoản đã tồn tại!';
            }
            if ($this->checkPhone($data['phone'])) {
                return 'Số điện thoại đã tồn tại. Vui lòng dùng số khác!';
            }
            if ($this->checkEmail($data['email'])) {
                return 'Email đã tồn tại. Vui lòng dùng địa chỉ khác!';
            }
            $sign_up = $this->model->signUpUser($data);
            if (!$sign_up) {
                return 'Đăng ký thất bại!';
            }
            return 'Đăng ký thành công!';
        }

        public function checkPassword($password, $confirm_password)
        {
            if ($password != $confirm_password) {
                return false;
            }
            return true;
        }

        public function checkUsername($username)
        {
            $check = $this->model->checkUsername($username);
            return $check;
        }

        public function checkEmail($email)
        {
            $check = $this->model->checkEmail($email);
            return $check;
        }

        public function checkPhone($phone)
        {
            $check = $this->model->checkPhone($phone);
            return $check;
        }
    }
    new SignupApi();
