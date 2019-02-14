<?php
    class CategoryController {
        public $model;
        public function __construct() {
            $this->model = new model();
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
            if (isset($_GET['subject'])) {
                function calculatePageNumber($data) {
                    if (sizeof($data) % 9 == 0) {
                        $page_button = sizeof($data) / 9;
                    } else {
                        $page_button = intval(sizeof($data) / 9) + 1;
                    }
                    return $page_button;
                }

                // Lấy dữ liệu
                $all_posts = $this->model->fetchAllRecords("
                    SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                    FROM users, subjects, classes, posts
                    WHERE users.id = posts.user_id AND
                    classes.id = subjects.class_id AND
                    subjects.id = posts.subject_id AND 
                    classes.class = '$class' AND 
                    subjects.subject = '$subject' 
                ");

                $page = ($_GET['page']);
                $start_number = 9 * ($page - 1);
                $page_button = calculatePageNumber($all_posts);
                $data_content = $this->model->fetchAllRecords("
                    SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                    FROM users, subjects, classes, posts
                    WHERE users.id = posts.user_id AND
                    classes.id = subjects.class_id AND
                    subjects.id = posts.subject_id AND 
                    classes.class = '$class' AND 
                    subjects.subject = '$subject' 
                    LIMIT $start_number, 9
                ");

                require_once 'views/categoryDetail.php';
            } else {
                // Lấy dữ liệu
                $all_posts = $this->model->fetchAllRecords("
                    SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                    FROM users, subjects, classes, posts
                    WHERE users.id = posts.user_id AND
                    classes.id = subjects.class_id AND
                    subjects.id = posts.subject_id AND 
                    classes.class = '$class'
                ");

                // Xử lý dữ liệu
                $data_content = [];
                $subject_check_name = [];
                foreach ($all_posts as $post) {
                    $is_exist = in_array($post->subject, $subject_check_name);
                    $index = array_search($post->subject, $subject_check_name);
                    if (!$is_exist) {
                        array_push($subject_check_name, $post->subject);
                        $new_list = array();
                        array_push($new_list, $post);
                        array_push($data_content, $new_list);
                    } else {
                        array_push($data_content[$index], $post);
                    }
                }

                require_once 'views/categoryBasic.php';
            }
        }
    }

    new CategoryController();
