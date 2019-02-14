<?php
    class HomepageController {
        public $model;
        public function __construct() {
            $this->model = new model();

            $all_posts = $this->model->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM users, subjects, classes, posts
                WHERE users.id = posts.user_id AND
                classes.id = subjects.class_id AND
                subjects.id = posts.subject_id
            ");
            $list_classes = [
                'Mới nhất',
                'lớp 9',
                'lớp 8'
            ];
            $data_content = [];
            $list_buttons = [];
            foreach ($list_classes as $class_name) {
                $index = array_search($class_name, $list_classes);
                $data_content[$index] = [];
                $list_buttons[$index] = $this->model->fetchAllRecords("
                    SELECT subjects.id, subject, classes.class
                    FROM subjects, classes
                    WHERE subjects.class_id = classes.id AND 
                    classes.class = '$class_name' 
                    LIMIT 4
                ");
                if ($class_name == "Mới nhất") {
                    for ($i = 0; $i < 6; $i++) {
                        array_push($data_content[$index], $all_posts[$i]);
                    }
                } else {
                    foreach ($all_posts as $post) {
                        if ($post->class == $class_name && $post->subject == $list_buttons[$index][0]->subject) {
                            array_push($data_content[$index], $post);
                        }
                    }
                }
            }
            require_once 'views/homepage.php';
        }
    }

    new HomepageController();
