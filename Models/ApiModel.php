<?php
    require_once 'Models.php';
    class ApiModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        // SearchPost
        public function searchPostKeyword($keyword)
        {
            $data = parent::fetchAllRecords("SELECT * FROM posts WHERE title like '%$keyword%'");
            return $data;
        }

        // SearchTabPost
        public function searchTabPost($subject_id, $limit)
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                INNER JOIN Users ON posts.user_id = Users.id
                WHERE subjects.id = $subject_id
                LIMIT $limit
            ");
            return $data;
        }

        // SearchSubjectAPI
        public function searchClassIdByClass($class)
        {
            $data = parent::fetchARecord("SELECT * FROM classes WHERE class = '$class'");
            return $data;
        }

        // DeletePostAPI
        public function deletePost($post_id)
        {
            $delete = parent::execute("DELETE FROM posts WHERE id = $post_id");
            return $delete;
        }

        // CreatePostAPI
        public function createPost($title, $user_id, $subject_id, $content)
        {
            $create = parent::execute("
                INSERT INTO posts(title, user_id, subject_id, content)
                VALUES ('$title', $user_id, $subject_id, '$content')
            ");
            return $create;
        }

        // updatePostAPI
        public function updatePost($post_id, $title, $subject_id, $content)
        {
            $update = parent::execute("
                UPDATE posts SET title = '$title', subject_id = $subject_id, content = '$content'
                WHERE id = $post_id
            ");
            return $update;
        }

        // updateInfoAPI
        public function updateInfo($username, $password, $phone, $email, $working)
        {
            $update = parent::execute("
                UPDATE Users SET password = '$password', phone = $phone, email = '$email', working = '$working'
                WHERE username = '$username'
            ");
            return $update;
        }

        public function searchSubjectId($class, $subject)
        {
            $data = $this->fetchARecord("
                SELECT subjects.id, subjects.subject, classes.class
                FROM subjects
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE subjects.subject = '$subject' AND 
                classes.class = '$class'
            ");
            return $data;
        }

        public function checkUser($username, $password)
        {
            $check = parent::checkExistRecord("
                SELECT * FROM Users WHERE username = '$username' AND password = '$password'
            ");
            return $check;
        }

        public function checkUsername($username)
        {
            $check = parent::checkExistRecord("
                SELECT * FROM Users WHERE username = '$username'
            ");
            return $check;
        }

        public function searchSubjectsOfClass($class_id)
        {
            $data = parent::fetchAllRecords("SELECT * FROM subjects WHERE class_id=$class_id");
            return $data;
        }

        public function checkEmail($email)
        {
            $check = parent::checkExistRecord("
                SELECT * FROM Users WHERE email = '$email'
            ");
            return $check;
        }

        public function checkPhone($phone)
        {
            $check = parent::checkExistRecord("
                SELECT * FROM Users WHERE phone = '$phone'
            ");
            return $check;
        }


        public function signUpUser($data)
        {
            $username = $data['username'];
            $password = $data['password'];
            $fullname = $data['fullname'];
            $birth = $data['birth'];
            $phone = $data['phone'];
            $email = $data['email'];
            $working = $data['working'];
            $sign_up = parent::execute("
                INSERT INTO users(username, password, fullname, birth, phone, email, working)
                VALUES ('$username', '$password', '$fullname', '$birth', $phone, '$email', '$working')
            ");
            return $sign_up;
        }
    }