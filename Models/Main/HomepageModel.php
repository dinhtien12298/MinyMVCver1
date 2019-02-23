<?php
    require_once 'Models/Models.php';
    class HomepageModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function fetchSubjectButton($class)
        {
            $data = parent::fetchAllRecords("
                SELECT subjects.id, subject, classes.class
                    FROM subjects, classes
                    WHERE subjects.class_id = classes.id AND 
                    classes.class = '$class' 
                    LIMIT 4
            ");
            return $data;
        }

        public function fetchRelatedPosts()
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN Users ON posts.user_id = Users.id
                LIMIT 6
            ");
            return $data;
        }

        public function fetchPostsByClassesAndSubjects($class, $subject)
        {
            $data = parent::fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN Users ON posts.user_id = Users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE classes.class = '$class' AND 
                subjects.subject = '$subject'
                LIMIT 6
            ");
            return $data;
        }
    }