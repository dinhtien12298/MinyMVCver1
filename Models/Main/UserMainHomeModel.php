<?php
    require_once 'Models/Models.php';
    class UserMainHomeModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function fetchAllClasses()
        {
            $data = parent::fetchAllRecords("SELECT * FROM classes");
            return $data;
        }

        public function fetchPostDetail($post_id)
        {
            $data = parent::fetchARecord("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN Users ON posts.user_id = Users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.id = $post_id
            ");
            return $data;
        }

        public function foundUser($username)
        {
            $data = parent::fetchARecord("SELECT * FROM Users WHERE username = '$username'");
            return $data;
        }

        public function fetchPostsByUser($user_id)
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, classes.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.user_id = $user_id
            ");
            return $data;
        }
    }