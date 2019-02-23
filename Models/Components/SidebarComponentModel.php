<?php
    require_once 'Models/Models.php';
    class SidebarComponentModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function fetchAllAdvertiments()
        {
            $data = parent::fetchAllRecords("SELECT * FROM advertiments");
            return $data;
        }

        public function searchSubjectIdOfPost($post_id)
        {
            $data = parent::fetchARecord("SELECT subject_id FROM posts WHERE id = $post_id");
            return $data;
        }

        public function findPostRelated($post_id, $subject_id)
        {
            $data = parent::fetchAllRecords("
                SELECT id, title 
                FROM posts 
                WHERE subject_id = $subject_id AND
                id != $post_id
                LIMIT 8
            ");
            return $data;
        }
    }