<?php
    require_once 'Models/Models.php';
    class BannerComponentModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function postInfoForBanner($post_id)
        {
            $data = parent::fetchARecord("
                SELECT title, classes.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.id = $post_id
            ");
            return $data;
        }
    }

