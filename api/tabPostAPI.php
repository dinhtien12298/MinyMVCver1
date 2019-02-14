<?php
    require_once '../config.php';
    require_once '../models/model.php';

    class TabPostAPI {
        public $model;
        public function __construct() {
            $this->model = new model();

            $subject_id = isset($_GET['subjectid']) ? $_GET['subjectid'] : '';
            $data = $this->model->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM users, subjects, classes, posts
                WHERE users.id = posts.user_id AND
                classes.id = subjects.class_id AND
                subjects.id = posts.subject_id AND 
                subjects.id = $subject_id
                LIMIT 6
            ");

            if ($data) {
                echo json_encode($data);
            }
        }
    }

    new TabPostAPI();
