<?php
    require_once 'Models/Models.php';
    class CategoryModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function searchClassIdByClass($class)
        {
            $data = parent::fetchARecord("SELECT * FROM classes WHERE class = '$class'");
            return $data;
        }

        public function searchSubjectsOfClass($class_id)
        {
            $data = parent::fetchAllRecords("SELECT * FROM subjects WHERE class_id=$class_id");
            return $data;
        }

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

        public function fetchLastedPostForPage($start_number)
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN Users ON posts.user_id = Users.id
                LIMIT $start_number, 9
            ");
            return $data;
        }

        public function fetchPostsForPage($start_number, $subject_id)
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN Users ON posts.user_id = Users.id
                WHERE subject_id = $subject_id
                LIMIT $start_number, 9
            ");
            return $data;
        }

        public function searchSubjectId($class, $subject)
        {
            $data = parent::fetchARecord("
                SELECT subjects.id, subjects.subject, classes.class
                FROM subjects
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE subjects.subject = '$subject' AND 
                classes.class = '$class'
            ");
            return $data;
        }

        public function countPosts($start_number, $subject_id)
        {
            if ($subject_id == 0) {
                $query = "SELECT * FROM posts LIMIT $start_number, 28";
            } else {
                $query = "SELECT * FROM posts WHERE subject_id = $subject_id LIMIT $start_number, 28";
            }
            return parent::countRecords($query);
        }
    }