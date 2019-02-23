<?php
    require_once '../Models/ApiModel.php';
    class UpdateInfoApi
    {
        public $model;
        public function __construct()
        {
            $this->model = new ApiModel();
            $username = isset($_GET['username']) ? $_GET['username'] : '';
            $password = isset($_GET['password']) ? $_GET['password'] : '';
            $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
            $email = isset($_GET['email']) ? $_GET['email'] : '';
            $working = isset($_GET['working']) ? $_GET['working'] : '';
            $update = $this->update($username, $password, $phone, $email, $working);
            echo $update;
        }

        public function update($username, $password, $phone, $email, $working)
        {
            $update = $this->model->updateInfo($username, $password, $phone, $email, $working);
            if (!$update) {
                return 'Cập nhật thông tin thất bại!';
            }
            return 'Cập nhật thông tin thành công!';
        }
    }
    new UpdateInfoApi();
