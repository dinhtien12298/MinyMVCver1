<?php
    class CategoryController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
            $this->defineCategory($class, $subject);
        }

        private function defineCategory($class, $subject) {
            if (isset($_GET['subject']) || $class == 'Mới nhất') {
                $page = ($_GET['page']);
                $tab_title = ($class == 'Mới nhất') ? $class : $subject;
                $data = $this->dataContentDetail($page, $class, $subject);
                $data_content = $data[0];
                $page_button = $data[1];
                $continue = $data[2];
                require_once 'views/categoryDetail.php';
            } else {
                $data_content = $this->dataContentBasic($class);
                require_once 'views/categoryBasic.php';
            }
        }

        private function dataContentBasic($class) {
            $class_id = $this->model->searchClassIdByClass($class)->id;
            $all_subjects = $this->model->searchSubjectsOfClass($class_id);
            $data_content = [];
            foreach ($all_subjects as $subject) {
                $index = array_search($subject, $all_subjects);
                $data_content[$index] = $this->model->searchTabPost($subject->id, 3);
            }
            return $data_content;
        }

        private function dataContentDetail($page, $class, $subject) {
            $start_number = 9 * ($page - 1);
            if  ($class == 'Mới nhất') {
                $subject_id = 0;
                $data_content = $this->model->fetchLastedPostForPage($start_number);
            } else {
                $subject_id = $this->model->searchSubjectId($class, $subject)->id;
                $data_content = $this->model->fetchPostsForPage($start_number, $subject_id);
            }
            $number_of_records = $this->model->countPosts($start_number, $subject_id);
            $page_button = $this->calculatePageNumber($page, $number_of_records)[0];
            $continue = $this->calculatePageNumber($page, $number_of_records)[1];
            return [$data_content, $page_button, $continue];
        }

        private function calculatePageNumber($page, $number_of_records) {
            $continue = false;
            if ($number_of_records <= 9) {
                $page_number = $page;
            } elseif ($number_of_records <= 18) {
                $page_number = $page + 1;
            } else {
                $page_number = $page + 2;
            }
            if ($number_of_records > 27) {
                $continue = true;
            }
            return [$page_number, $continue];
        }
    }
    new CategoryController();
