<?php
    require_once 'Models/Models.php';
    class DetailModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
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

        public function fetchPostsForDataMorePost($post_id, $class)
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN Users ON posts.user_id = Users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE classes.class = '$class' AND
                posts.id != $post_id
                LIMIT 6
            ");
            return $data;
        }
    }